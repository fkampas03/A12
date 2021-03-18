<?php
    $username = $email = $password = "";

    if(isset($_POST['submitRegister'])) {   
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $username = sonderzeichen($username);
        $email = sonderzeichen($email);
        $password = sonderzeichen($password);

        $empfaenger = $email;
        $betreff = "Die Mail funktioniert";
        $from = "From: Felix Kampas <medt.infos@gmail.com>\r\n";
        $from .= "Reply-To: medt.infos@gmail.com\r\n";
        $from .= "Content-Type: text/html\r\n";
        $text = "Hola Amigo";
        $mail($empfaenger, $betreff, $text, $from);

    }

    if(isset($_POST['submitLogin']))    {

    }


    //Überprüfung und wechseln von Sonderzeichen
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