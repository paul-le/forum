<?php
	
	session_start() ;
	$connexionImpossible = false ;

	if (isset($_POST['login']) && isset($_POST['password'])) 
	{
		$login = $_POST['login'] ;

		$connexion = mysqli_connect("localhost", "root", "", "forum") ;

		$requeteCountUser = "SELECT count(*) as toast FROM utilisateurs WHERE login = \"$login\" ";
		$queryCountUser = mysqli_query($connexion, $requeteCountUser) ;
		$resultatCountUser = mysqli_fetch_array($queryCountUser) ;

		$requeteHash = "SELECT password FROM utilisateurs WHERE login = \"$login\"";
		$queryHash = mysqli_query($connexion, $requeteHash) ;
		$resultatHash = mysqli_fetch_array($queryHash) ;

		$count = $resultatCountUser ;

		$requeteID = "SELECT id FROM utilisateurs WHERE login =\"$login\" ";
		$qeuryID = mysqli_query($connexion, $requeteID) ;
		$resultatID = mysqli_fetch_array($queryID) ;

		if ($count > 0 && password_verify($_POST['password'],$resultatHash['password'])) 
		{
			$_SESSION['login'] = $login ;
			$_SESSION['id'] = $requeteID[0] ;
			header('Location : index.php') ;
		}
		else
		{
			$connexionImpossible = true ;
		}
	}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Connexion</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
       
        <main id="mainconnexion">
            <section id="sectionformconnexion">
                <?php if(isset($_SESSION['login']))
                    {
                        echo "Vous êtes déjà connecté(e)";
                    }
                    else
                    { ?>
                <form id="connexionform" method="POST" action="connexion.php">
                    <h1 id="h1connexion">- Connexion -</h1><br><br>
                    <input type="text" placeholder="Identifiant" name="login" required><br><br>
                    <input type="password" placeholder="Mot de passe" name="password" required><br><br>
                    <input type="submit" name="connexion" value="Se connecter">                    <?php if($connexionImpossible == true)
                            {
                                echo "<br><br><span id=\"mauvaislogs\"> /!\  Mauvais identifiant ou mot de passe.  /!\ ";
                            } ?>
                    <?php } ?>
                </form>
            </section>
        </main>
        
    </body>
</html>
