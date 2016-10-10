<?php
// Values received via ajax
$title = $_POST['title'];
$start = $_POST['start'];
$end = $_POST['end'];
$url = $_POST['url'];
$backgroundColor = $_POST['backgroundColor'];

// connection to the database
try {
$bdd = new PDO('mysql:host=localhost;dbname=klasa24', 'admin1', 'admin1');
} catch(Exception $e) {
exit('Unable to connect to database.');
}

// insert the records
$sql = "INSERT INTO zdarzenia (title, start, end, url, backgroundColor) VALUES (:title, :start, :end, :url, :backgroundColor)";
$q = $bdd->prepare($sql);
$q->execute(array(':title'=>$title, ':start'=>$start, ':end'=>$end,  ':url'=>$url, ':backgroundColor'=>$backgroundColor ));
?>