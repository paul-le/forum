<?php 

    session_start();
    $connexion = mysqli_connect("localhost", "root", "", "forum");
    if(isset($_POST['validationthread']))
    {
        $nomthread = $_POST['threadname'];
        $descthread = $_POST['threaddescription'];
        $requeteinsertthread = "INSERT INTO thread (nom,description,id_topic) VALUES('".addslashes($nomthread)."','".addslashes($descthread)."','".$_GET['id']."')";
        $querythreadcreation = mysqli_query($connexion, $requeteinsertthread) ;

        header('Location:index.php');
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Forum index</title>
        <link rel="stylesheet" href="index.css">
        <meta charset="UTF-8">
    </head>
    <body>
    <?php include('header.php'); ?>
        <main>
            <?php     
                if(isset($_SESSION['login']))
                { ?>
            <form class="formcreationtopic" method="post" action="">
                <input type="text" name="threadname" placeholder="Nom du thread" required>
                <input type="text" name="threaddescription" placeholder="Description du thread" required>
                
                <input type="submit" name="validationthread" value="Valider">
            </form>
            <?php  } else { echo "Vous devez être admin pour créer un thread"; } ?>
        </main>
        </body>
        </html>