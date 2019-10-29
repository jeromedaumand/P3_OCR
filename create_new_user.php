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
        $requete = $bdd->query('select login, password, nom, prenom from users where login = "' .htmlspecialchars($_POST['login']). '"') or die(print_r($bdd->errorInfo()));
            if ($requete->rowCount() > 0) {
                    while ($donnees = $requete->fetch())
                    {
                        //un login à déja été trouvé il faut recommencer
                                echo "Ce login est déjà utilisé ! <br>";
                                echo "Vous allez être redirigé automatiquement.";
                                header ("Refresh: 5;URL=new_user.php");
                    }
                    $requete->closeCursor();
                }
            else { //verification que tous les champs sont rempli
                print_r($_POST);
                if ( !empty(($_POST['login'])) and !empty(($_POST['nom'])) and !empty(($_POST['prenom'])) and !empty(($_POST['password'])) )
                    {
                        // print_r($_POST);
                        // création de l'utilisateur
                        $login = !isset($login) ? htmlspecialchars($_POST['login']) : NULL;
                        $sha1pass = !isset($sha1pass) ? sha1(htmlspecialchars($_POST['password'])) : NULL;
                        $nom = !isset($nom) ? htmlspecialchars($_POST['nom']) : NULL;
                        $prenom = !isset($prenom) ? htmlspecialchars($_POST['prenom']) : NULL;

                        $update = $bdd->prepare('INSERT INTO users (login, nom, prenom, password) VALUES ( :login, :nom, :prenom, :pass)');
                        $update->execute(array(
                            'login' => $login,
                            'nom' => $nom,
                            'prenom' => $prenom,
                            'pass' => $sha1pass ) ) or die(print_r($bdd->errorInfo()));
                        $requete->closeCursor();
                    }
                else // affichage d'un message d'alerte et redirection vers le formulaire
                    {
                        echo 'Les champs ne doivent pas etre vide, merci de renseigner tous les champs';
                        echo "Vous allez être redirigé automatiquement.";
                        header ("Refresh: 10;URL=new_user.php");
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