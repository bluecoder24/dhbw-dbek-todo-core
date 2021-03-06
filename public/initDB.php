<?php

// Diese Datei dient ausschließlich dazu, die notwendigen Strukture in der Datenbank 
// anzulegen. Die Datei muss daher nur einmal ausgefürt werden. Anschließend sind
// alle notwendigen Tabellen angelegt und mit Beispieldaten belegt.

require 'rb.php';

R::setup('mysql:host=localhost;dbname=todo;charset=utf8', 'root', '');


// ### Zwei neue Aufgabenlisten anlegen ###
	
$list = R::dispense('list'); 
$list2 = R::dispense('list'); 

// ...und die gewünschten Eigenschaften hinzufügen

$list->name = "Aufgaben Büro";
$list2->name = "Aufgaben Zuhause";


// ### Neue Aufgaben anlegen ... ###

$taskBuero1 = R::dispense('task');
$taskBuero1->name = "Blumen giessen";
$taskBuero1->duedate = "2020-06-29T22:00:00.000Z";
$taskBuero1->description = "gut wässern";
$taskBuero1->weight = 3;
$taskBuero1->state = 0;

$taskBuero2 = R::dispense('task');
$taskBuero2->name = "Defekter Monitor austauschen";
$taskBuero2->duedate = "2020-06-29T22:00:00.000Z";
$taskBuero2->description = "Adapter nicht wegwerfen!";
$taskBuero2->weight = 4;
$taskBuero2->state = 0;

$taskBuero3 = R::dispense('task');
$taskBuero3->name = "Bericht für Chef fertigstellen";
$taskBuero3->duedate = "2020-06-30T22:00:00.000Z";
$taskBuero3->description = "Diagramme nicht vergessen";
$taskBuero3->weight = 5;
$taskBuero3->state = 1;

$taskZuhause1 = R::dispense('task');
$taskZuhause1->name = "Fenster putzen";
$taskZuhause1->duedate = "2020-06-29T22:00:00.000Z";
$taskZuhause1->description = "";
$taskZuhause1->weight = 3;
$taskZuhause1->state = 0;

$taskZuhause2 = R::dispense('task');
$taskZuhause2->name = "Auto putzen";
$taskZuhause2->duedate = "2020-06-29T22:00:00.000Z";
$taskZuhause2->description = "";
$taskZuhause2->weight = 1;
$taskZuhause2->state = 0;

$taskZuhause3 = R::dispense('task');
$taskZuhause3->name = "Garten umgraben";
$taskZuhause3->duedate = "2020-07-02T22:00:00.000Z";
$taskZuhause3->description = "Beet im Garten umgraben";
$taskZuhause3->weight = 5;
$taskZuhause3->state = 0;

// ### Tasks den Listen zuordnen (1:n) ###

$list->xownTaskList[] = $taskBuero1;
$list->xownTaskList[] = $taskBuero2;
$list->xownTaskList[] = $taskBuero3;

$list2->xownTaskList[] = $taskZuhause1;
$list2->xownTaskList[] = $taskZuhause2;
$list2->xownTaskList[] = $taskZuhause3;

// Aufgabenliste speichern

$id = R::store($list);   
$id2 = R::store($list2);                   

//Ausgabe der erstellten Daten

echo "Folgende Beispieldaten wurden der Datenbank hinzugefügt:<br>";

$lists = R::findAll('list');

foreach($lists as $list)
{
    echo "<h3>".$list->name."</h3>";
    foreach($list->xownTaskList as $task) 
    {
        echo "Id: " . $task->id . "<br>";
        echo "Name: " . $task->name . "<br>";
        echo "Fälligkeitsdatum: " . $task->duedate . "<br>";
        echo "Beschreibung: " . $task->description . "<br>";
        echo "Wichtigkeit: " . $task->weight . "<br>";
        echo "Status: " . $task->state . "<br>";
        echo "&nbsp;<br>";
    }
}

R::close();

?>