<?php
    $username = $email = $password = "";
    $userDataFile = '../datei/logindata.csv';


    //Wird ausgeführt, wenn das Formular zur Registriereung abgeschickt wurde.
    if(isset($_POST['submitRegister'])) {

	//Informationen von der Registrierseite holen   
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = hash('sha256', $_POST['password']);

	//Auf Sonderzeichen prüfen
        $username = sonderzeichen($username);
        $email = sonderzeichen($email);

	//Daten aus dem File holen zur Überprüfung
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





    //Wird ausgeführt, wenn das Formular zur Registriereung abgeschickt wurde.
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
                $_SESSION ['username'] = "" . $grantName;
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