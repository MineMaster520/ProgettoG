<?php

ini_set('display_errors', 1);
session_start();
$filename = "db-users.xml";

$uname =$_POST["uname"];
$psw = $_POST["psw"];
//echo $uname;
//echo $psw;


$xml=simplexml_load_file($filename) or die("Errore: Non posso aprire il file");
$canGoOn=0;
$id =0;
foreach($xml->children() as $users) { 
    if($users->usr  == $uname ){
        if($users->psw == $psw){
            $canGoOn=1;
            $id= $users->id;
            break;
        }
    }
} 

if($canGoOn==0){
    echo "Username e/o Password Errati\n";
}
else{
    
    $_SESSION["user"] = strval($uname);
    $_SESSION["id"] = strval($id);

    echo "gotonotes";

}


?>