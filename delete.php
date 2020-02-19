<?php
	session_start();

	$serverName = "localhost";
    $userName = "root";
    $passwordServer = "";
    $nameTable = "forum"; 
    $connexion = mysqli_connect("$serverName", "$userName", "$passwordServer", "$nameTable") ;

	if (isset($_GET['id']) AND $_SESSION['login'] == "admin" ) 
	{
		$deleteMessage = "DELETE FROM  messagesthreads WHERE messagesthreads.id = '".$_GET['id']."' ";
		$queryMessage = mysqli_query($connexion, $deleteMessage) ;
		echo $deleteMessage;
		header('Location:thread.php?id=5');
	}
	else
	{
		echo "VOUS NE POUVEZ PAS SUPPRIMER DE MESSAGES <br /> VOUS N'ETES PAS ADMIN OU MODO";
	}

?>