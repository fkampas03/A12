<?php
    session_start();

    $pdo = new PDO ( 'mysql:host=localhost;dbname=db3bhit_s11' , 'db3bhit_s11' , 'ohphiM9z' ); 

    $ID[];
    $username[];
    $frage[];
    $anonym[];

    $select = "SELECT ID, username, frage, anonym FROM fragen WHERE username=$_SESSION['username']";
    foreach ( $pdo -> query ( $select ) as $row ) { 
    	$ID[] = $row["ID"];
        $username[] = $row["username"];
        $frage[] = $row["frage"];
        $anonym[] = $row["anonym"];
    }

    for($i = 0; $i<count($ID);$i++) {
        ?>
        <fieldset class="col-lg-10 col-md-10 col-sm-10 col-xs-11 mx-auto mt-5 py-4 px-5" style="border: 2px solid black; border-radius: 2em;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <?php 
                            if($anonym==0){
                                echo "<b>" . "Survey" . "</b>" . " by <i>" . $username[$i] . "</i>" . "<br><br>" . $frage[$i];
                            } else {
                                echo "<b>" . "Survey" . "</b>" . " by <i>" . "-Anonym-" . "</i>" . "<br><br>" . $frage[$i];
                            }
                            
                        ?>
                    </div>
                    <form name="<?php echo $ID[];?>" action="php/processUmfrage.php" method="POST" enctype="multipart/form-data" class="w-100 ">
                        <div class="w-25 m-1 p-2 text-center">
                            <div class="m-2">
                                <button style="width: 100%" type="submit" name="action" value="ja" class="btn btn-success">Yes</button>
                            </div>
                            <div class="m-2">
                                <button style="width: 100%" type="submit" name="action" value="nein" class="btn btn-danger">No</button>
                            </div>
                        </div>
                    </form>    
                </div>
            </div>    
        </fieldset>
    <?php }
    
?>