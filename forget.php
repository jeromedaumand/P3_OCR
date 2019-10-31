<?php
//test extranet banquaire pour OCR
include ('inc_db_connection.php');
include ('constante.php');
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
        <div class="main"><p>Espace <b>Réservé</b> aux employés.<br />Merci de vous authentifer.</p></div>
    </div>
</section>

<?php
if (isset($_POST['form_type']) and !empty($_POST['form_type']) and $_POST['form_type'] == 'form_log')
{
    //récupération de la question en fonction du login et affichage pour traitement
    // ou affichage d'un message d'erreur et redirection;
    $login = htmlspecialchars($_POST['login']);

    $req_log = $bdd->query('select question from users 
                                 where username = "'.$login.'" 
                                 limit 1;' ) or die(print_r($bdd->errorInfo()));
    $question = $req_log->fetch();

    if ($req_log->rowCount() == 0){
        echo 'Aucun login trouvé !!';
        header ("Refresh: 5;URL=forget.php");
        exit;
    }

    ?>


    <section class="login">
        <div class="main">
            <form action="forget.php" method="post" class="formulaire">
                <p>Question secrete <br /><?php echo htmlspecialchars($question[0]);?></p>
                <p>Votre réponse<br /><input class="input_login" type="text" " value="réponse" name="answer" autofocus></p>
                <input class="input_login" type="hidden" " value="form_query" name="form_type" >
                <input class="input_login" type="hidden" " value="<?php echo $login; ?>" name="login" >
                <input type="submit" class="input_bouton">
            </form>
        </div>
    </section>

    <?php
}

if (isset($_POST['form_type']) and !empty($_POST['form_type']) and $_POST['form_type'] == 'form_query')
{
    $login = htmlspecialchars($_POST['login']);
    $reponse = htmlspecialchars($_POST['answer']);

    // traitement de la réponse. si c'est pas bon on redirige.
    $req_question = $bdd->query('select reponse from users
                                    where username = "' . htmlspecialchars($login) . '"
                                    limit 1;' ) or die(print_r($bdd->errorInfo()));

    $answer_bdd = $req_question->fetch();

    if ( htmlspecialchars($answer_bdd[0]) == $reponse ){
        $new_pass = passgen1(10);
        echo 'Votre nouveau mot de passe est : ' . $new_pass . '<br />';
        echo 'Pensez à le changer !';

        $req_pass = $bdd->query('update users
        set password = sha1("' . $new_pass . '")
        where username = "' . htmlspecialchars($login) . '"         
        limit 1;' ) or die(print_r($bdd->errorInfo()));

    }else{
        echo "ce n'est pas la bonne réponse !!";
        header ("Refresh: 5;URL=forget.php");
    }
}




// affichage du form de base si form_log n'existe pas ou est vide
if (!isset($_POST['form_type']) or empty($_POST['form_type'])){

?>

<section class="login">
    <div class="main">
        <form action="forget.php" method="post" class="formulaire">
            <p>Veuillez indiquer votre nom d'uilisateur<br />
                <input class="input_login" type="text" " value="login" name="login" autofocus></p>
            <input class="input_login" type="hidden" " value="form_log" name="form_type">
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
