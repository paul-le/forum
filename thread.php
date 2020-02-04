<?php

    session_start();
    $connexion = mysqli_connect("localhost", "root","","forum");
    $requetemessage="SELECT * FROM message WHERE id_topic = '".$_GET['id']."'";
    $querymessage = mysqli_query($connexion,$requetemessage);
    $resultatmessage = mysqli_fetch_array($querymessage);
    /*FAIRE UNE REQUETE POUR RECUPERER INFOS PROFIL*/
    $requeteiduser="SELECT id from utilisateurs WHERE id= '".$_SESSION['id']."'";
    $queryiduser = mysqli_query($connexion,$requeteiduser);
    $resultatiduser = mysqli_fetch_array($queryiduser);
    $messageenvoye= $_POST['messagethread'];
    $datenow = date("Y-m-d H:i:s");

    var_dump($resultatiduser);

    if(isset($_POST['envoyermessage']))
    {
        $requeteinsertmessagethread="INSERT INTO message (id_thread,id_utilisateur,message,date) VALUES (''".$_GET['id']."','".$resultatiduser[0][0]."' , '".$messageenvoye."','".$datenow."')";
    }

    /* RECUPERER L'ID */
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
        <section id="threadtop">
                <section>
                    <h1 id="discussionsh1">&nbsp;&nbsp;Titre du thread</h1>
                </section>
            <section id="threadmainsection">
                <section id="threadsectionflex">
                    <section id="threadcoteprofil">
                        <article>
                            <h2>Pseudo</h2>
                            Photo du profil<br>
                            Infos du profil
                        </article>
                    </section>
                    <section id="threadcotemessage">
                        <article>
                            titre thread<br>
                            message
                        </article>
                    </section>
                </section>
            </section>
            <!-- PARTIE ENVOIE DU MESSAGE -->
            <!-- PARTIE ENVOIE DU MESSAGE -->
            <!-- PARTIE ENVOIE DU MESSAGE -->
            <section id="threadenvoiemessage">
                <h2>Envoyer un message</h2>
                    <form id="formenvoiemessage">
                        <textarea id="textareaenvoiemessage" name="messagethread" rows="5" cols="33" placeholder="Votre message"></textarea><br>
                        <input id="envoiemessagebouton" type="submit" name="envoyermessage" value="Envoyer">
                    </form>
            </section>
        </main>
    </body>