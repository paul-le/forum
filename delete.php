<?php
	session_start();

	$serverName = "localhost";
    $userName = "root";
    $passwordServer = "";
    $nameTable = "forum";
    $connexion = mysqli_connect("$serverName", "$userName", "$passwordServer", "$nameTable") ;

	if (isset($_GET['id']) AND $_SESSION['role'] == "Admin" ) 
	{
		$deleteMessage = "DELETE FROM `messagesthreads` WHERE `messagesthreads`.`id` = '".$_GET['id']."' ";
		$queryMessage = mysqli_query($connexion, $deleteMessage) ;

		header('Location:index.php');
	}
	else
	{
		echo "VOUS NE POUVEZ PAS SUPPRIMER DE MESSAGES <br /> VOUS N'ETES PAS ADMIN OU MODO";
	}

?>