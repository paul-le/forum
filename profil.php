<?php 

    session_start();
    $requeteinfosprofil = "SELECT * FROM utilisateurs WHERE '".$_SESSION['login']."'";

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
                    <h1>PSEUDO</h1>
                </section>
                <section>
                    badge de profil
                </section>
                <section>
                    photodeprofil
                </section>
                <section>
                    description du profil
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