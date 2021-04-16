<?php
SESSION_START();

if(!empty($_POST['text']))	{
	
    $user = $_SESSION['username'];
    $frage = $_POST['text'];
    if(isset($_POST['anonym'])) {
    	$anonym = 1;
    } else {
    	$anonym = 0;
    }

    //echo $user;
    //echo $frage;
    //echo $anonym;

    $pdo = new PDO ( 'mysql:host=localhost;dbname=db3bhit_s11' , 'db3bhit_s11' , 'ohphiM9z' ); 

    /*if ($pdo == false){
    	echo "False";
    } else {
    	echo "true";
    }*/

    $select = "SELECT ID FROM fragen" ;
    foreach ( $pdo -> query ( $select ) as $row ) { 
    	$ID = $row;
    }
    $ID["ID"]++;
    //echo "<pre>"; var_dump($ID); echo "</pre>";
    //echo $ID["ID"];

    $statement = $pdo -> prepare ( "INSERT INTO fragen (ID, username, frage, anonym)
    VALUES (?, ?, ?, ?)" ) ;
    $statement -> execute ( array ( $ID["ID"], $user , $frage , $anonym ) ) ;

    header("LOCATION: ../ergebnisse.php");
}

//if(isset($_POST['submitRegister'])) {


//}

if(isset($_POST['action'])) {
    
    $ID = $_POST['ID'];
    $answer = $_POST['action'];

    //echo $ID;
    //echo $answer;

    if(isset($_SESSION['username'])) {
        $user = $_SESSION['username'];
    } else {
        $user = null;
    }

    $pdo = new PDO ( 'mysql:host=localhost;dbname=db3bhit_s11' , 'db3bhit_s11' , 'ohphiM9z' ); 

    $select = "SELECT ID FROM antworten" ;
    foreach ( $pdo -> query ( $select ) as $row ) { 
    	$IDf = $row;
    }
    $IDf["ID"]++;

    $statement = $pdo -> prepare ( "INSERT INTO antworten (ID, fragenID, username, antwort)
    VALUES (?, ?, ?, ?)" ) ;
    $statement -> execute ( array ( $IDf["ID"], $ID , $user , $answer ) ) ;

    header("LOCATION: ../ergebnisse.php");
}


?>