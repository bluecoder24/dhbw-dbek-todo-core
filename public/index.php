<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';
require 'rb.php';

R::setup('mysql:host=localhost;dbname=todo', 'root', '');

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

//Test routes  
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
$app->get('/getUser/{userId}', function (Request $request, Response $response,
$args) {
    $response->getBody()->write("getUser - userId: ". $args['userId']);
    //$response->getBody()->write(json_encode(R::exportAll($rezept)));
    //oder ohne bei nicht-array
    return $response;
});

$app->run();
?>
