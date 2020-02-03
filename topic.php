<?php 

    if (isset($_GET['id'])) 
    {
        $connexion = mysqli_connect("localhost","root","","forum");
        $requetethread2 = "SELECT * FROM thread WHERE id_topic = '".$_GET['id']."'";
        $querythread2 = mysqli_query($connexion, $requetethread2);
        $resutatthread2 = mysqli_fetch_array($querythread2);
        $requete = "SELECT th.id_topic , th.nom , th.description , too.id , too.nom FROM thread AS th INNER JOIN topic AS too ON th.id_topic = too.id ";
        $queryusers = mysqli_query($connexion, $requete);
        $resultatthread = mysqli_fetch_array($queryusers);
        var_dump($resultatthread);
        
        $threadcounter = count($resultatthread);
        echo $threadcounter;
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
                <h1 id="welcomeh1">B i e n v e n u e</h1>
                <article id="welcomeyuno">
                    <img id="welcomeyuno2" src="Images/yuno gasai.png">
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
               
                <section id="infosmainsection">
                    <section id="informationsectionflex">
                        <h1 id="infosh1">&nbsp;&nbsp;Informations</h1>
                        <article id="infosarticle">
                            Il y a [CHIFFRES] personnes inscrites.<br>
                            Il y a [CHIFFRES] messages envoyés.
                        </article>
                    </section>
                    <article>
                        <a href=""><img id="creertopicbouton" src="Images/boutoncreertopic.png"></a>
                        <img id="imageenbas" src="Images/animeicon.png">
                    </article>
                </section>
                
            </section>
        </main>
        </body>
        </html>