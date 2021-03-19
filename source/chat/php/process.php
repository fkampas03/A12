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
	}
	//Fehler-Meldung wird auf der registration-Site ausgegeben
	else	{
	    session_start();
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