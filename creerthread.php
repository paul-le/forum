<?php 

    session_start();
    $connexion = mysqli_connect("localhost", "root", "", "forum");
    $requeteEtatTopic = "SELECT etat FROM topic WHERE id = ".$_GET['id']."";
    $queryEtatTopic = mysqli_query($connexion, $requeteEtatTopic);
    $resultEtatTopic = mysqli_fetch_all($queryEtatTopic);
    var_dump($resultEtatTopic[0][0]);
    
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

            if((isset($_SESSION['login']) && ($resultEtatTopic[0][0] == 'prive') && ($_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'Modo'))){
                if((isset($_SESSION['login']) && $resultEtatTopic[0][0] == 'prive' && ($_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'Modo')))
                { ?>
            <form class="formcreationtopic" method="post" action="">
                <input type="text" name="threadname" placeholder="Nom du thread" required><br>
                <input type="text" name="threaddescription" placeholder="Description du thread" required><br>
                <input type="submit" name="validationthread" value="Valider">
            </form>
            <?php  } else { echo "Vous devez être admin pour créer un thread dans un topic privé !"; }}


            if((isset($_SESSION['login']) && $resultEtatTopic[0][0] == 'public' || $_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'Modo' || $_SESSION['role'] == 'Membre')){
                if(((isset($_SESSION['login']) && $resultEtatTopic[0][0] == 'public') || ($_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'Modo' || $_SESSION['Membre'])))
                { ?>
            <form class="formcreationtopic" method="post" action="">
                <input type="text" name="threadname" placeholder="Nom du thread" required><br>
                <input type="text" name="threaddescription" placeholder="Description du thread" required><br>
                <input type="submit" name="validationthread" value="Valider">
            </form>
            <?php  } else { echo "Vous devez être connecté(e) !"; }} ?>
        </main>
        </body>
        </html>