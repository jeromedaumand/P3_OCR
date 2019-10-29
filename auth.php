<?php
include ('inc_db_connection.php');
include ('constante.php');

?>




<!DOCTYPE html>
<html lang="FR">
<head>
    <title><?php echo $title ; ?></title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" type="text/css"  href="style.css" />
</head>
<body>

<?php
include('header.php');
?>

<section class="presentation">
    <div class="col">
        <div class="main"><h1><?php echo $title; ?></h1></div>
        <div class="main"><p>Espace <b>Réservé</b> aux employés.</p></div>
    </div>
</section>


    <div class="col">
        <div class="main"><?php

//traitement du formulaire de login en page d'index

if ( isset($_POST['login']) and !empty($_POST['login']) ){


    $requete = $bdd->query('select username, password, nom, prenom from users where username = "' .htmlspecialchars($_POST['login']). '"') or die(print_r($bdd->errorInfo()));
    if ($requete->rowCount() > 0) {
        while ($donnees = $requete->fetch())
        {
            //verification du password
            if (isset($donnees['username'])){
                if ($donnees['password'] == sha1(htmlspecialchars($_POST['password']))){
                    $_SESSION['username'] = $donnees['nom']. " " .$donnees['prenom'];
                    $_SESSION['login'] = $donnees['username'];
                    $_SESSION['auth'] = true;
                    echo "Bienvenu " . $_SESSION['username'] . " !<br />";
                    echo "Vous allez être redirigé automatiquement dans 10s.";
                    header ("Refresh: 10;URL=actors.php");
                }
                else{
                    echo "Mot de passe invalide !!<br />";
                    echo "refaite un essai.";
                    header ("Refresh: 5;URL=index.php");
                }
            }

        };

    } else {
        echo "Login invalide !!<br />";
        echo "Si vous êtes nouveau, merci de créer un compte en suivant le lien ci-dessous. <br />";
        echo "<a href=\"new_user.php\">Nouvel utilisateur</a><br />";
        echo "refaite un essai.<br />";
        header ("Refresh: 10;URL=index.php");
    }
    $requete->closeCursor();
}
?>    </div>
    </div>





<?php
include "footer.php";
?>

</body>
</html>
