<?php 

    session_start();

    $serverName = "localhost";
    $userName = "root";
    $passwordServer = "";
    $nameTable = "forum";
    $connexion = mysqli_connect("$serverName", "$userName", "$passwordServer", "$nameTable") ;
    $requeteInfosProfil = "SELECT * FROM utilisateurs WHERE id = '".$_SESSION['id']."'";
    $queryInfosProfil = mysqli_query($connexion, $requeteInfosProfil);
    $resultatInfosProfil = mysqli_fetch_assoc($queryInfosProfil);
    
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
            <section id="partiegaucheprofil">
                <section id="partiegaucheprofilflex">
                    <h1 id="infosprofils">Infos Profil</h1>
                    <form id="profilform" action="" method="post" enctype="multipart/form-data">

                    	<?php
                    		if (!empty($resultatInfosProfil['avatar'])) 
                    		{ ?>

                    		<img src="avatar/<?php echo $resultatInfosProfil['avatar'] ?>" width="200" ><br><br>
                    	<?php
                    		}
                    	?>

                        <?php if($_GET['id'] == $_SESSION['id']){ ?>

                    	<label> Pseudo </label><br>
	                    <input type="text" name="login" placeholder="<?php echo $resultatInfosProfil['login']; ?>"><br>

	                    <label> Votre mot de passe </label><br>
	                    <input type="password" name="password"><br>

	                    <label> Confirmez votre mot de passe </label><br>
	                    <input type="password" name="passwordcon"><br>

	                    <label>Avatar </label><br>
	                    <input type="file" name="avatar"><br>
	                    <?php } else {
                            echo $resultatInfosProfil['login'];
                        } ?>
	                    <input type="submit" value="Modifier" name="modifier" /><br>
                    </form>  
                </section>
                <section>
                    <?php if($_SESSION['login'] == 'admin'){ ?>
                    <form id="profilform2">
                    <input type="radio" name="memberrole" value="Admin"checked>
                    <label for="huey">Admin</label>
                    <input type="radio" name="memberrole" value="Modo">
                    <label for="huey">Modo</label>
                    <input type="radio" name="memberrole" value="Membre">
                    <label for="huey">Membre</label>
                    </form>
                    <?php } ?>
                </section>
            </section>
            <section id="partiedroiteprofil">
            </section>

            <?php 

                if(isset($_POST['modifier']))
                {
                    	$connexion = mysqli_connect("$serverName", "$userName", "$passwordServer", "$nameTable") ;
                        $login = $_POST['login'] ;                   
                        $requeteLogin = "SELECT login FROM utilisateurs WHERE login = '$login'";         
                        $queryLogin = mysqli_query($connexion, $requeteLogin);         
                        $resultatLogin = mysqli_fetch_all($queryLogin);  


                        if (!empty($_POST['login']) && $resultatLogin == $_POST['login'])             
                        {                 
                            echo "Ce Login est déjà prit";             
                        }
                        elseif ($_POST['password'] != $_POST['passwordcon']) 
                        {
                            echo "Les Mots de passes ne correspondent pas";
                        }          
                        else
                        {
                            
                            if($login != $resultatInfosProfil['login'] && !empty($_POST['login']))

                            {
                                
                               if(isset($_POST["login"]))
                                {
                                    $login=$_POST["login"];
                                }
                                
                               $connexion = mysqli_connect("$serverName", "$userName", "$passwordServer", "$nameTable") ;
                               $upLog = "UPDATE utilisateurs SET login = \"$login\" WHERE utilisateurs.login='".$resultatInfosProfil['login']."'";
                               $result = mysqli_query($connexion, $upLog);

                            }
                            if($_POST['password'] != $resultatInfosProfil['password'] && !empty($_POST['password']))
                            {
                               $password1 = $_POST['password'];
                               $passwordhash = password_hash($password1, PASSWORD_BCRYPT, array('cost' => 12));
                                $connexion = mysqli_connect("$serverName", "$userName", "$passwordServer", "$nameTable") ;
                               $upPass = "UPDATE utilisateurs SET password = \"$passwordhash\" WHERE utilisateurs.password='".$resultatInfosProfil['password']."'";
                               $result = mysqli_query($connexion, $upPass);
                               
                            }
                        }
                        if (isset($_FILES['avatar']) AND !empty($_FILES['avatar'])) 
                        {
                        	$tailleMax = 2097152 ;
		               		$extensionsValides = $arrayName = array('jpg', 'jpeg', 'gif', 'png');
		               		if ($_FILES['avatar']['size'] <= $tailleMax) 
		               		{
		               		 	$extensionsUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));
								if (in_array($extensionsUpload, $extensionsValides)) 
								{
									$chemin = "avatar/".$resultatInfosProfil['login'].".".$extensionsUpload;
									echo $chemin;
									$deplacement = move_uploaded_file($_FILES['avatar']['tmp_name'], $chemin);
									if ($deplacement) 
									{
										$updateAvatar = "UPDATE utilisateurs SET avatar = '".$resultatInfosProfil['login'].".".$extensionsUpload."' WHERE id = ".$resultatInfosProfil['id']."";
                                        $queryAvatar = mysqli_query($connexion,$updateAvatar);
									}
									else
									{
										$msg = "Erreur durant l'importation de votre photo de profil" ;
									}
								}
								else
								{
									$msg = "Votre photo de profil doit être au format jpg, jpeg, gif ou png. ";
								}

		               		}
			               	else
			               	{
			               		$msg = "Votre photo de profil ne doit pas dépasser 2Mo" ;
			               	}
                        }

		                
		               		 
			                 
                }               	
            ?>
        </main>
	</body>
</html>