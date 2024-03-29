<?php
include ('inc_db_connection.php');
include ('constante.php');



//traitement du formulaire de création utilisateur
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
        <div class="main"><p>Création d'un nouvel utilisateur.</p></div>
    </div>
</section>

<?php
// traitement du formulaire
    //print_r($_POST);

if ( isset($_POST['login']) and !empty($_POST['login']) )
    {
        // vérifiation de l'unicité du login
        $requete = $bdd->query('select username, password, nom, prenom from users where username = "' .htmlspecialchars($_POST['login']). '"') or die(print_r($bdd->errorInfo()));
            if ($requete->rowCount() > 0) {
                    while ($donnees = $requete->fetch())
                    {
                        //un login à déja été trouvé il faut recommencer
                                show_error_message("Ce login est déjà utilisé ! ");
                                show_error_message("Merci d'en choisir un autre.", 5, 'new_user.php');
                    }
                    $requete->closeCursor();
                }
            else { //verification que tous les champs sont rempli

                if ( !empty(($_POST['login'])) and !empty(($_POST['nom'])) and !empty(($_POST['prenom'])) and !empty(($_POST['password'])) and !empty(($_POST['question'])) and !empty(($_POST['reponse'])) )
                    {
                        // print_r($_POST);
                        // création de l'utilisateur
                        $login = !isset($login) ? htmlspecialchars($_POST['login']) : NULL;
                        $sha1pass = !isset($sha1pass) ? sha1(htmlspecialchars($_POST['password'])) : NULL;
                        $nom = !isset($nom) ? htmlspecialchars($_POST['nom']) : NULL;
                        $prenom = !isset($prenom) ? htmlspecialchars($_POST['prenom']) : NULL;
                        $question = !isset($question) ? htmlspecialchars($_POST['question']) : NULL;
                        $reponse = !isset($reponse) ? htmlspecialchars($_POST['reponse']) : NULL;

                        $update = $bdd->prepare('INSERT INTO users (username, nom, prenom, password, question, reponse) VALUES ( :login, :nom, :prenom, :pass, :question, :reponse)');
                        $update->execute(array(
                            'login' => $login,
                            'nom' => $nom,
                            'prenom' => $prenom,
                            'question' => $question,
                            'reponse' => $reponse,
                            'pass' => $sha1pass ) ) or die(print_r($bdd->errorInfo()));
                        $requete->closeCursor();
                        show_error_message("Votre compte a bien été créé !", 5);
                    }
                else // affichage d'un message d'alerte et redirection vers le formulaire
                    {
                        show_error_message('Les champs ne doivent pas être vide, merci de renseigner tous les champs');
                        show_error_message("Vous allez être redirigé automatiquement.",10, 'new_user.php');
                    }
                }
        $requete->closeCursor();
    }



?>


<?php
include "footer.php";
?>

</body>
</html>