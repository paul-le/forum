<?php

	session_start();

	$serverName = "localhost";
    $userName = "root";
    $passwordServer = "";
    $nameTable = "forum";

    $connexion = mysqli_connect("$serverName", "$userName", "$passwordServer", "$nameTable") ;

    
    $requeteUser = "SELECT id, login, age FROM utilisateurs";
    $queryUser = mysqli_query($connexion, $requeteUser) ;
    

   
   

?>

<!DOCTYPE html>
<html>
<head>
	<title>Membre</title>
</head>
<body>
	<main>
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
				<td><a href='profil.php?id=".$membre["id"]."'><?php echo $membre['login']; ?></a></td>
				<td><?php echo $membre['age']; ?></td>
			</tr>
		<?php } ?>
	</main>

</body>
</html>