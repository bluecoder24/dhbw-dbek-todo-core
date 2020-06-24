<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';
require 'rb.php';

R::setup('mysql:host=localhost;dbname=todo;charset=utf8', 'root', '');
//R::freeze(true); 

$app = AppFactory::create();
$app->setBasePath((function () {
    $scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
    $uri = (string) parse_url('http://a' . $_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH);
    if (stripos($uri, $_SERVER['SCRIPT_NAME']) === 0) {
    return $_SERVER['SCRIPT_NAME'];
    }
    if ($scriptDir !== '/' && stripos($uri, $scriptDir) === 0) {
    return $scriptDir;
    }
    return '';
   })());

//Test routes - to be removed
$app->get('/', function (Request $request, Response $response,
$args) {
 $response->getBody()->write("Hello world!");
 return $response;
});
$app->get('/test', function (Request $request, Response $response,
$args) {
 $response->getBody()->write("GET-Test erfolgreich!");
 return $response;
});
$app->post('/test', function (Request $request, Response $response,
$args) {
 $response->getBody()->write("POST-Test erfolgreich!");
 return $response;
});
$app->put('/test', function (Request $request, Response $response,
$args) {
 $response->getBody()->write("PUT-Test erfolgreich!");
 return $response;
});
$app->delete('/test', function (Request $request, Response $response,
$args) {
 $response->getBody()->write("DELETE-Test erfolgreich!");
 return $response;
});


//Real routes
$app->get('/getTask/{taskId}', function (Request $request, Response $response,
$args) {
    $task = R::load('task', $args['taskId']);
    $response->getBody()->write(json_encode($task));
    return $response;
});

$app->get('/getTasksOfList/{listId}', function (Request $request, Response $response,
$args) {
    $tasks = R::findAll('task', 'list_id = '.$args['listId'].'');
    $response->getBody()->write(json_encode(R::exportAll($tasks)));
    return $response;
});

$app->post('/addOrUpdateTask', function (Request $request, Response $response,
$args) {
    $parsedBody = json_decode($request->getBody());
    if(!isset($parsedBody->id))
    {
        $task = R::dispense('task');
        $task->name = (string)$parsedBody->name;
        $task->duedate = (string)$parsedBody->duedate;
        $task->description = (string)$parsedBody->description;
        $task->weight = (int)$parsedBody->weight;
        $task->state = (int)$parsedBody->state;

        $list = R::load('list', $parsedBody->list_id);
        $list->xownTaskList[] = $task;

        R::store($list);
    }
    else
    {
        $task = R::load('task', (int)$parsedBody->id);
        $task->name = (string)$parsedBody->name;
        $task->duedate = (string)$parsedBody->duedate;
        $task->description = (string)$parsedBody->description;
        $task->weight = (int)$parsedBody->weight;
        $task->state = (int)$parsedBody->state;
        R::store($task);
    }
    
    $response->getBody()->write(json_encode($task));
    return $response;
});

$app->get('/getList/{listId}', function (Request $request, Response $response,
$args) {
    $list = R::load('list', $args['listId']);
    $list->name;
    $first = reset( $list->ownTaskList );
    $last = end( $list->ownTaskList );
    $response->getBody()->write(json_encode($list));
    return $response;
});

$app->get('/getAllLists', function (Request $request, Response $response,
$args) {
    $lists = R::findAll('list');
    $response->getBody()->write(json_encode(R::exportAll($lists)));
    return $response;
});

$app->post('/addOrUpdateList', function (Request $request, Response $response,
$args) {
    $parsedBody = json_decode($request->getBody());
    if(!isset($parsedBody->id))
    {
        $list = R::dispense('list');
        $list->name = (string)$parsedBody->name;
    }
    else
    {
        $list = R::load('list', (int)$parsedBody->id);
        $list->name = (string)$parsedBody->name;
    }
    R::store($list);
    $response->getBody()->write(json_encode($list));
    return $response;
});

$app->delete('/deleteList/{listId}', function (Request $request, Response $response,
$args) {
    $list = R::load('list', $args['listId']);
    R::trash($list);
    return $response;
});

$app->run();
?>
