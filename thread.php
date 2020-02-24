<?php

    
    session_start();
    $connexion = mysqli_connect("localhost", "root","","forum");
    $requetemessage="SELECT messagesthreads.id,id_thread,id_utilisateur,messages,date,utilisateurs.id,login,avatar,role FROM messagesthreads INNER JOIN utilisateurs ON utilisateurs.id = id_utilisateur WHERE id_thread = '".$_GET['id']."'";
    $querymessage = mysqli_query($connexion,$requetemessage);
    $resultatmessage = mysqli_fetch_all($querymessage);


    //FAIRE UNE REQUETE POUR RECUPERER INFOS PROFIL
    $requeteUser="SELECT * from utilisateurs WHERE id = '".$_SESSION['id']."'";
    $queryUser = mysqli_query($connexion,$requeteUser);
    $resultatUser = mysqli_fetch_assoc($queryUser);
  
    
    $countMessage = count($resultatmessage) ; 
    $date = date("Y-m-d H:i:s");

    if(isset($_POST['envoyermessage']))
    {   
        $messageenvoye= $_POST['messagethread'];
        $idthread="".$_GET['id']."";
        $requeteinsertmessagethread ="INSERT INTO messagesthreads (id_thread,id_utilisateur,messages,date) VALUES ('".$_GET['id']."','".$_SESSION['id']."' , '".addslashes($messageenvoye)."','".$date."')";
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
                                        <h2><?php echo $resultatmessage[$message][6]; ?></h2>
                                        <?php
                                            if (!empty($resultatmessage[$message][7])) 
                                        { ?>
                                        <?php
                                            if ($resultatmessage[$message][7] != 'VIDE')
                                            { ?>
                                            <img src="avatar/<?php echo $resultatmessage[$message][7] ?>" width="180" ><br><br>
                                        <?php
                                        }}
                                        ?><br>
                                        <a href="profil.php?id=<?php echo $resultatmessage[$message][5]; ?>">Infos du profil</a>
                                    </article>
                                </section>
                            <section id="threadcotemessage">
                                <article>
                                    <section id="messagethreadsection">
                                    <?php 
                                        echo $resultatmessage[$message][3] ;
                                    ?>
                                    </section>
                                    <?php
                                        $likes = "SELECT valeur FROM vote WHERE id_message = ".$resultatmessage[$message][0]." AND valeur = 1";

                                        $queryLikes = mysqli_query($connexion,$likes) ;
                                        $resultLikes = mysqli_fetch_all($queryLikes) ;
                                        $countLikes = count($resultLikes) ;



                                        $disLikes = "SELECT valeur FROM vote WHERE id_message = ".$resultatmessage[$message][0]." AND valeur = 2";

                                        $queryDislikes = mysqli_query($connexion,$disLikes) ;
                                        $resultDislikes = mysqli_fetch_all($queryDislikes) ;
                                        
                                       

                                        $countDislikes = count($resultDislikes) ;

                                    ?>
                                    <br/>
                                    <section id="systemlike">
                                    <?php if(isset($_SESSION['login'])){ ?>
                                    <div id="vote">
                                        <a href="vote.php?t=1&id=<?php echo "".$resultatmessage[$message][0].""; ?>"><img src="Images/thumbup.png"></a><?php echo $countLikes ;?>

                                        <a href="vote.php?t=2&id=<?php echo "".$resultatmessage[$message][0].""; ?>"><img src="Images/thumbdown.png"></a><?php echo $countDislikes ;?>
                                    </div>
                                    
                                    <?php if($_SESSION['role'] == "Admin" || $_SESSION['role'] == 'Modo'){ ?>
                                    <div id="delete">
                                            <a href="delete.php?id=<?php echo "".$resultatmessage[$message][0].""; ?>">Supprimer</a>                                       
                                    </div>
                                    <?php }} ?>
                                    </section>
                                   
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
                <?php if(isset($_SESSION['login'])){ ?>
                <h2>Envoyer un message</h2>
                    <form id="formenvoiemessage" method="post" action="">
                        <textarea id="textareaenvoiemessage" name="messagethread" rows="5" cols="33" placeholder="Votre message"></textarea><br>
                        <input id="envoiemessagebouton" type="submit" name="envoyermessage" value="Envoyer">
                    </form>
                <?php } else { echo "Veuillez vous connecter pour envoyer un message !";} ?>
            </section>
        </main>
    </body>

    