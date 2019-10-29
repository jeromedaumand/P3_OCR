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

if ( isset($_POST["form"]) and  !empty($_POST["form"]) ){
    //on traite le formulaire avant de le réaffiché

}



if ( isset($_SESSION['id_user']) and !empty($_SESSION['id_user']) )
{
    $userid = $_SESSION['id_user'];

    $requete = $bdd->query('select password, nom, prenom, question, reponse from users where id_user = ' . $userid . ';') or die(print_r($bdd->errorInfo()));
    if ($requete->rowCount() > 0) {
        while ($donnees = $requete->fetch())
        {
            //Le profile à bien été trouvé du coup on affiche le formulaire de modifiaction
            print_r($donnees);
        }
        $requete->closeCursor();
    }
    else {
        //si il n'y a pas de retour c'est qu'il y a eu un souci de BDD


    }
    //$requete->closeCursor();
}



?>


<?php
include "footer.php";
?>

</body>
</html>