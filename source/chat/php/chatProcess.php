<?php

SESSION_START();
$datei = "../chatTexte.txt";
$_SESSION ['chatTexte'] = array();
$currentText = null;

//Hier wird überprüft ob etwas übergeben wird
if(isset($_POST["text"])){
//Die Übergebenen Sachen werden in Variablen gespeichert
$currentText = $_POST["text"];
}



//Es wird geschaut ob schon files mit Daten existieren, wenn ja dann werden die Daten in die Arrays dazugespeichert
if(file_exists($datei)) {
    foreach(explode(";;;",file_get_contents($datei)) as $texte) {
        $_SESSION ['chatTexte'][] = $texte;
    }
}

if($currentText != null) {
    //Die Variablen werden in arrays hinzugefügt
    $_SESSION ['chatTexte'][] = $currentText;
    $_SESSION ['chatTexte'][] = $_SESSION["username"]; 
    //echo $currentText;
    //echo "<pre>"; var_dump($_SESSION ['chatTexte']); echo "</pre>";
}

/*
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
*/
file_put_contents($datei, implode(";;;", $_SESSION ['chatTexte']));

//echo $_SESSION["username"];

header ("LOCATION: ../chat.php"); 

?>