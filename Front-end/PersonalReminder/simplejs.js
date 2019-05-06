
function getTitle(){ 
    x = new XMLHttpRequest();
    var s="http://prova/back-end/xml09getxml.php";
    var data="<b><book><aut>AAA</aut></book><book><aut>BBB</aut></book></b>";
    x.onreadystatechange = function(){
       if(x.readyState == 4 && x.status == 200 ) {
           var r = x.responseText;
           document.getElementById("a").innerHTML = "valore : " + r ;
       } 
       else
           document.getElementById("a").innerHTML = "errore";      
    }
    x.open("GET", s+"?x="+encodeURIComponent(data), true); 
    x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    x.send();
  }
