<?php 

    session_start();

    if (isset($_GET['id'])) 
    {
        $connexion = mysqli_connect("localhost","root","","forum");
        $requetethread2 = "SELECT * FROM thread WHERE id_topic = ".$_GET['id']."";
        $querythread2 = mysqli_query($connexion, $requetethread2);
        $resultatthread2 = mysqli_fetch_all($querythread2);
        $requete = "SELECT th.id_topic , th.nom , th.description , too.id , too.nom FROM thread AS th INNER JOIN topic AS too ON th.id_topic = too.id  WHERE id_topic = '".$_GET['id']."'";
        $queryusers = mysqli_query($connexion, $requete);
        $resultatthread = mysqli_fetch_all($queryusers);
        $threadcounter = count($resultatthread);

        $requeteEtatTopic = "SELECT etat FROM topic WHERE id = ".$_GET['id']."";
        $queryEtatTopic = mysqli_query($connexion, $requeteEtatTopic) ;
        $resultEtatTopic = mysqli_fetch_all($queryEtatTopic);
        
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
                    <h1 id="discussionsh1">&nbsp;&nbsp; Discussions</h1>
                </section>
                <?php 
                    if(isset($_SESSION['login']) && $_SESSION['role'] == 'Membre' && $resultEtatTopic[0][0] == 'prive')  
                    {
                        echo "Vous n'avez pas accès !";
                    }
                    else
                    {
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
                            <section id="topicflex1fix">
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
                        </section>
                        <?php
                            $i++; 
                            } 
                        }
                       
                        ?>
                        
                    </article>
                </section>
                 <?php 
                if(isset($_SESSION['login']) && $resultEtatTopic[0][0] == 'prive' && $_SESSION['role'] == 'Membre') {
                    echo "<div id='creertopicbouton' >Vous ne pouvez pas cree de thread</div>";
                }
                else{ ?>
                <a href="creerthread.php?id=<?php echo "".$_GET['id']."";?>"><img id="creertopicbouton" src="Images/boutoncreerthread.png"></a>
               <?php } ?>
               
            </section>
        </main>
        </body>
        </html>