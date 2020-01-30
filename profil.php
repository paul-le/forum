<?php

	session_start() ;

	$serverName = "localhost";
    $userName = "root";
    $passwordServer = "";
    $nameTable = "forum";

    $connexion = mysqli_connect("$serverName", "$userName", "$passwordServer", "$nameTable") ;

    $requeteSelectUser = "SELECT * FROM utilisateurs WHERE login = '".$_SESSION['login']."' " ;

    $querySelectUser = mysqli_query($connexion, $requeteSelectUser);

    $resultatSelectUser = mysqli_fetch_assoc($querySelectUser) ;


?>


<!DOCTYPE html>
<html>
<head>
	<title>Profil</title>
	<link rel="stylesheet" type="text/css" href="forum.css">
</head>
<body>

	<main>
	<?php if (isset($_SESSION['login'])) { ?>

		<section>
			<form action="" method="post">
				<h1>PROFIL</h1>
				<label>Votre Login</label><br>
				<input type="text" name="login" placeholder="<?php echo $resultatSelectUser['login']; ?>"><br>

				<label> Votre mot de passe </label><br>
                <input type="password" name="password"><br>

                <label> Confirmez votre mot de passe </label><br>
                <input type="password" name="confirmPassword"><br>

                <input type="submit" value="Modifier" name="modifier" /><br>
			</form>
		</section>

	<?php } ?>

	<?php
		if (isset($_POST['modifier'])) 
		{
			 $connexion = mysqli_connect("$serverName", "$userName", "$passwordServer", "$nameTable") ;

			$login = $_POST['login'] ;

			$requeteLogin = "SELECT login FROM utilisateurs WHERE login = \"$login\" " ;
			$queryLogin = mysqli_query($connexion, $requeteLogin) ;
			$resultatLogin = mysqli_fetch_all($queryLogin) ;

			if (!empty($_POST['login']) && $resultatLogin == '$login') 
			{
				echo "Ce Login existe déja";
			}
			elseif ($_POST['password'] != $_POST['confirmPassword']) 
			{
				echo "Les mots de passes ne correspondent pas";
			}
			else
			{
				if ($_POST['login'] != $resultatLogin['login'] && !empty($_POST['login'])) 
				{
					 $connexion = mysqli_connect("$serverName", "$userName", "$passwordServer", "$nameTable") ;
					$updateLogin = "UPDATE utilisateurs SET login =\"$login\" WHERE utilisateurs.login='".$resultatSelectUser['login']."'";
					$queryUpdateLogin = mysqli_query($connexion, $updateLogin );
				}

				if ($_POST['password'] != $resultatSelectUser['password'] && !empty($_POST['password'])) 
				{
					$password = $_POST['password'] ;
					$passwordHash = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12)) ;

					 $connexion = mysqli_connect("$serverName", "$userName", "$passwordServer", "$nameTable") ;

					$updatePassword = "UPDATE utilisateurs SET password = \"$passwordHash\" WHERE utilisateurs.password = '".$resultatSelectUser['password']."'" ;
					$queryUpdatePassword = mysqli_query($connexion, $updatePassword);
				}
			}
		}

	?>
	</main>

</body>
</html>