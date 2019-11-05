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
//print_r($_POST);

if ( isset($_POST["nom"]) and  !empty($_POST["nom"]) ) {
    //on traite le formulaire avant de le réaffiché
    //echo "<br />on traite le formulaire avant de le réaffiché";
    //print_r($_POST);
    if (isset($_SESSION['id_user']) and !empty($_SESSION['id_user'])) {
        $userid = $_SESSION['id_user'];


        //verification des données du form
        if (empty($_POST['password']) | !isset($_POST['password']) | is_null($_POST['password'])){
            show_error_message("Le mot de passe ne peut pas etre vide.", 5, 'profile.php');
            include "footer.php";
            exit;
        }
        else {
            switch ($_POST['password']) {
                case (preg_match('#password|mot|passe#i', $_POST['password']) ? $_POST['password'] : !$_POST['password']):
                    show_error_message("Le mot de passe ne doit pas etre 'password' ou contenir 'mot' ou 'passe'.", 5, 'profile.php');
                    include "footer.php";
                    exit;
                    break;
            }
            switch ($_POST['question']) {
                case (preg_match('#question#i', $_POST['question']) ? $_POST['question'] : !$_POST['question']):
                    show_error_message("La question ne peut pas être '" . htmlspecialchars($_POST['question']) . "'.", 5, 'profile.php');
                    include "footer.php";
                    exit;
                    break;
            }

            switch ($_POST['reponse']) {
                case (preg_match('#reponse|réponse#i', $_POST['reponse']) ? $_POST['reponse'] : !$_POST['reponse']):
                    show_error_message("La réponse ne peut pas être '" . htmlspecialchars($_POST['reponse']) . "'.", 5, 'profile.php');
                    include "footer.php";
                    exit;
                    break;
            }
        }

        $requete = $bdd->query('select password, nom, prenom, question, reponse from users where id_user = ' . $userid . ';') or die(print_r($bdd->errorInfo()));
        if ($requete->rowCount() > 0) {
                //traitement des valeurs du form
                $update = $bdd->query("update users set 
                 nom = '" . htmlspecialchars($_POST['nom']) . "',
                 prenom = '" . htmlspecialchars($_POST['prenom']) . "',
                 password = sha1('" . htmlspecialchars($_POST['password']) . "'),
                 question = '" . htmlspecialchars($_POST['question']) . "',
                 reponse = '" . htmlspecialchars($_POST['reponse']) . "' 
                 where id_user = " . $userid . ";") or die(print_r($bdd->errorInfo()));
                $update->execute();
                show_error_message("Votre profile a bien été mis à jour !");
                show_error_message("Vous devez vous déconnecter pour que les changements soient pris en compte.");
        }

    }
}


//affichage du form
if ( isset($_SESSION['id_user']) and !empty($_SESSION['id_user']) )
{
    $userid = $_SESSION['id_user'];

    $requete = $bdd->query('select password, nom, prenom, question, reponse from users where id_user = ' . $userid . ';') or die(print_r($bdd->errorInfo()));
    if ($requete->rowCount() > 0) {
        while ($donnees = $requete->fetch())
        {
            //Le profile à bien été trouvé du coup on affiche le formulaire de modification
            ?>
            <form action="profile.php" method="post" class="formulaire" id="form_update">
                <p>Votre nom<br /><input class="input_login" type="text" value="<?php echo $donnees["nom"]?>" name="nom"></p>
                <p>Votre prénom<br /><input class="input_login" type="text" value="<?php echo $donnees["prenom"]?>" name="prenom"></p>
                <p>Mot de passe<br /><input class="input_password" type="password" name="password"></p>
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
        show_error_message("Une erreur c'est produite lors du traitement.");
        show_error_message("Veuillez contacter votre service informatique.");

    }
}



?>


<?php
include "footer.php";
?>

</body>
</html>