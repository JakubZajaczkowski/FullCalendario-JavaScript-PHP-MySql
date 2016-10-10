<?php
// List of events
 $json = array();

 // Query that retrieves events
 $requete = "SELECT * FROM zdarzenia";

 // connection to the database
 try {
$bdd = new PDO('mysql:host=localhost;dbname=klasa24', 'admin1', 'admin1');
 } catch(Exception $e) {
  exit('Unable to connect to database.');
 }
 // Execute the query
 $resultat = $bdd->query($requete) or die(print_r($bdd->errorInfo()));

$events = array();

foreach ($resultat as $row) {
    $start = $row["start"];
    $end = $row["end"];
    $title = $row["title"];
    $id = $row["id"];
    $backgroundColor = $row["backgroundColor"];
    //$allDay =  $row["allDay"] = 'false';
    $allDay = false;
    
    
    $eventsArray['title'] = $title;
    $eventsArray['start'] = $start;
    $eventsArray['end'] = $end;
    $eventsArray['allDay'] = $allDay;
    $eventsArray['id'] = $id;
    $eventsArray['backgroundColor'] = $backgroundColor;
    $events[] = $eventsArray;
}


 // sending the encoded result to success page
echo json_encode($events);

?>