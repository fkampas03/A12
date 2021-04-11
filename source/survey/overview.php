<?php
    
    session_start();

    function createEintraege($creator, $topic, $text, $link)	{
        echo "<br>";	
        createEintrag($creator, $topic, $text, $link);
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
    <link rel="stylesheet" href="style/styleLogin.css">

    <!--Importiert das Bootstrap script-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous" async></script>
    

    <title>Umfragen</title>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <div class="col-lg-10 col-md-5 ms-3">
                    <a class="navbar-brand nav-font" href="overview.php">Umfrage</a>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav ">
                        <a class="nav-link active" aria-current="page" href="overview.php"><b>Overview</b></a>
                    </div>
                </div>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav ">
                        <a class="nav-link active" aria-current="page" href="register.php">Register</a>
                    </div>
                </div>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav ">
                        <a class="nav-link active" aria-current="page" href="login.php">Login</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <?php 
        //Die Methode create Eintrage muss hier aufgerufen werden
        createEintraege("Felix", "Survey", "Dies ist ein Test", "login.php");
        function createEintrag($creator, $topic, $text, $link) {?>
            <fieldset class="col-lg-9 col-md-10 col-sm-10 col-xs-11 mx-auto mt-5 py-4 px-5" style="border: 2px solid pink; border-radius: 2em;">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <?php 
                                echo '<a href="' . $link . '"><b>' . $topic . "</b></a>" . " by <i>" . $creator . "</i>" . "<br><br>" . $text;
                            ?>
                        </div>    
                    </div>
                </div>    
            </fieldset>
        <?php }?>

    </main>

    <footer class="text-white-50 text-center bg-secondary">
      <p> &copy; 2020 - 2021 Mimmler Florian, Felix Kampas </p>
    </footer>

    <?php
        session_destroy();
    ?>

</body>
</html>

