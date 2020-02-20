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
    $requeteRole1 = "SELECT role FROM utilisateurs WHERE id = '".$_GET['id']."'";
    $queryRole1 = mysqli_query($connexion,$requeteRole1);
    $resultatRole1 = mysqli_fetch_all($queryRole1);
    $requeteMessageProfil = "SELECT * FROM messagesthreads WHERE id_utilisateur = '".$_GET['id']."'";
    $queryMessageProfil = mysqli_query($connexion,$requeteMessageProfil);
    $resultatMessageProfil = mysqli_fetch_all($queryMessageProfil);
    $resultatMessageProfilCount = count($resultatMessageProfil);

    if(isset($_GET['id']))
    {
        $requeteInfosProfil = "SELECT * FROM utilisateurs WHERE id = '".$_GET['id']."'";
        $queryInfosProfil = mysqli_query($connexion, $requeteInfosProfil);
        $resultatInfosProfil = mysqli_fetch_assoc($queryInfosProfil);
    }
    else
    {
        $requeteInfosProfil = "SELECT * FROM utilisateurs WHERE id = '".$_SESSION['id']."'";
        $queryInfosProfil = mysqli_query($connexion, $requeteInfosProfil);
        $resultatInfosProfil = mysqli_fetch_assoc($queryInfosProfil);
    }

    if(isset($_POST['modifierrole']))
    {
        if(isset($_POST['roleinput']))
        {
            $roleUp = $_POST['roleinput'];
            $requeteRoleUpdate = "UPDATE utilisateurs SET role = \"$roleUp\" WHERE utilisateurs.id = '".$_GET['id']."'";
            $queryRoleUpdate = mysqli_query($connexion,$requeteRoleUpdate);           
        }
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
        <section id="profilfullflex">
            <section id="partiegaucheprofil">
                <section id="partiegaucheprofilflex">
                    <h1 id="infosprofils">Infos Profil <?php echo $resultatRole1[0][0]; ?> </h1>
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
                        <?php if($_SESSION['role'] == 'Admin' && $_GET['id'] != 1){ ?>
	                    <label> Rôle du membre : </label><br>
                        <input type="text" name="roleinput" placeholder = "<?php echo $resultatRole1[0][0] ; ?> "><br>
                        <input type="submit" value="Modifier" name="modifierrole" />
                        <?php } else { ?>
	                    <input type="submit" value="Modifier" name="modifier" /><br>
                        <?php } 
                        ?>
                        </form>  
                </section>
            </section>
            <section id="partiedroiteprofil">
                <section>
                <h3>
                    Messages envoyés :
                </h3>
                <article>
                    <?php 

                    $m = 0;
                    while($m != $resultatMessageProfilCount)
                    {
                        echo "".$resultatMessageProfil[$m][3]." envoyé le ".$resultatMessageProfil[$m][4]."<br>";
                        $m++;
                    }
                    ?>
                </article>
                </section>
            </section>
            </section>

            <?php 

                if(isset($_POST['modifierrole']))
                {
                    if(isset($_POST['roleinput']))
                    {
                        $roleUp = $_POST['roleinput'];
                        $requeteRoleUpdate = "UPDATE utilisateurs SET role = \"$roleUp\" WHERE utilisateurs.id = '".$_GET['id']."'";
                        $queryRoleUpdate = mysqli_query($connexion,$requeteRoleUpdate);
                        header('Location:profil.php?id='.$_GET['id'].'');
                        }
                }

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