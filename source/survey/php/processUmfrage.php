<?php
SESSION_START();

$user = $_SESSION['username'];

$pdo = new PDO ( 'mysql:host=localhost:3306;dbname=db3bhit_s11' , 'root' , null ) 

$statement = $pdo -> prepare ( "INSERT INTO fragen (ID, frage, anonym)
VALUES (?, ?, ?)" ) ;
$statement -> execute ( array ( 1 , 'wie gehts' , 'n' ) ) ;

?>