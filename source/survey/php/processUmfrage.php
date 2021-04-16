<?php


if(isset($_POST['formQuestion']))	{
    SESSION_START();
	
    $user = $_SESSION['loginGranted'];
    $frage = $_POST['text'];
    if(isset($_POST['anonym'])) {
    	$anonym = 1;
    } else {
    	$anonym = 0;
    }

    echo $user;
    echo $frage;
    echo $anonym;

    $pdo = new PDO ( 'mysql:host=localhost;dbname=db3bhit_s9' , 'db3bhit_s9' , 'eru7Eing' ); 

    if ($pdo == false){
    	echo "False";
    } else {
    	echo "true";
    }

    $select = "SELECT ID FROM fragen" ;
    foreach ( $pdo -> query ( $select ) as $row ) { 
    	$ID = $row;
    }

    echo "<pre>"; var_dump($ID); echo "</pre>";
    echo $ID["ID"];

    $statement = $pdo -> prepare ( "INSERT INTO fragen (ID, username, frage, anonym)
    VALUES (?, ?, ?, ?)" ) ;
    $statement -> execute ( array ( $ID["ID"], $user , $frage , $anonym ) ) ;

    //header("LOCATION: ../ergebnisse.php");
}


if(isset($_POST['submitRegister'])) {


}


?>