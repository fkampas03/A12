<?php
    session_start();
    if(isset($_SESSION['wronglogin']))	{
	echo '<script language="javascript">';
	echo 'alert("Username/email or password are incorrect. Please try again!")';
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
    <link rel="stylesheet" href="style/styleLogin.css">
    <link rel="stylesheet" href="style/style.css">

    <!--Importiert das Bootstrap script-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous" async></script>
    

    <title>Login</title>
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
                        <a class="nav-link active" aria-current="page" href="register.php">Register</a>
                    </div>
                </div>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav ">
                        <a class="nav-link active" aria-current="page" href="login.php"><b>Login</b></a>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <main>
    <div class="spacer"></div>
    <h1 class="display-3 text-center">Login</h1>
        <fieldset class="col-lg-6 col-md-8 col-sm-10 col-xs-11 mx-auto mt-5 py-4 px-5 fieldsetStyle">
            <form name="formLogin" action="php/process.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="loginName" class="form-label">Username or Email</label>
                    <input type="text" class="form-control" id="loginName" name="loginName" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" minlength="8" required>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary" name="submitLogin">Login</button>
                </div>
                <div class="mb-2">
                    <a href="register.php" class="link">Havent't got an account yet? Register here!</a>
                </div>
            </form>
        </fieldset>
    </main>

    <footer class="text-white-50 text-center bg-secondary d-flex justify-content-center">
        <p class="fitem"> &copy; 2020 - 2021 Mimmler Florian, Felix Kampas </p>
        <form name="back" action="php/process.php" method="POST" enctype="multipart/form-data" style="width: 20%;">
            <button style="width: 100%" type="submit" name="back" value="back" class="btn btn-secondary backBut">zum Projektserver</button>
        </form>
    </footer>

</body>
</html>

