<?php
    session_start();
    if(isset($_SESSION['wrongregistration']))	{
	echo '<script language="javascript">';
	echo 'alert("Username or email adress already taken. Please try again!")';
	echo '</script>';    
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
    <link rel="stylesheet" href="style/style.css">

    <!--Importiert das Bootstrap script-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous" async></script>
    

    <title>Registrierung</title>
</head>
<body>
    <header>
        <nav class="navbar position-fixed top-0 w-100 navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <div class="col-lg-10 col-md-5 ms-3">
                    <a class="navbar-brand nav-font" href="overview.php">Umfrage</a>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav ">
                        <a class="nav-link active" aria-current="page" href="overview.php">Overview</a>
                    </div>
                </div>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav ">
                        <a class="nav-link active" aria-current="page" href="register.php"><b>Register</b></a>
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
    <div class="spacer"></div>
    <h1 class="display-3 text-center">Register</h1>
        <fieldset class="col-lg-6 col-md-8 col-sm-10 col-xs-11 mx-auto mt-5 py-4 px-5 fieldsetStyle">
            <form name="formRegister" action="php/process.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" minlength="8" required>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary" name="submitRegister">Register</button>
                </div>
                <div class="mb-2">
                    <a href="login.php" class="link">Already got an account? Login here!</a>
                </div>
            </form>
        </fieldset>
    </main>

    <footer class="text-white-50 text-center bg-secondary d-flex justify-content-center">
        <p class="fitem"> &copy; 2020 - 2021 Mimmler Florian, Felix Kampas </p>
        <form name="back" action="php/process.php" method="POST" enctype="multipart/form-data" style="width: 20%;">
            <button style="width: 100%" type="submit" name="back" value="back" class="btn btn-secondary backBut align-middle">zum Projektserver</button>
        </form>
    </footer>

    <?php
        session_destroy();
    ?>


</body>
</html>