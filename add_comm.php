<?php
include ('inc_db_connection.php');
include ('constante.php');

if (!isset($_SESSION['auth']) or ($_SESSION['auth'] != 1 )){
    header ("Refresh: 0;URL=index.php");
    exit;
}

//verification de la présence du l'id acteur
if ( isset($_GET['id']) and !empty($_GET['id']) and is_numeric($_GET['id']) ) {
    $id_act = $_GET['id'];
}
else {
    show_error_message("Cette page n'est pas accéssible directement ");
    show_error_message("Vous allez être redirigé automatiquement.");
    header ("Refresh: 5;URL=actors.php");
    exit;
}
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

//traitement du nouveau message

if (isset($_POST['message']) and  !empty($_POST['message']) )
{

    $post = htmlspecialchars($_POST["message"]);

    //construction de la requete d'insertion
    $update = $bdd->prepare('INSERT INTO post (id_user, id_acteur, post,date_add) VALUES(:userid, :acteurid, :post, :heure)');
    $update->execute(array(
        'userid' => $_SESSION["id_user"],
        'acteurid' => $id_act,
        'heure' => date("Y-m-d H:i:s"),
        'post' => $post
        )) or die(print_r($bdd->errorInfo()));
    //var_dump($update);
    $update->closeCursor();
    header ("Refresh: 0;URL=acteur.php?id=$id_act");
}else {
//fin de l'insertion du nouveau message
// si pas de nouveau message, on affiche le formulaire
    ?>

    <section class="login">
        <div class="main">
            <form action="add_comm.php?id=<?php echo $id_act; ?>" method="post" class="formulaire" id="formcom">
                <h3>Commentaire :</h3><br/><textarea autofocus form="formcom" class="input_login" name="message"></textarea>
                <input type="submit" class="input_bouton">
            </form>
        </div>
    </section>

    <?php
}
include "footer.php";
?>

</body>
</html>