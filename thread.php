<?php

    
    session_start();
    $connexion = mysqli_connect("localhost", "root","","forum");
    $requetemessage="SELECT * FROM messagesthreads WHERE id_thread = '".$_GET['id']."'";
    $querymessage = mysqli_query($connexion,$requetemessage);
    $resultatmessage = mysqli_fetch_all($querymessage);
   
    //FAIRE UNE REQUETE POUR RECUPERER INFOS PROFIL
    $requeteUser="SELECT * from utilisateurs WHERE id = '".$_SESSION['id']."'";
    $queryUser = mysqli_query($connexion,$requeteUser);
    $resultatUser = mysqli_fetch_assoc($queryUser);
  
    
    $countMessage = count($resultatmessage) ; 
    echo "".$_SESSION['id']."";
    $date = date("Y-m-d H:i:s");

    if(isset($_POST['envoyermessage']))
    {   
        $messageenvoye= $_POST['messagethread'];
        $idthread="".$_GET['id']."";
        $requeteinsertmessagethread ="INSERT INTO messagesthreads (id_thread,id_utilisateur,messages,date) VALUES ('".$_GET['id']."','".$_SESSION['id']."' , '".$messageenvoye."','".$date."')";
        echo $requeteinsertmessagethread;
        $queryinsertmessagethread = mysqli_query($connexion,$requeteinsertmessagethread);
        header('Location:thread.php?id='.$_GET['id'].'');
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

                <?php 
                    $message = 0;

                    while($message != $countMessage)
                    { ?>
                        <section id="threadmainsection">
                            <section id="threadsectionflex">
                                <section id="threadcoteprofil">
                                    <article>
                                        <h2><?php echo $resultatUser['login']; ?></h2>
                                        <?php
                                            if (!empty($resultatUser['avatar'])) 
                                        { ?>

                                            <img src="avatar/<?php echo $resultatUser['avatar'] ?>" width="100" ><br><br>
                                        <?php
                                            }
                                        ?><br>
                                        Infos du profil
                                    </article>
                                </section>
                            <section id="threadcotemessage">
                                <article>
                                    
                                    <?php 
                                        echo $resultatmessage[$message][3] ;

                                    ?>
                                    <br />
                                    <div id="vote">
                                        <a href="vote.php?t=1&id=<?php echo "".$resultatmessage[$message][0].""; ?>">Like</a>
                                        <br />
                                        <a href="vote.php?t=2&id=<?php echo "".$resultatmessage[$message][0].""; ?>">Dislike</a>
                                    </div>
                                    <dir id="delete">
                                            <a href="delete.php?id=<?php echo "".$resultatmessage[$message][0].""; ?>">Supprimer></a>                                       
                                    </dir>
                                   
                                    <?php
                                        $message++ ;
                                    ?>        
                                </article>
                            </section>
                        </section>
                    </section>
                    <?php } ?>
                            
            
            <!-- PARTIE ENVOIE DU MESSAGE -->
            <!-- PARTIE ENVOIE DU MESSAGE -->
            <!-- PARTIE ENVOIE DU MESSAGE -->
            <section id="threadenvoiemessage">
                <h2>Envoyer un message</h2>
                    <form id="formenvoiemessage" method="post" action="">
                        <textarea id="textareaenvoiemessage" name="messagethread" rows="5" cols="33" placeholder="Votre message"></textarea><br>
                        <input id="envoiemessagebouton" type="submit" name="envoyermessage" value="Envoyer">
                    </form>
            </section>
        </main>
    </body>

    