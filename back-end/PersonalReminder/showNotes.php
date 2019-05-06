<?php

ini_set('display_errors', 1);
session_start();
$filename = "db_notes.xml";

$idUser = $_SESSION["id"];


//Cerca le note Con id User Uguale a quello che fa la richiesta
$lastID =0;
$xml=simplexml_load_file($filename) or die("Errore: Non posso aprire il file");

$xmlResp="<note>\n";

foreach($xml->children() as $id) { 
    if($id->idUser == $idUser){
        // COMPONI QUELLO CHE DEVI INVIARE
         $xmlResp= $xmlResp."<text>". $id->text ."</text> \n";
    } 
} 

$xmlResp=$xmlResp."</note>";

echo $xmlResp;

?>