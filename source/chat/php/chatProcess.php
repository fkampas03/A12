<?php

SESSION_START();
$datai = "chatTexte.txt";
$_SESSION ['chatTexte'] = array();
$currentText = null;

<<<<<<< HEAD
//Hier wird überprüft ob etwas übergeben wird
if(isset($_POST["text"])){
//Die Übergebenen Sachen werden in Variablen gespeichert
=======
//Hier wird Ã¼berprÃ¼ft ob etwas Ã¼bergeben wird
if(isset($_POST["text"])){
//Die Ãœbergebenen Sachen werden in Variablen gespeichert
>>>>>>> 4b77acd3316b06ef10e29eea06298cdd380caae3
$currentText = $_POST["text"];
}



//Es wird geschaut ob schon files mit Daten existieren, wenn ja dann werden die Daten in die Arrays dazugespeichert
if(file_exists($datai)) {
    foreach(explode(";;;",file_get_contents($datai)) as $texte) {
        $_SESSION ['chatTexte'][] = $texte;
    }
}

if($currentText != null) {
<<<<<<< HEAD
    //Die Variablen werden in arrays hinzugefügt
=======
    //Die Variablen werden in arrays hinzugefÃ¼gt
>>>>>>> 4b77acd3316b06ef10e29eea06298cdd380caae3
    $_SESSION ['chatTexte'][] = $currentText;
    $_SESSION ['chatTexte'][] = $_SESSION["username"]; 
    //echo $currentText;
    //echo "<pre>"; var_dump($_SESSION ['chatTexte']); echo "</pre>";
}


function show() {
  $text = "";
  $i = 0;
  for($i = 1; $i<count($_SESSION["chatTexte"]);$i++) {
    if($i%2!=0) {
      $text = $_SESSION["chatTexte"][$i];
    }
    if($i%2==0) {
      if($_SESSION["username"] == $_SESSION["chatTexte"][$i]) {
        echo "<p class=\"rightChat\">$text</p>";
      } else {
        echo "<p class=\"leftChat\">$text</p>";
      }
    }
  }
}

file_put_contents("chatTexte.txt", implode(";;;", $_SESSION ['chatTexte']));

//echo $_SESSION["username"];

?>