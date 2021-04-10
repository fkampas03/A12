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

file_put_contents("chatTexte.txt", implode(";;;", $_SESSION ['chatTexte']));

//echo $_SESSION["username"];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>

    <link rel="stylesheet" href="style/styleChat.css">
    <script>
        timeSlap=2 // sekunden
        reloading=function()
        {
            setTimeout("reloading()",1000);

            status=timeSlap+" sekunden bis zum reload";
            if(timeSlap>0) timeSlap--;
            else location.reload();
        }
    </script>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <div class="col-11 ms-5">
      <a class="navbar-brand nav-font" href="#">Chat</a>
    </div>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav ">
        <a class="nav-link active" aria-current="page" href="register.php">Logout</a>
      </div>
    </div>
  </div>
</nav>
    
<section>
<div class="heading">
  <h1 class="display-3">
    Chat
  </h1>
</div>
<div id="chat">
<?php 
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
?>

</div>
<div id="eingabe">

<form name="chatForm" action="#" method="POST">
  <div class="d-flex flex-row">
    <input class="col-10" type="text" name="text" id="text" placeholder="message" required>
    <input class="col-2"type="submit" value="senden">
  </div>
</form>
</div>
</section>
<footer>
      <p> &copy; 2020 - 2021 Mimmler Florian, Felix Kampas </p>
</footer>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>