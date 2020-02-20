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

			$requeteInsertUser = "INSERT INTO utilisateurs (login, password, age, avatar, role) VALUES('$nameLogin', '$passwordHash', '$ageUser', 'VIDE' , 'Membre')" ;
			$queryInsertUser = mysqli_query($connexion, $requeteInsertUser) ;
            header("Location:index.php");
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
        <title>Forum index</title>
        <link rel="stylesheet" href="index.css">
        <meta charset="UTF-8">
    </head>
    <body>
    <header>
            <section>
                <a href="index.php"><img src="Images/logoforumheader.png"></a>
            </section>
            <section>
                <section id="coheaderflex">
                    <?php if(isset($_SESSION['login'])){ ?>
                    <p id="cocenter">- Vous êtes déjà connecté ! -</p>
                    <?php } ?>
                    </section>
            </section>
        </header>
        <nav>
            <?php if(isset($_SESSION['login'])){ ?>
            <ul id="navul">
                <a href="index.php" class="lia"><li class="liheader" >Accueil</li></a>
                <a href="index.php"><img id="homebutton" img src="Images/home.png"></a>
                <a class="lia" href="profil.php"><li class="liheader">Profil</li></a>
            </ul>
            <?php } else { ?>
            <ul id="navul">
                <a href="index.php" class="lia"><li class="liheader" >Accueil</li></a>
                <a href="index.php"><img id="homebutton" img src="Images/home.png"></a>
                <a class="lia" href="inscription.php"><li class="liheader">Inscription</li></a>
            </ul>
            <?php } ?>
        </nav>
        <main id="inscriptionmain">
            <!-- PARTIE TOP FORUM --> 
            <!-- PARTIE TOP FORUM -->
            <!-- PARTIE TOP FORUM --> 
            <!-- PARTIE TOP FORUM --> 
            <!-- PARTIE TOP FORUM --> 
            <!-- PARTIE TOP FORUM -->
            
            <section id="inscriptionformflex">
                <?php if(!isset($_SESSION['login'])){ ?>
            <form id="inscriptionform" method="post" action="">
        		<h1 id="h1inscription">- Inscription - </h1>
                    <input class='inscriptionforminput' type="text" placeholder="Identifiant" name="login" required><br/><br/>

                    <input class='inscriptionforminput' type="password" placeholder="Mot de passe" name="password" required><br/><br/>

                    <input class='inscriptionforminput' type="password" placeholder="Confirmation mot de passe" name="confirmationpassword" required><br/><br/>

                    <input class='inscriptionforminput' type="number" placeholder="Age" name="age" required><br/><br/>

                    <input class='inscriptionforminputsubmit' type="submit" value="S'inscrire" name="inscription" required>
                       <?php  } else
                    {
                    echo"Vous êtes déjà inscrit !";

                    } ?>
                </form>
                </section>
        </main>
        </body>
        </html>