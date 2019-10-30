<?php
include ('inc_db_connection.php');
include ('constante.php');

if (!isset($_SESSION['auth']) or ($_SESSION['auth'] != 1 )) {
    header("Refresh: 0;URL=index.php");
    exit;
}


//Page de gestion du profile
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
        <div class="main"><p>Gestion du profile.</p></div>
    </div>
</section>

<?php
// traitement du formulaire
print_r($_POST);

if ( isset($_POST["nom"]) and  !empty($_POST["nom"]) ) {
    //on traite le formulaire avant de le réaffiché
    echo "<br />on traite le formulaire avant de le réaffiché";
    print_r($_POST);
    if (isset($_SESSION['id_user']) and !empty($_SESSION['id_user'])) {
        $userid = $_SESSION['id_user'];

        $requete = $bdd->query('select password, nom, prenom, question, reponse from users where id_user = ' . $userid . ';') or die(print_r($bdd->errorInfo()));
        if ($requete->rowCount() > 0) {
            while ($donnees = $requete->fetch()) {
                //traitement des valeurs du form
                $update = $bdd->query("update users set 
                 nom = '" . htmlspecialchars($_POST['nom']) . "',
                 prenom = '" . htmlspecialchars($_POST['prenom']) . "',
                 question = '" . htmlspecialchars($_POST['question']) . "',
                 reponse = '" . htmlspecialchars($_POST['reponse']) . "' 
                 where id_user = " . $userid . ";") or die(print_r($bdd->errorInfo()));
                $update->execute();
            }
        }
    }
}



if ( isset($_SESSION['id_user']) and !empty($_SESSION['id_user']) )
{
    $userid = $_SESSION['id_user'];

    $requete = $bdd->query('select password, nom, prenom, question, reponse from users where id_user = ' . $userid . ';') or die(print_r($bdd->errorInfo()));
    if ($requete->rowCount() > 0) {
        while ($donnees = $requete->fetch())
        {
            //Le profile à bien été trouvé du coup on affiche le formulaire de modifiaction
            echo "<br />Le profile à bien été trouvé du coup on affiche le formulaire de modifiaction";
            print_r($donnees);
            ?>
            <form action="profile.php" method="post" class="formulaire" id="form_update">
                <p>Votre nom<br /><input class="input_login" type="text" value="<?php echo $donnees["nom"]?>" name="nom"></p>
                <p>Votre prénom<br /><input class="input_login" type="text" value="<?php echo $donnees["prenom"]?>" name="prenom"></p>
                <p>Mot de passe<br /><input class="input_password" type="password" " value="password" name="password"></p>
                <p>Question secrète<br /><input class="input_login" type="text" value="<?php echo $donnees["question"]?>" name="question"></p>
                <p>Votre réponse à la question secrète<br /><input class="input_login" type="text" value="<?php echo $donnees["reponse"]?>" name="reponse"></p>
                <input type="submit" class="input_bouton">
            </form>
<?php
        }
        $requete->closeCursor();
    }
    else {
        //si il n'y a pas de retour c'est qu'il y a eu un souci de BDD
        echo "si il n'y a pas de retour c'est qu'il y a eu un souci de BDD";

    }
    //$requete->closeCursor();
}



?>


<?php
include "footer.php";
?>

</body>
</html>