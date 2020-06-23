<?php

// Diese Datei dient ausschließlich dazu, die notwendigen Strukture in der Datenbank 
// anzulegen. Die Datei muss daher nur einmal ausgefürt werden. Anschließend sind
// alle notwendigen Tabellen angelegt und mit Beispieldaten belegt.


// Folgende Informationen sind bekannt:
// 
// Datenbankserver:   localhost
// Datenbankname:     dhbwvs20_rzptvw
// Datenbankuser:     dhbwvs20_dbuser1 
// Datenbankkennwort: dbuser1pwd


// Einbinden der RedBean-Funktionalität. Die Datei 'rb.php' befindet sich im 
// gleichen Verzeichnis, wie diese Datei. Ab jetzt steht die Klasse R zur Verfügung!

require 'rb.php';


// Die Methode statische 'setup' der Klasse R ermöglicht den Aufbau einer Verbindung
// zur Datenbank. In der ersten Zeichenkette ist der Name der Servers, auf welchem
// das DBMS läuft (localhost) und der Name der Datenbank kodiert (bundesliga).
// Die beiden weiteren Parameter legen den Namen und das Kennwort des DB-Benutzers
// fest.
//
// Benutzer von bplaced müssen drei der Parameter hier anpassen! Lediglich der 
// Servername (localhost) kann übernommen werden!

R::setup('mysql:host=localhost;dbname=dhbwvs20_rzptvw', 'dhbwvs20_dbuser1', 'dbuser1pwd');

  



// ### Neue Person anlegen ... ###
$koch = R::dispense('person');    //Achtung Namenskonvention: Beans (hier: person) müssen komplett klein geschrieben werden

// ...und die gewünschten Eigenschaften hinzufügen

$koch->name = "Alfred";
$koch->kennwort = "12345";
$koch->ranking = "Anfänger";


// ### Neues Rezept anlegen ... ###
	
$rezept = R::dispense('rezept');    //Achtung Namenskonvention: Beans (hier: rezept) müssen komplett klein geschrieben werden

// ...und die gewünschten Eigenschaften hinzufügen

$rezept->name = "American Pizza";
$rezept->schwierigkeit = "leicht";
$rezept->zubereitungszeit = 110;      //in Minuten
$rezept->zubereitung = "Backofen gut vorheizen (250 Grad, sollte der Backofen mehr hergeben ruhig noch höher)...";




// ### Neue Zutat anlegen ... ###

$zutat = R::dispense('zutat');    //Achtung Namenskonvention: Beans (hier: zutat) müssen komplett klein geschrieben werden

// ...und die gewünschten Eigenschaften hinzufügen

$zutat->name = "Mehl";
$zutat->menge = 1.1;
$zutat->einheit = "g";




// ### Zutat dem Rezept zuordnen (1:n) ###

$rezept->xownZutatList[] = $zutat;


// ### Person dem Rezept zuordnen (1:1) ###

$rezept->person = $koch;




// ...Rezept inkl. Person und Zutat speichern

$id = R::store($rezept);   // RedBean untersucht die erstellten Beans und erstellt, falls noch nicht vorhanden
                           // für jedes Bean eine eigene Tabelle. Die Spalten der Tabelen werden durch die
                           // Eigenschaften der Beans festgelegt. Typen werden dabei automatisch erkannt.








// ### Zur Kontrolle wird das eben angelegte Rezept geladen und inklusiv aller verknüpften Daten ausgegeben ###




$rezept = R::load('rezept', $id);     // In der Tabelle 'rezept' wird nach dem Datensatz mit der 'id' $id gesucht.

//Ausgabe der Rezeptdaten

echo "<h3>Rezeptdaten</h3>";
echo "Rezeptname: " . $rezept->name . "<br>";
echo "Schwierigkeit: " . $rezept->schwierigkeit . "<br>";
echo "Zubereitungszeit: " . $rezept->zubereitungszeit . "<br>";
echo "Zubereitung: " . $rezept->zubereitung . "<br>";

echo "--------------";

echo "<h3>Person</h3>";
$koch = $rezept->person;
echo "Name: " . $koch->name . "<br>";
echo "Kennwort: " . $koch->kennwort . "<br>";
echo "Ranking: " . $koch->ranking . "<br>";
echo "&nbsp;<br>";

echo "--------------";

echo "<h3>Zutaten</h3>";
foreach($rezept->xownZutatList as $z) {
    echo "Name: " . $z->name . "<br>";
    echo "Einheit: " . $z->einheit . "<br>";
    echo "Menge: " . $z->menge . "<br>";
    echo "&nbsp;<br>";
}
	



// Spätestens am Ende des Programms sollte die Verbindung zum DBMS wieder geschlossen
// werden. Dazu steht die Methode "close()" bereit.

R::close();

?>