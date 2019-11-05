<?php
//test extranet banquaire pour OCR
include ('inc_db_connection.php');
include ('constante.php');

if (!isset($_SESSION['auth']) or ($_SESSION['auth'] != 1 )) {
    header("Refresh: 0;URL=index.php");
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
<?php
if (!isset($_SESSION['auth']) or ($_SESSION['auth'] != 1 )){
    header ("Refresh: 0;URL=index.php");
    exit;
}

?>

<section class="presentation">
    <div class="col">
        <div class="main"><h1><?php echo $title; ?></h1></div>
        <div class="main"><p>Espace <b>Réservé</b> aux employés.</p></div>
    </div>
</section>


<!-- Grid d'affichage des partenaires -->
<div class="col"><?php
    // recupération de la liste des acteurs
    $requete = $bdd->query('select id_acteur, acteur, description, logo  from  acteur') or die(print_r($bdd->errorInfo()));

    //affichage des acteurs
    if ($requete->rowCount() > 0) {
        while ($donnees = $requete->fetch())
        {
            echo '    <div class="row"> <!-- un container par partenaire -->
                    <div class="side"> <!-- container pour le logo -->
                        <div class="fakeimg"><img src="/img/'.$donnees["logo"].'"></div>
                    </div>
                    <div class="main"> <!-- container pour le descriptif -->
                        <h3>'.$donnees["acteur"].'</h3>
                        <p>'.limite_ligne($donnees["description"],$max=1).'</p>
                        <div class="bouton">
                            <a href="acteur.php?id='.$donnees["id_acteur"].'" >Lire la suite...</a>
                        </div>
                    </div>
                </div>  <!-- affichage des acteurs -->
            ';
        }
        $requete->closeCursor();
    }

?>

</div>


<?php
include "footer.php";
?>
</body>
</html>



