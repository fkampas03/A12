<?php
    session_start();
    if(isset($_SESSION['wrongregistration']))	{
	echo '<script language="javascript">';
	echo 'alert("Username or email adress already taken. Please try again!")';
	echo '</script>';    
    }
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--Importiert das Bootstrap css-File-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <!--Importiert das css-File-->
    <link rel="stylesheet" href="style/styleRegister.css">
    

    <!--Importiert das Bootstrap script-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous" async></script> 
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity= "sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous" async></script>

    <script>
	
	function leftButtonClicked(leftOrRight)	{
	    if(leftOrRight == "left")	{
		document.getElementById("buttonLeft").value = "1";
	    }
	}
	function rightButtonClicked(leftorRight)	{
	    if(leftOrRight == "right")	{
		document.getElementById("buttonRight").value = "1";
	    }

	}

	function createDirection() {
	    let leftOrRight = "";
	    let random = Math.random();
	    if(random < 0.5)	{
	    	leftOrRight = "left";
	    }
	    else	{
	    	leftOrRight = "right";
	    }
	    return leftOrRight;
	}

	let leftOrRight = createDirection();

	setInterval(function(){
	    if(document.getElementById("buttonRight").value == "1" || document.getElementById("buttonLeft").value == "1")	{
		document.getElementById("btnSubmit").disabled = false;
		//alert("hello");
	    }
	}, 1000);
	
    </script>

    <title>Registrierung</title>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <div class="col-lg-11 col-md-8 ms-5">
                    <a class="navbar-brand nav-font" href="#">Chat</a>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav ">
                        <a class="nav-link active" aria-current="page" href="login.php">Login</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <fieldset class="col-lg-6 col-md-8 col-sm-10 col-xs-11 mx-auto mt-5 py-4 px-5 fieldsetStyle">
            <legend>Register</legend>
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
            	    <!-- Button trigger modal -->
            	    <button type="button" class="btn btn-light mb-3" data-toggle="modal" data-target="#modal">Captcha</button>
  
            	    <!-- Modal -->
            	    <div class="modal fade" id="modal">
                	<div class="modal-dialog">
                    	    <div class="modal-content">
                        	<div class="modal-header">
                            	    <h5 class="modal-title">Captcha</h5>
                            	    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                	<span aria-hidden="true">x</span>
                            	    </button>
                        	</div>
                        	<div class="modal-body">
                            	    Click the <script>document.write(leftOrRight);</script> button to confirm you're not a robot!
                        	</div>
                        	<div class="modal-footer">
                            	    <button type="button" class="btn btn-primary" id="buttonLeft" name="buttonLeft" data-dismiss="modal" onclick="leftButtonClicked(leftOrRight)" value="0">left</button>
                            	    <button type="button" class="btn btn-primary" id="buttonRight" name="buttonRight" data-dismiss="modal" onclick="rightButtonClicked(leftOrRight)" value="0">right</button>
                        	</div>
                    	    </div>
                   	</div>
            	    </div>
		</div>		
		<div class="mb-3">
                    <button disabled="true" type="submit" class="btn btn-primary" name="submitRegister" id="btnSubmit">Register</button>
                </div>
                <div class="mb-2">
                    <a href="login.php" class="link">Already got an account? Login here!</a>
                </div>
            </form>
        </fieldset>
    </main>

    <footer class="text-white-50 text-center bg-secondary">
      <p> &copy; 2020 - 2021 Mimmler Florian, Felix Kampas </p>
    </footer>

    <?php
        session_destroy();
    ?>


</body>
</html>