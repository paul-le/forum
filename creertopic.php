<?php 

    session_start();
    $connexion = mysqli_connect("localhost", "root", "", "forum");

    

    if(isset($_POST['validationtopic']))
    {
        $nomtopic = $_POST['topicname'];
        $desctopic = $_POST['topicdescription'];
        $requeteinserttopic = "INSERT INTO topic (nom,description,etat) VALUES('".addslashes($nomtopic)."','".addslashes($desctopic)."','".$_POST['etat']."')";
        $querytopiccreation = mysqli_query($connexion, $requeteinserttopic);
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
                if(isset($_SESSION['login']) && ($_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'Modo'))
                { ?>
            <form class="formcreationtopic" method="post" action="">
                <input type="text" name="topicname" placeholder="Nom du topic" required><br>
                <input type="text" name="topicdescription" placeholder="Description du topic" required><br>
                <select type="post" name="etat"><br>
                    
                    <option value="prive">Prive</option>
                    <option value="public">Public</option>
                </select><br>
                <input type="submit" name="validationtopic" value="Valider">
            </form>
            <?php  } else { echo "Vous devez être admin pour créer un topic"; } ?>
        </main>
        </body>
        </html>