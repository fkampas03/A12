<?php
SESSION_START();

$server = 'mysql:host=localhost;dbname=db3bhit_s11';


if(isset($_POST['createSurvey']))	{
	
    $user = $_SESSION['username'];
    $frage = $_POST['text'];
    if(isset($_POST['anonym'])) {
    	$anonym = 1;
    } else {
    	$anonym = 0;
    }

    $pdo = new PDO ( 'mysql:host=localhost;dbname=db3bhit_s11' , 'db3bhit_s11' , 'ohphiM9z' ); 
    echo $user;
    echo $frage;
    echo $anonym;

    if ($pdo == false){
    	echo "False";
    } else {
    	echo "true";
    }

    $select = "SELECT ID FROM fragen" ;
    foreach ( $pdo -> query ( $select ) as $row ) { 
    	$ID = $row;
    }
    $ID["ID"]++;
    //echo "<pre>"; var_dump($ID); echo "</pre>";
    //echo $ID["ID"];

    $statement = $pdo -> prepare ( "INSERT INTO fragen (ID, username, frage, anonym, public)
    VALUES (?, ?, ?, ?, ?)" ) ;
    $statement -> execute ( array ( $ID["ID"], $user , $frage , $anonym, 0) ) ;

    header("LOCATION: ../overview.php");
}

//if(isset($_POST['submitRegister'])) {


//}

if(isset($_POST['action'])) {
    
    $ID = $_POST['ID'];
    $answer = $_POST['action'];

    //echo $ID;
    //echo $answer;
    $pdo = new PDO ( $server , 'db3bhit_s11' , 'ohphiM9z' ); 

    if(isset($_SESSION['username'])) {
        $user = $_SESSION['username'];
    } else {
        $user = "anonym";
    }

    $select = "SELECT ID FROM antworten" ;
    foreach ( $pdo -> query ( $select ) as $row ) { 
    	$IDf = $row;
    }
    $IDf["ID"]++;

    $statement = $pdo -> prepare ( "INSERT INTO antworten (ID, fragenID, username, antwort)
    VALUES (?, ?, ?, ?)" ) ;
    $statement -> execute ( array ( $IDf["ID"], $ID , $user , $answer ) ) ;

    header("LOCATION: ../overview.php");
    
}


if(isset($_POST['showSolution']) || isset($_POST['hideSolution'])) {

    $pdo = new PDO ( $server , 'db3bhit_s11' , 'ohphiM9z' ); 
    
    $ID = $_POST['ID'];

    $select = "SELECT public FROM fragen WHERE ID = $ID" ;
    foreach ( $pdo -> query ( $select ) as $row ) { 
    	$public = $row;
    }

    echo "<pre>"; var_dump($public); echo "</pre>";

    if($public['public']==0) {
        $public = 1;
    } else {
        $public = 0;
    }
    echo "<pre>"; var_dump($public); echo "</pre>";

    $statement = $pdo -> prepare ( "UPDATE fragen SET public=:publicneu WHERE ID= \"$ID\"" ) ;
    $statement -> execute (array('publicneu' => $public));

    header("LOCATION: ../overview.php");
}


?>