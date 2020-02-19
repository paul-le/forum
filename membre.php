<?php

	session_start();

	$serverName = "localhost";
    $userName = "root";
    $passwordServer = "";
    $nameTable = "forum";

    $connexion = mysqli_connect("$serverName", "$userName", "$passwordServer", "$nameTable") ;

    
    $requeteUser = "SELECT id,login,age FROM utilisateurs";
    $queryUser = mysqli_query($connexion, $requeteUser) ;

?>

<!DOCTYPE html>
<html>
<head>
	<title>Membre</title>
	<link rel="stylesheet" type="text/css" href="index.css">
</head>
<body>
	<?php include('header.php'); ?>
	<main>
		<?php 
		if (isset($_SESSION['login'])) 
			{ ?>
		<table>
    		<tr>
        		<th>ID</th>
        		<th>Login</th>
        		<th>Age</th>
    		</tr>
		<?php
			while($membre = mysqli_fetch_assoc($queryUser)) { ?>

			<tr>
				<td><?php echo $membre['id']; ?></td>
				<td><a href="profil.php?id=<?php echo "".$membre['id']."";?>"><?php echo $membre['login']; ?></td></a> 
				<td><?php echo $membre['age']; ?></td>
			</tr>
		<?php 
				}
			}
			else
			{
				echo "Vous n'etes pas connectez"; 
			}
		 ?>
	</main>

</body>
</html>