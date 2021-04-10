<?php
    $username = $email = $password = "";
    $userDataFile = '../datei/logindata.csv';


    //Wird ausgef�hrt, wenn das Formular zur Registriereung abgeschickt wurde.
    if(isset($_POST['submitRegister'])) {

	//Informationen von der Registrierseite holen   
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = hash('sha256', $_POST['password']);

	//Auf Sonderzeichen pr�fen
        $username = sonderzeichen($username);
        $email = sonderzeichen($email);

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
		if($usernames[$row] == $username or $emails[$row] == $email)	{
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

	    	fwrite($handler, $username . ";" . $email . ";" . $password . "\n");
	
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
	    session_start();
            $_SESSION ['wrongregistration'] = "";
	    header('Location: ../register.php');

	}
    }





    //Wird ausgef�hrt, wenn das Formular zur Registriereung abgeschickt wurde.
    if(isset($_POST['submitLogin']))    {

	//Informationen von der Registrierseite holen   
        $loginName = $_POST['loginName'];
        $password = hash('sha256', $_POST['password']);
	$grantName = "";

	//Auf Sonderzeichen pr�fen
        $loginName = sonderzeichen($loginName);
        $password = sonderzeichen($password);

	//Daten aus dem File holen zur �berpr�fung
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

	//Daten werden gepr�ft
	if($end !== -1)	{
	    //Login successfull
	    if($passwords[$end] == $password)	{
		session_start();
		//Der Benutzername des Benutzers, welcher sich erfolgreich angemeldet hat wird per Session �bergeben
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