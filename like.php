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
    echo "Cette page n'est pas accéssible directement <br />";
    echo "Vous allez être redirigé automatiquement.";
    header ("Refresh: 5;URL=actors.php");
    exit;
}

//verification de l'action like / Dislike
if ( isset($_GET['action']) and !empty($_GET['action']) and is_numeric($_GET['action']) or ( $_GET['action'] == 0 or $_GET['action'] == 1 ) ) {
    $vote = $_GET['action'];
}
else {
    echo "Cette page n'est pas accéssible directement <br />";
    echo "Vous allez être redirigé automatiquement.";
    header ("Refresh: 5;URL=actors.php");
}

// verification si l'utilisateur à déja liké on le lui refuse et on redirige vers la page acteur.php

$req_like = $bdd->query('select vote from  vote
                                 where id_acteur =' . $id_act . ' 
                                 and id_user = ' . $_SESSION['id_user'] . '
                                  ;' ) or die(print_r($bdd->errorInfo()));

//recupération du nombre de commentaire
$like = $req_like->fetch();

if ( $req_like->rowCount() == 0 ) {
    //aucun résultat, on update

    $update = $bdd->prepare('INSERT INTO vote(id_user, id_acteur, vote) VALUES(:userid, :acteurid, :vote) ON DUPLICATE KEY UPDATE vote = :vote ');
    $update->execute(array(
        'userid' => $_SESSION['id_user'],
        'acteurid' => $id_act,
        'vote' => $vote
    )) or die(print_r($bdd->errorInfo()));
    //var_dump($update);

    $update->closeCursor();
    header ("Refresh: 0;URL=acteur.php?id=$id_act");
}
else{
    if ( $like[0] == $vote ){
        // vote déja liké/disliké, on redirige vers la page de l'acteur

        header ("Refresh: 0;URL=acteur.php?id=$id_act");
    }else{
        //on ajoute une entrée ou on update le result
        $update = $bdd->prepare('INSERT INTO vote(id_user, id_acteur, vote) VALUES(:userid, :acteurid, :vote) ON DUPLICATE KEY UPDATE vote = :vote ');
        $update->execute(array(
            'userid' => $_SESSION['id_user'],
            'acteurid' => $id_act,
            'vote' => $vote
        )) or die(print_r($bdd->errorInfo()));
        //var_dump($update);

        $update->closeCursor();
        header ("Refresh: 0;URL=acteur.php?id=$id_act");

    }
}

//fin de l'insertion du nouveau message
?>
