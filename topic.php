<?php 
    
    if (isset($_GET['id'])) 
    {
        $connexion = mysqli_connect("localhost","root","","forum");
        $requetethread2 = "SELECT * FROM thread WHERE id_topic = ".$_GET['id']."";
        echo $requetethread2;
        $querythread2 = mysqli_query($connexion, $requetethread2);
        $resultatthread2 = mysqli_fetch_all($querythread2);
        $requete = "SELECT th.id_topic , th.nom , th.description , too.id , too.nom FROM thread AS th INNER JOIN topic AS too ON th.id_topic = too.id  WHERE id_topic = '".$_GET['id']."'";
        $queryusers = mysqli_query($connexion, $requete);
        $resultatthread = mysqli_fetch_all($queryusers);
        var_dump($resultatthread2);
        
        $threadcounter = count($resultatthread);
        echo $threadcounter;

        $threadid= "SELECT id FROM thread";
        $queryidthread = mysqli_query($connexion,$threadid);
        $resultatidthread = mysqli_fetch_all($queryidthread);
        $topicid= "SELECT id FROM topic";
        $queryidtopic = mysqli_query($connexion,$topicid);
        $resultatidtopic = mysqli_fetch_all($queryidtopic);

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
            <!-- PARTIE TOP FORUM --> 
            <!-- PARTIE TOP FORUM -->
            <!-- PARTIE TOP FORUM --> 
            <!-- PARTIE TOP FORUM --> 
            <!-- PARTIE TOP FORUM --> 
            <!-- PARTIE TOP FORUM --> 
            <section id="welcomesection">
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
                    <h1 id="discussionsh1">&nbsp;&nbsp;Discussions A CHANGER PAR RAPPORT AU NOM DU TOPIC EN QUESTION</h1>
                </section>
                <?php 

                $i = 0;

                while($i != $threadcounter)
                {
                $resultatmeta = utf8_encode($resultatthread[$i][1]);
                $resultatmeta2 = utf8_encode($resultatthread[$i][2]);
                
                ?>
                <section id="endessousdutitreflex">
                        <section id="topicicon">
                            <img src="Images/nonewmessage.png">
                        </section>
                        <section id="topicflex1">
                        <section id="topicflex2">
                            <article class="toastpoussage"><a href="thread.php?id=<?php echo "".$resultatthread2[$i][0]."";?>"><?php echo $resultatmeta;?></a>
                            </article>
                    </section>
                    <section id="topicflex3">
                        <article>
                            <?php echo "".$resultatmeta2."" ?>
                        </article>
                    </section>
                    </section>
                    <section class="toastpoussage2">
                        <article class="toastpoussage3">
                            <?php
                                $connexion = mysqli_connect("localhost","root","","forum");
                                $allMessages = "SELECT messages FROM messagesthreads WHERE id_thread = ".$resultatthread2[$i][0]."";
                                
                                $queryMessages = mysqli_query($connexion,$allMessages) ;
                                $resultAllMessages = mysqli_fetch_all($queryMessages) ;

                                $countMessages = count($resultAllMessages) ;
                                echo $countMessages." Messages";




                            ?>
                        </article>
                    </section>
                    <section class="toastpoussage4";>
                        <article class="toastpoussage5">
                            Dernier message envoyé par Paul le 29/01/2020 à 11h34.
                        </article>
                    </section>
                    </section>
                    <?php
                        $i++; 
                        } 
                    ?>
                    </article>
                </section>
                <a href="creerthread.php?id=<?php echo "".$_GET['id']."";?>"><img id="creertopicbouton" src="Images/boutoncreerthread.png"></a>
            </section>
        </main>
        </body>
        </html>