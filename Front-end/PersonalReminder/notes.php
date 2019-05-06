<!DOCTYPE html>
<html>

<head>
<?php
session_start();
?>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="style.css">
    <script>

        function showNotes() {

            x = new XMLHttpRequest();
            var s="../../back-end/PersonalReminder/showNotes.php";

            x.onreadystatechange = function(){
                if(x.readyState == 4 && x.status == 200 ) {
                   // var r = x.responseText;
                   // document.getElementById("a").innerHTML = "valore : " + r ;
                   //alert(x.responseText);



                    var text, parser, xmlDoc;
                    text = x.responseText;
                    parser = new DOMParser();
                    xmlDoc = parser.parseFromString(text,"text/xml");

                    let LeMieNote = xmlDoc.getElementsByTagName("text");

                    for(let i =0; i<LeMieNote.length; i++){
                        let nodo = document.createTextNode(LeMieNote[i].childNodes[0].nodeValue);
                        document.getElementById("showNotes").appendChild(nodo);
                        let br = document.createElement("br");
                        document.getElementById("showNotes").appendChild(br);
                        //alert(LeMieNote[i].childNodes[0].nodeValue);
                    }



                }else{
                    console.log(x.readyState);
                }
            }
            x.open("POST", s, true);
            x.setRequestHeader("Content-type", "application/json");
            x.send();

        }

    </script>


<script>

function addNota(idUser) {

    //  (idUser);
    let nota = document.getElementById("NotaText").value;

    let objtoSend = {"idUser":idUser, "nota":nota};
    let jsontoSend =JSON.stringify(objtoSend);
    console.log(jsontoSend);

    x = new XMLHttpRequest();
            var s="../../back-end/PersonalReminder/addNota.php";

            x.onreadystatechange = function(){
                if(x.readyState == 4 && x.status == 200 ) {
                   // var r = x.responseText;
                   // document.getElementById("a").innerHTML = "valore : " + r ;

                   let json = x.responseText;
                   var obj = JSON.parse(json);
                   console.log(obj);
                   console.log(obj["text"]);
                   let newText = document.createTextNode(obj.text);
                   let br = document.createElement("br");
                   document.getElementById("showNotes").appendChild(newText);
                   document.getElementById("showNotes").appendChild(br);

                }else{
                    console.log(x.readyState);
                }
            }
            x.open("POST", s, true);
            x.setRequestHeader("Content-type", "application/json");
            x.send(jsontoSend);

    }

</script>

<script>
  function logout(){

    var s="../../back-end/PersonalReminder/destroy.php";

    var request = new XMLHttpRequest();
    request.open('GET', s, false);  // `false` makes the request synchronous
    request.send();

    if (request.status === 200) {
       let res = request.responseText;
       if(res==="exit"){
        window.location.href="index.html";
       }

    }





    }
</script>



    <title>Notes</title>
</head>

<body  onload="showNotes(<?php echo $_SESSION['id']; ?>)" >
    <h1>Benvenuto, <?php echo $_SESSION["user"]; ?>  </h1>
    <button type="button" class="cancelbtn" onclick="logout()">log-out</button>
    <!--
    <form action="../../back-end/PersonalReminder/login.php" method ="POST" >
    -->

    <div id="addNotes">

        <input id="NotaText" type="text" placeholder="Nota">
        <button onclick="addNota(<?php echo $_SESSION['id']; ?>)"> Aggiungi Nota </button>
    </div>

    <div id ="showNotes">

    <div>

</body>

</html>