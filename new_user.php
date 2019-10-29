<?php
include ('inc_db_connection.php');
include ('constante.php');



//formulaire de création utilisateur
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
        <div class="main"><p>Création d'un nouvel utilisateur.<br />Merci de compléter les champs ci dessous.</p></div>
    </div>
</section>


<section class="login">
    <div class="main">
        <form action="create_new_user.php" method="post" class="formulaire">
            <p>Nom d'utilisateur<br /><input class="input_login" type="text" value="login" name="login"></p>
            <p>Votre nom<br /><input class="input_login" type="text" value="nom" name="nom"></p>
            <p>Votre prénom<br /><input class="input_login" type="text" value="prenom" name="prenom"></p>
            <p>Mot de passe<br /><input class="input_password" type="password" " value="password" name="password"></p>
            <p>Question secrète<br /><input class="input_login" type="text" value="Question" name="question"></p>
            <p>Votre réponse à la question secrète<br /><input class="input_login" type="text" value="réponse" name="reponse"></p>
            <input type="submit" class="input_bouton">
        </form>
    </div>
</section>

<?php
include "footer.php";
?>

</body>
</html>