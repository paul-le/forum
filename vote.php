<?php
	session_start();

    $serverName = "localhost";
    $userName = "root";
    $passwordServer = "";
    $nameTable = "forum";
    $connexion = mysqli_connect("$serverName", "$userName", "$passwordServer", "$nameTable") ;

    if(isset($_GET['t'],$_GET['id']))
    {
        $getT = $_GET['t'] ;
        $getID = $_GET['id'] ;
        echo "T = ".$getT."<br />";
        echo "ID = ".$getID."<br />";

        $requetemessage="SELECT * FROM messagesthreads WHERE id = $getID ";
        $querymessage = mysqli_query($connexion,$requetemessage);
        $resultatmessage = mysqli_fetch_assoc($querymessage);
        var_dump($resultatmessage);
        echo $requetemessage."<br />";

        $requetUser = "SELECT * FROM utilisateurs WHERE id = '".$_SESSION['id']."'" ;
        $queryUser = mysqli_query($connexion, $requetUser) ;
        $resultUser = mysqli_fetch_assoc($queryUser) ;
        var_dump($resultUser) ;
        echo $requetUser."<br />";

        $likes = "SELECT valeur FROM vote WHERE id_message = ".$resultatmessage['id']." AND id_utilisateur='".$resultUser['id']."' AND valeur = 1";

        $queryLikes = mysqli_query($connexion,$likes) ;
        $resultLikes = mysqli_fetch_all($queryLikes) ;
        $countLikes = count($resultLikes) ;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      
        $disLikes = "SELECT valeur FROM vote  WHERE id_message = ".$resultatmessage['id']." AND id_utilisateur='".$resultUser['id']."' AND valeur = 2";

        $queryDislikes = mysqli_query($connexion,$disLikes) ;
        $resultDislikes = mysqli_fetch_all($queryDislikes) ;
        $countDislikes = count($resultDislikes) ;

       

        if ($getT == 1) 
        {
            if ($countLikes >= 1) 
            {
                $requeteResetLike = "DELETE FROM vote WHERE id_message = '".$resultatmessage['id']."' AND id_utilisateur='".$resultUser['id']."' AND valeur = '".$getT."'";
                $queryResetLike = mysqli_query($connexion, $requeteResetLike);
                echo $requeteResetLike;
                
                header('Location:thread.php?id='.$resultatmessage['id_thread'].'') ;

            }
            else
            {
                $insertLike ="INSERT INTO vote (id_message, id_utilisateur, valeur) VALUES ('".$resultatmessage['id']."','".$resultUser['id']."','".$getT."')";
                $queryLike = mysqli_query($connexion, $insertLike) ;
                echo $insertLike;

                header('Location:thread.php?id='.$resultatmessage['id_thread'].'') ;
            }        
        }

        if ($getT == 2) 
        {
             if ($countDislikes >= 1) 
            {
                $requeteResetDislike = "DELETE FROM vote WHERE id_message='".$resultatmessage['id']."' AND id_utilisateur='".$resultUser['id']."' AND valeur = '".$getT."'";
                $queryResetDislike = mysqli_query($connexion, $requeteResetDislike);
                echo $requeteResetDislike;
                header('Location:thread.php?id='.$resultatmessage['id_thread'].'') ;

            }
            else
            {
                $insertDislike ="INSERT INTO vote (id_message, id_utilisateur, valeur) VALUES ('".$resultatmessage['id']."','".$resultUser['id']."','".$getT."')";
                $queryDislike = mysqli_query($connexion, $insertDislike) ;
                echo $insertDislike;
            
            
                header('Location:thread.php?id='.$resultatmessage['id_thread'].'') ;
            }
        }



        
    }


?>