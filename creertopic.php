<?php 

    session_start();
    $connexion = mysqli_connect("localhost", "root", "", "forum");
    if(isset($_POST['validationtopic']))
    {
        $nomtopic = $_POST['topicname'];
        $desctopic = $_POST['topicdescription'];
        $requeteinserttopic = "INSERT INTO topic (nom,description) VALUES('$nomtopic','$desctopic')";
        $querytopiccreation = mysqli_query($connexion, $requeteinserttopic) ;
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
                if(isset($_SESSION['login']) && $_SESSION['login'] == 'admin')
                { ?>
            <form method="post" action="">
                <input type="text" name="topicname" placeholder="Nom du topic" required>
                <input type="text" name="topicdescription" placeholder="Description du topic" required>
                <input type="submit" name="validationtopic" value="Valider">
            </form>
            <?php  } else { echo "Vous devez être admin pour créer un topic"; } ?>
        </main>
        </body>
        </html>