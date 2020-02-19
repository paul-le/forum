<?php

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
		$queryID = mysqli_query($connexion, $requeteID) ;
        $resultatID = mysqli_fetch_all($queryID) ;
        
        $requeteRole = "SELECT role FROM utilisateurs WHERE login =\"$login\" ";
		$queryRole = mysqli_query($connexion, $requeteRole);
        $resultatRole = mysqli_fetch_all($queryRole);
        
        

		if ($count > 0 && password_verify($_POST['password'],$resultatHash['password'])) 
		{
			$_SESSION['login'] = $login ;
            $_SESSION['id'] = $resultatID[0][0] ;
            $_SESSION['role'] = $resultatRole[0][0];
			// header('Location : index.php') ;
		}
		else
		{
			$connexionImpossible = true ;
		}
	}

?>
        
        <header>
            <section>
                <a href="index.php"><img src="Images/logoforumheader.png"></a>
            </section>
            <section>
                <section id="coheaderflex">
                    <?php if(!isset($_SESSION['login'])){ ?>
                    <p id="cocenter">- Connexion -</p>
                    <section id="coheaderflex2">
                    <form id="connexionform" method="POST" action="index.php">  
                    <input class="coinput" type="text" placeholder="Identifiant" name="login"><br><br>
                    <input class="coinput" type="password" placeholder="Mot de passe" name="password"><br><br>
                    </section>
                    <section id="coheaderflex3">
                    <input id="boutonconnexion" type="submit" name="connexion" value="Se connecter">                    <?php if($connexionImpossible == true)
                            {
                                echo "<br><br><span id=\"mauvaislogs\"> /!\  Mauvais identifiant ou mot de passe.  /!\ "; ?>
                    </section>
                            
                </form>
                    <?php }
                            } else { ?>
                        <span id="profiltext"><a href="profil.php?id=<?php echo "".$_SESSION['id'].""; ?>"> Profil </a></span>
                        <a id="boutondeco" href="logout.php"><img id="imglogout" src="images/deconnexion.png"></a>
                    <?php } ?>
                    </section>
            </section>
        </header>
        <nav>
            <?php if(isset($_SESSION['login'])){ ?>
            <ul id="navul">
                <a href="index.php" class="lia"><li class="liheader" >Accueil</li></a>
                <a href="index.php"><img id="homebutton" img src="Images/home.png"></a>
                <a class="lia" href="profil.php?id=<?php echo "".$_SESSION['id'].""; ?>"><li class="liheader">Profil</li></a>
            </ul>
            <?php } else { ?>
            <ul id="navul">
                <a href="index.php" class="lia"><li class="liheader" >Accueil</li></a>
                <a href="index.php"><img id="homebutton" img src="Images/home.png"></a>
                <a class="lia" href="inscription.php"><li class="liheader">Inscription</li></a>
            </ul>
            <?php } ?>
        </nav>