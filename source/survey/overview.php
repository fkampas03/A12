<?php
    session_start();

    if(isset($_POST['logout'])) {
		session_destroy();
        $_SESSION = [];
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
    <link rel="stylesheet" href="style/style.css">

    <!--Importiert das Bootstrap script-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous" async></script>
    

    <title>Umfragen</title>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
                <div class="col-lg-9 col-md-5 ms-3">
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

                <?php
                
                if(!empty($_SESSION['username'])) {
                    ?>

                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <div class="navbar-nav ">
                            <a class="nav-link active" aria-current="page" href="erstellen.php">create Survey</a>
                        </div>
                    </div>
                    
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <form name="logoutForm" action="overview.php" method="POST" enctype="multipart/form-data" style="width: 100%;">
                            <div class="m-2">
                                <button style="width: 100%" type="submit" name="logout" value="logout" class="btn btn-secondary">Log Out</button>
                            </div>
                        </form>
                    </div>


                    <?php
                } else {

                ?>

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
                <?php
                }
                ?>
            </div>
        </nav>
    </header>
    <main>
    <?php
    $pdo = new PDO ( 'mysql:host=localhost;dbname=db3bhit_s11' , 'db3bhit_s11' , 'ohphiM9z' ); 

    $IDs = array();
    $usernames = array();
    $fragen = array();
    $anonyms = array();
    $public = array();

    if(!empty($_SESSION['username'])) {
        $username = $_SESSION['username'];
    }

    $select = "SELECT ID, username, frage, anonym, public FROM fragen";
    foreach ( $pdo -> query ( $select ) as $row ) { 
    	$IDs[] = $row["ID"];
        $usernames[] = $row["username"];
        $fragen[] = $row["frage"];
        $anonyms[] = $row["anonym"];
        $public[] =  $row["public"];
    }

    for($i = 0; $i<count($IDs);$i++) {
        if($usernames[$i] == $_SESSION['username']) {
        ?>
            <fieldset class="col-lg-10 col-md-10 col-sm-10 col-xs-11 mx-auto mt-5 py-4 px-5 fieldsetStyle yourSurvey">
                <legend>
                    Your Survey
                </legend>
        <?php
        } else {
            ?>
                <fieldset class="col-lg-10 col-md-10 col-sm-10 col-xs-11 mx-auto mt-5 py-4 px-5 Survey fieldsetStyle">
            <?php
        }
        ?>
            <div class="container">
                <div class="row d-flex flex-column">
                    <div class="col-lg-6 d-felx flex-row">
                        <?php 
                            if($anonyms[$i]==0){
                                echo "<p class=\"header2\">Survey by " . $usernames[$i] . "</p><p class=\"headerFrage\">" . $fragen[$i] . "</p>";
                            } else {
                                echo "<p class=\"header2\">Survey by -Anonym-</p><p class=\"headerFrage\">" . $fragen[$i] . "</p>";
                            }
                            
                        ?>
                    </div>
                    <div class="d-flex">
                        <form name="Survey" action="php/processUmfrage.php" method="POST" enctype="multipart/form-data" style="width: 50%;">
                            <div class="w-100 m-1 p-2 text-center">
                                <input type="hidden" name="ID" value="<?php echo $IDs[$i];?>">
                                <div class="m-2">
                                    <button style="width: 100%" type="submit" name="action" value="ja" class="btn btn-success">Yes</button>
                                </div>
                                <div class="m-2">
                                    <button style="width: 100%" type="submit" name="action" value="nein" class="btn btn-danger">No</button>
                                </div>
                            </div>
                        </form>
                        <?php 
                            if($public[$i]!=0 || $usernames[$i] == $_SESSION['username']) {
                            ?>
                            <div class="ergebnis" style="width: 30%; text-align: center;">
                                <?php 
                                    $ii = $i + 1;
                                    unset($IDj);
                                    unset($IDn);
                                    $select = "SELECT ID FROM antworten WHERE fragenID=\"$ii\" AND antwort=\"ja\"";
                                    foreach ( $pdo -> query ( $select ) as $row ) { 
                                        $IDj[] = $row["ID"];
                                    }
                                    $select = "SELECT ID FROM antworten WHERE fragenID=\"$ii\" AND antwort=\"nein\"";
                                    foreach ( $pdo -> query ( $select ) as $row ) { 
                                        $IDn[] = $row["ID"];
                                    }

                                    echo "<p>Ergebnis:</p><p>Ja: ". count($IDj) ."</p><p>Nein: ". count($IDn) ."</p>"
                                
                                ?>
                            </div> 
                        <?php 
                        }

                        if($usernames[$i] == $_SESSION['username']) {

                            ?>
                            <div style="width: 33%;">
                            <form name="showSolution" action="php/processUmfrage.php" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="ID" value="<?php echo $IDs[$i];?>">
                                <?php

                                    if($public[$i]==0) {
                                        echo "<button style=\"width: 100%\" type=\"submit\" name=\"showSolution\" value=\"showSolution\" class=\"btn btn-info\">Ergbnis veröffentlichen</button>";
                                    } else {
                                        echo "<button style=\"width: 100%\" type=\"submit\" name=\"hideSolution\" value=\"hideSolution\" class=\"btn btn-info\">Ergbnis privat machen</button>";
                                    }

                                ?>
                            </form>
                        </div>
                            <?php

                        }
                        ?>
                    </div> 
                </div>
            </div>    
        </fieldset>
    <?php 
    }
    
?>

    </main>

    <footer class="text-white-50 text-center bg-secondary">
      <p> &copy; 2020 - 2021 Mimmler Florian, Felix Kampas </p>
    </footer>

</body>
</html>

