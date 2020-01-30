<?php
	session_start() ;
	$inscriptionImpossible = false ;
	$connexion = mysqli_connect("localhost", "root", "", "forum") ;


	if (isset($_POST['password'])) 
	{
		$password = $_POST['password'] ;
		$passwordHash = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));
	}

	if(isset($_POST['inscription']) == true && $_POST['password'] == $_POST['confirmationpassword'] && isset($_POST['login']) && strlen($_POST['login']) != 0 && isset($_POST['password']) && strlen($_POST['password']) != 0 && isset($_POST['confirmationpassword']) && strlen($_POST['confirmationpassword']) != 0)
	{
		$requeteUser = "SELECT * FROM utilisateurs";
        $queryUser = mysqli_query($connexion , $requeteUser);
        $resultatUser = mysqli_fetch_all($queryUser);

		foreach ($resultatUser as $row_number => $loginExist) 
		{
			if ($resultatUser[$row_number][1] == $_POST['login']) 
			{
				$inscriptionImpossible = true ;	
			}
		}

		if ($inscriptionImpossible == false) 
		{
			$nameLogin = $_POST['login'] ;
			$ageUser = $_POST['age'] ;

			$requeteInsertUser = "INSERT INTO utilisateurs (login, password, age) VALUES('$nameLogin', '$passwordHash', '$ageUser')" ;
			$queryInsertUser = mysqli_query($connexion, $requeteInsertUser) ;

			echo $requeteInsertUser ;
		}
		else
		{
			
		}
	}

	mysqli_close($connexion);


?>




<!DOCTYPE html>
<html>
<head>
	<title>Inscription</title>
	<link rel="stylesheet" type="text/css" href="forum.css">
</head>
<body>
	<main id="maininscription">
    	<section id="sectionforminscription">
        	<form id="inscriptionform" method="post" action="">
            	<?php if(!isset($_SESSION['login']))
                    { ?>
        		<h1 id="h1inscription">- Inscription - </h1>
                    <input type="text" placeholder="Identifiant" name="login" required><br/><br/>

                    <input type="password" placeholder="Mot de passe" name="password" required><br/><br/>

                    <input type="password" placeholder="Confirmation mot de passe" name="confirmationpassword" required><br/><br/>

                    <input type="number" placeholder="Age" name="age" required><br/><br/>

                    <input type="submit" value="S'inscrire" name="inscription" required>
                       <?php  } else
                    {
                    echo"Vous êtes déjà inscrit !";

                    } ?>

                <?php if($inscriptionImpossible == true){echo"<br><br>Identifiant déjà existant";}?>
                </form>
            </section>
        </main>

</body>
</html>

