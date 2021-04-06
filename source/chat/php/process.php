<?php
	SESSION_START();
    $_SESSION["username"] = $_SESSION["email"] = $_SESSION["password"] = "";
    $userDataFile = '../datei/logindata.csv';

    //Wird ausgef�hrt, wenn das Formular zur Registriereung abgeschickt wurde.
    if(isset($_POST['submitRegister'])) {

		//Informationen von der Registrierseite holen   
		$_SESSION["username"] = $_POST['username'];
		$_SESSION["email"] = $_POST['email'];
		$_SESSION["password"] = hash('sha256', $_POST['password']);

	//Auf Sonderzeichen pr�fen
		$_SESSION["username"] = sonderzeichen($_SESSION["username"]);
        $_SESSION["email"] = sonderzeichen($_SESSION["email"]);

	//Daten aus dem File holen zur �berpr�fung
	$handler = fopen($userDataFile, 'r');

	    $usernames = array();
	    $emails = array();	    

	    ini_set('auto_detect_line_endings',TRUE);
	    $row = 0;
	    $fail = 0;
	    while (($data = fgetcsv($handler, 1000, ";")) !== FALSE ) {
	    	$num = count($data);
            	for ($c=0; $c < $num; $c+=3) {
               	    array_push($usernames, $data[$c]);
            	}
		for ($c=1; $c < $num; $c+=3) {
               	    array_push($emails, $data[$c]);
            	}
		if($usernames[$row] == $_SESSION["username"] or $emails[$row] == $_SESSION["email"])	{
		    $fail = 1;
		}

		$row = $row + 1;		
	    }
	    ini_set('auto_detect_line_endings',FALSE);

	fclose($handler);

	//Daten werden gespeichert
	if($fail == 0)	{	
	    //Informationen in das File schreiben
	    $handler = fopen($userDataFile, 'a+');

	    	fwrite($handler, $_SESSION["username"] . ";" . $_SESSION["email"] . ";" . $_SESSION["password"] . "\n");
	
	    fclose($handler);
	}
	//Fehler-Meldung wird auf der registration-Site ausgegeben
	else	{
            $_SESSION ['wrongregistration'] = "";
	    header('Location: ../register.php');

	}



	//echo $username, $password, $email;

        //$empfaenger = $email;
        //$betreff = "Die Mail funktioniert";
        //$from = "From: Felix Kampas <medt.infos@gmail.com>\r\n";
        //$from = $from . "Reply-To: medt.infos@gmail.com\r\n";
        //$from = $from . "Content-Type: text/html\r\n";
        //$text = "Hola Amigo";
	//mail($empfaenger, $betreff, $text, $from);
    }

    //Wird ausgef�hrt, wenn das Formular zur Registriereung abgeschickt wurde.
    if(isset($_POST['submitLogin']))    {

    }


    //Ueberpruefung und wechseln von Sonderzeichen
    function sonderzeichen($string) {
        $string = str_replace("ä", "ae", $string);
        $string = str_replace("ü", "ue", $string);
        $string = str_replace("ö", "oe", $string);
        $string = str_replace("Ä", "Ae", $string);
        $string = str_replace("Ü", "Ue", $string);
        $string = str_replace("Ö", "Oe", $string);
        $string = str_replace("ß", "ss", $string);
        $string = str_replace("´", "", $string);
        return $string;
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--Importiert das Bootstrap css-File-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <!--Importiert das css-File-->
    <link rel="stylesheet" href="style/styleRegister.css">

    <!--Importiert das Bootstrap script-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous" async></script>
    

    <title>process</title>
</head>
<body>
	<a href="../chat.php">Weiter zum Chat</a>
</body>
</html>