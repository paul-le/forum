<?php 

    session_start();
    $connexion = mysqli_connect("localhost", "root", "", "forum");
    $requeteinfosprofil = "SELECT * FROM utilisateurs WHERE '".$_SESSION['login']."'";
    $queryprofiluser = mysqli_query($connexion, $requeteinfosprofil);
    $resultatprofilinfos = mysqli_fetch_assoc($queryprofiluser);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Forum index</title>
        <link rel="stylesheet" href="index.css">
        <meta charset="UTF-8">
    </head>
    <body>
    <?php include('header.php'); ?>
        <main>
            <section id="partiegaucheprofil">
                <section id="partiegaucheprofilflex">
                    <h1><?php echo "".$_SESSION['login']."" ?></h1>
                </section>
                <section>
                    badge de profil
                </section>
                <section>
                    photodeprofil
                </section>
                <section>
                    role checkbox
                </section>
            </section>
            <section id="partiedroiteprofil">
            </section>
        </main>
        </body>
        </html>