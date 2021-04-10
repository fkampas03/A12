<?php
	SESSION_START();
    $_SESSION["username"] = $_SESSION["email"] = $_SESSION["password"] = "";
    $userDataFile = '../datei/logindata.csv';

<<<<<<< HEAD

    //Wird ausgeführt, wenn das Formular zur Registriereung abgeschickt wurde.
=======
    //Wird ausgefï¿½hrt, wenn das Formular zur Registriereung abgeschickt wurde.
>>>>>>> e1d14a1336a6e8c95f878fbfe8aec2ec7140f6df
    if(isset($_POST['submitRegister'])) {

		//Informationen von der Registrierseite holen   
		$_SESSION["username"] = $_POST['username'];
		$_SESSION["email"] = $_POST['email'];
		$_SESSION["password"] = hash('sha256', $_POST['password']);

	//Auf Sonderzeichen prï¿½fen
		$_SESSION["username"] = sonderzeichen($_SESSION["username"]);
        $_SESSION["email"] = sonderzeichen($_SESSION["email"]);

	//Daten aus dem File holen zur ï¿½berprï¿½fung
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

            $empfaenger = $email;
            $betreff = "Willkommen bei der Chat-Applikation";
            $from = "From: Felix Kampas <medt.infos@gmail.com>";
            $text = "Hola Amigo";
	    mail("kampasfe@gmail.com", $betreff, $text, $from);
	    header('Location: ../login.php');
	}

	//Fehler-Meldung wird auf der Registration-Site ausgegeben
	else	{
            $_SESSION ['wrongregistration'] = "";
	    header('Location: ../register.php');

	}
<<<<<<< HEAD
    }
=======
>>>>>>> e1d14a1336a6e8c95f878fbfe8aec2ec7140f6df





    //Wird ausgefï¿½hrt, wenn das Formular zur Registriereung abgeschickt wurde.
    if(isset($_POST['submitLogin']))    {

	//Informationen von der Registrierseite holen   
        $loginName = $_POST['loginName'];
        $password = hash('sha256', $_POST['password']);
	$grantName = "";

	//Auf Sonderzeichen prüfen
        $loginName = sonderzeichen($loginName);
        $password = sonderzeichen($password);

	//Daten aus dem File holen zur Überprüfung
	$handler = fopen($userDataFile, 'r');

	    $usernames = array();
	    $emails = array();
	    $passwords = array();	    

	    ini_set('auto_detect_line_endings',TRUE);
	    $row = 0;
	    $end = -1;
	    while (($data = fgetcsv($handler, 1000, ";")) !== FALSE ) {
	    	$num = count($data);
            	for ($c=0; $c < $num; $c+=3) {
               	    array_push($usernames, $data[$c]);
            	}
		for ($c=1; $c < $num; $c+=3) {
               	    array_push($emails, $data[$c]);
          	}
		for ($c=2; $c < $num; $c+=3) {
		    array_push($passwords, $data[$c]);
		}
		if($usernames[$row] == $loginName or $emails[$row] == $loginName)	{
		    $end = $row;
		    $grantName = $usernames[$row];
		}

		$row = $row + 1;		
	    }
	    ini_set('auto_detect_line_endings',FALSE);

	fclose($handler);

	//Daten werden geprüft
	if($end !== -1)	{
	    //Login successfull
	    if($passwords[$end] == $password)	{
		session_start();
		//Der Benutzername des Benutzers, welcher sich erfolgreich angemeldet hat wird per Session übergeben
                $_SESSION ['loginGranted'] = "" . $grantName;
	        header('Location: ../chat.php');
	    }	
	    //password wrong
	    else {
		session_start();
                $_SESSION ['wronglogin'] = "";
	        header('Location: ../login.php');
	    }
	}

	//loginname wrong
	else	{
	    session_start();
            $_SESSION ['wronglogin'] = "";
	    header('Location: ../login.php');
	}


    }





    //Ueberpruefung und wechseln von Sonderzeichen
    function sonderzeichen($string) {
        $string = str_replace("Ã¤", "ae", $string);
        $string = str_replace("Ã¼", "ue", $string);
        $string = str_replace("Ã¶", "oe", $string);
        $string = str_replace("Ã„", "Ae", $string);
        $string = str_replace("Ãœ", "Ue", $string);
        $string = str_replace("Ã–", "Oe", $string);
        $string = str_replace("ÃŸ", "ss", $string);
        $string = str_replace("Â´", "", $string);
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