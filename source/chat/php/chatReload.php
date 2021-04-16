<?php
session_start();
unset($_SESSION['chatTexte']);
if(file_exists("../chatTexte.txt")) {
    foreach(explode(";;;",file_get_contents("../chatTexte.txt")) as $texte) {
        $texte = str_replace("<", "|", $texte);
        $texte = str_replace(">", "|", $texte);
        $_SESSION ['chatTexte'][] = $texte;
    }
}
//echo "<pre>"; var_dump($_SESSION ['chatTexte']); echo "</pre>";
$ausgabe ="";
$text = "";
$i = 0;
for($i = 1; $i<count($_SESSION["chatTexte"]);$i++) {
    if($i%2!=0) {
        $text = $_SESSION["chatTexte"][$i];
    }
    if($i%2==0) {
        if($_SESSION["username"] == $_SESSION["chatTexte"][$i]) {
            $usern = $_SESSION["chatTexte"][$i];
            $ausgabe .= "<div class=\"rightChat\"><p class=\"text\">$text</p><p class=\"user\"><i>$usern</i></p></div>";
        } else {
            $usern = $_SESSION["chatTexte"][$i];
            $ausgabe .= "<div class=\"leftChat\"><p class=\"text\">$text</p><p class=\"user\"><i>$usern</i></p></div>";
        }
    }
}
echo $ausgabe;
  
?>