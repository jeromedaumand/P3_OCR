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

<!-- container pour les commentaires -->

<section class="commentaire"><?php
    //comptage des like et dislike

    $req_like = $bdd->query('select count(vote) from  vote
                                 where id_acteur ='.$id_act.' 
                                 and vote = 1 ;' ) or die(print_r($bdd->errorInfo()));

    //recupération du nombre de commentaire
    $nb_like = $req_like->fetch();

    $req_dislike = $bdd->query('select count(vote) from  vote
                                 where id_acteur ='.$id_act.' 
                                 and vote = 0 ;' ) or die(print_r($bdd->errorInfo()));

    //recupération du nombre de commentaire
    $nb_dislike = $req_dislike->fetch();


    //comptage et affichage des commentaires
    $requete = $bdd->query('select p.post, p.date_add, u.prenom from  post p
                                left join users u on u.id_user = p.id_user
                                left join acteur a on a.id_acteur = p.id_acteur
                                 where a.id_acteur ='.$id_act.' 
                                 order by p.date_add desc;' ) or die(print_r($bdd->errorInfo()));

    //recupération du nombre de commentaire
    $nb_comm = $requete->rowCount();

    echo '
        <div class="row">
            <div class="side">'.$nb_comm.' commentaires</div>
            <div class="bouton"><p align="center"><a href="add_comm.php?id='.$id_act.'">Ajouter un<br />commentaire</a></p></div>
            <div class="bouton"><p align="center"><a href="like.php?action=1&id='.$id_act.'">'.$nb_like[0].' like</a> / <a href="like.php?action=0&id='.$id_act.'">'.$nb_dislike[0].' dislike</a></p></div>
        </div>
        ';


    if ($requete->rowCount() > 0) {
        while ($donnees = $requete->fetch()) {
            echo '
            <div class="col"><!-- commentaire -->
                <div class="main">'.$donnees["prenom"].'</div>
                <div class="main">'.date_fr($donnees["date_add"]).'</div>
                <div class="main">'.nl2br($donnees["post"]).'</div>
            </div>';
        }
        $requete->closeCursor();
    }
?>
</section>

<?php
include "footer.php";
$req_like->closeCursor();
$req_dislike->closeCursor();
?>

</body>
</html>
