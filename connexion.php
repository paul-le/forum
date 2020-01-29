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
