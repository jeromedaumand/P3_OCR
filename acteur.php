<?php
//test extranet banquaire pour OCR
include ('inc_db_connection.php');
include ('constante.php');

if (!isset($_SESSION['auth']) or ($_SESSION['auth'] != 1 )){
    header ("Refresh: 0;URL=index.php");
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
?>


<div class="col"><?php
    // recupération de la liste des acteurs

    //verification de l'id passer en URL
    if ( isset($_GET['id']) and !empty($_GET['id']) and is_numeric($_GET['id']) ) {
        $id_act = $_GET['id'];
    }
    else {
        echo "Cette page n'est pas accéssible directement <br />";
        echo "Vous allez être redirigé automatiquement.";
        header ("Refresh: 5;URL=actors.php");
        exit;
    }


    $requete = $bdd->query('select id_acteur, acteur, description, logo  from  acteur where id_acteur = '.$id_act) or die(print_r($bdd->errorInfo()));

    //affichage des acteurs
    if ($requete->rowCount() > 0) {
        while ($donnees = $requete->fetch())
        {
            echo '      <div class="main"> <!-- container pour le logo -->
            <div class="fakeimg_logo"><img src="/img/'.$donnees["logo"].'"></div>
        </div>
        <div class="main"> <!-- container pour le descriptif -->
            <h3>'.$donnees["acteur"].'</h3>
            <p>'.nl2br($donnees["description"]).'</p>
            <div class="bouton">
                <a href="actors.php">Retour...</a>
            </div>
        </div>
            ';
        }
        $requete->closeCursor();
    }
    else{
        echo "aucun partenaire trouvé !<br />";
        echo "Vous allez être redirigé automatiquement.";
        header ("Refresh: 5;URL=actors.php");
        exit;
    }

    ?>

</div>

<section class="commentaire"> <!-- container pour les commentaires -->
        <div class="row">
            <div class="side">X commentaires</div>
            <div class="bouton"><p align="center"><a href="#">Nouveau<br />commentaire</a></p></div>
            <div class="bouton"><p align="center"><a href="#">X like / Y dislike</a></p></div>
        </div>

            <div class="col"><!-- commentaire -->
                <div class="main">Prénom</div>
                <div class="main">date</div>
                <div class="main">text</div>
            </div>
            <div class="col"><!-- commentaire -->
                <div class="main">Prénom</div>
                <div class="main">date</div>
                <div class="main">text</div>
            </div>
            <div class="col"><!-- commentaire -->
                <div class="main">Prénom</div>
                <div class="main">date</div>
                <div class="main">text</div>
            </div>
</section>

<?php
include "footer.php";
?>

</body>
</html>
