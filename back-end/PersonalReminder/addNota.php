<?php

ini_set('display_errors', 1);

$filename = "db_notes.xml";
$str_json = file_get_contents('php://input');
$decodedJson = json_decode($str_json);

//echo $decodedJson;

$user = $decodedJson->idUser;
$textNota = $decodedJson->nota;
$notaId =0;

//echo $user;
//echo $textNota;

//Cerca l'ultimo Notaid utilizzato
$lastID =0;
$xml=simplexml_load_file($filename) or die("Errore: Non posso aprire il file");
foreach($xml->children() as $id) { 
    $lastID = $id->idNota; 
} 

$notaId= $lastID+1;

$xmldoc = new DOMDocument();
$xmldoc->load($filename);

$firstchild = $xmldoc->getElementsByTagName('Dbnotes')->item(0);
$newPage = $xmldoc->createDocumentFragment();
$newPage->appendXML(' <nota>
    <idNota>'. $notaId .'</idNota>
    <idUser>'. $user .'</idUser>
    <text>'. $textNota  .'</text>
</nota>

');
$firstchild->appendChild($newPage);
$xmldoc->save($filename);

$arr = array('idNota' => $notaId, 'idUser' => $user, 'text' => $textNota);



echo json_encode($arr);
//header('Location: ../../Front-end/PersonalReminder/index.html'); 

?>