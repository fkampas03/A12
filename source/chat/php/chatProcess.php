<?php

SESSION_START();
$datai = "chatTexte.txt";
$_SESSION ['chatTexte'] = array();
$currentText = null;

//Hier wird �berpr�ft ob etwas �bergeben wird
if(isset($_POST["text"])){
//Die �bergebenen Sachen werden in Variablen gespeichert
$currentText = $_POST["text"];
}



//Es wird geschaut ob schon files mit Daten existieren, wenn ja dann werden die Daten in die Arrays dazugespeichert
if(file_exists($datai)) {
    foreach(explode(";;;",file_get_contents($datai)) as $texte) {
        $_SESSION ['chatTexte'][] = $texte;
    }
}

if($currentText != null) {
    //Die Variablen werden in arrays hinzugef�gt
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