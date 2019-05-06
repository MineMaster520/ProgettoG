<?php

ini_set('display_errors', 1);

$filename = "db-users.xml";
$email =$_POST["email"];
$psw = $_POST["psw"];
$repsw = $_POST["psw-repeat"];
echo $email;
echo $psw;
echo $repsw;
//Cerca l'ultimo id utilizzato
$lastID =0;
$xml=simplexml_load_file($filename) or die("Errore: Non posso aprire il file");
foreach($xml->children() as $id) { 
    $lastID = $id->id; 
} 

$lastID= $lastID+1;
echo $lastID;

$xmldoc = new DOMDocument();
$xmldoc->load($filename);

$firstchild = $xmldoc->getElementsByTagName('DBPeronalReminder')->item(0);
$newPage = $xmldoc->createDocumentFragment();
$newPage->appendXML(' <users>
    <id>'. $lastID .'</id>
    <usr>'. $email .'</usr>
    <psw>'. $psw  .'</psw>
</users>

');
$firstchild->appendChild($newPage);
$xmldoc->save($filename);

header('Location: ../../Front-end/PersonalReminder/index.html'); 

?>