<?php 

    session_start();
    $connexion = mysqli_connect("localhost", "root","","forum");
    $requetetopic = "SELECT nom,description FROM topic";
    $query = mysqli_query($connexion,$requetetopic);
    $resultat = mysqli_fetch_all($query);

    $topicscounter = count($resultat);

    $topicid= "SELECT id FROM topic";
    $queryidtopic = mysqli_query($connexion,$topicid);
    $resultatidtopic = mysqli_fetch_all($queryidtopic);

    $requetePersonnesInscrites = "SELECT login FROM utilisateurs";
    $queryPersonnesInscrites = mysqli_query($connexion,$requetePersonnesInscrites);
    $resultatPersonnesInscrites = mysqli_fetch_all($queryPersonnesInscrites);

    $PersonnesCounter = count($resultatPersonnesInscrites);

    $requeteNombreMessages = "SELECT messages FROM messagesthreads";
    $queryNombreMessages = mysqli_query($connexion,$requeteNombreMessages);
    $resultatNombreMessages = mysqli_fetch_all($queryNombreMessages);

    $NombreMessagesCounter = count($resultatNombreMessages);

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
            <!-- PARTIE TOP FORUM --> 
            <!-- PARTIE TOP FORUM -->
            <!-- PARTIE TOP FORUM --> 
            <!-- PARTIE TOP FORUM --> 
            <!-- PARTIE TOP FORUM --> 
            <!-- PARTIE TOP FORUM --> 
            <section id="welcomesection">
                <h1 id="welcomeh1">B i e n v e n u e</h1>
                <article id="welcomeyuno">
                    <img id="welcomeyuno2" src="Images/yuno gasai.png">
                </article>
            </section>
            <section id="reglesmainsection">
                <section>
                    <h1 id="regleh1">&nbsp;&nbsp;Règles du forum</h1>
                </section>
                <section id="endessousdutitreflex">
                    <section id="topicicon">
                        <img src="Images/nonewmessage.png">
                    </section> 
                    <section id="topicflex1">
                        <section id="topicflex2">
                            <article class="toastpoussage">A lire avant de poster !</article>
                        </section>
                        <section id="topicflex3">
                            <article>Code de conduite</article>
                        </section>
                    </section>
                    <section class="toastpoussage2">
                        <article class="toastpoussage3">
                            1 message<br>
                            1 sujet
                            
                        </article>
                    </section>
                    <section class="toastpoussage4";>
                        <article class="toastpoussage5">
                            Dernier message envoyé par Paul le 29/01/2020 à 11h34.
                        </article>
                    </section>
                </section>
            </section>  
            <!-- PARTIE DISCUSSION -->
            <!-- PARTIE DISCUSSION --> 
            <!-- PARTIE DISCUSSION --> 
            <!-- PARTIE DISCUSSION --> 
            <!-- PARTIE DISCUSSION --> 
            <!-- PARTIE DISCUSSION --> 
            <!-- PARTIE DISCUSSION --> 
            <!-- PARTIE DISCUSSION --> 
            <section id="discussionsmainsection">
                <section>
                    <h1 id="discussionsh1">&nbsp;&nbsp;Discussions</h1>
                </section>
                <?php 

                    
                    $i = 0;
                    while($i != $topicscounter)
                    {
                        $resultatmeta = utf8_encode($resultat[$i][0]);
                        $resultatmeta2 = utf8_encode($resultat[$i][1]);
                    ?>
                    <section id="endessousdutitreflex">
                        <section id="topicicon">
                            <img src="Images/nonewmessage.png">
                        </section> 
                    <section id="topicflex1">
                        <section id="topicflex2">
                            <article class="toastpoussage"><a href="topic.php?id=<?php echo $resultatidtopic[$i][0];?>"><?php echo $resultatmeta;?></a></article>
                    </section>
                    <section id="topicflex3">
                        <article>
                            <?php echo "".$resultatmeta2."" ?>
                        </article>
                    </section>
                    </section>
                    <section class="toastpoussage2">
                        <article class="toastpoussage3">
                            /////
                            <?php


                                

                            ?>

                           <br />
                            <?php 

                                
                                $connexion = mysqli_connect("localhost","root","","forum");
                                $allThread = "SELECT nom FROM thread WHERE id_topic = ".$resultatidtopic[$i][0]."";
                                
                                $queryThread = mysqli_query($connexion,$allThread) ;
                                $resultallThread = mysqli_fetch_all($queryThread) ;

                                $countThread = count($resultallThread) ;
                                echo $countThread." Sujet";


                            ?>
                        </article>
                    </section>
                    <section class="toastpoussage4";>
                        <article class="toastpoussage5">
                            Dernier message envoyé par Paul le 29/01/2020 à 11h34.
                            <?php
                                                            

                            ?>
                        </article>
                    </section>
                    </section>
                    <?php
                    $i++;
                } ?>
                <section id="infosmainsection">
                    <section id="informationsectionflex">
                        <h1 id="infosh1">&nbsp;&nbsp;Informations</h1>
                        <article id="infosarticle">
                            Il y a [<?php echo $PersonnesCounter ?>] personnes inscrites.<br>
                            Il y a [<?php echo $NombreMessagesCounter ?>] messages envoyés.
                        </article>
                    </section>
                    <article>
                        <a href="creertopic.php"><img id="creertopicbouton" src="Images/boutoncreertopic.png"></a>
                        <img id="imageenbas" src="Images/animeicon.png">
                    </article>
                </section>
                
            </section>
        </main>
        </body>
        </html>