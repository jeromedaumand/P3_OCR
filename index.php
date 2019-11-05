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


<section class="login">
    <div class="main">
        <h2>Formulaire de connexion</h2>
        <form action="auth.php" method="post" class="formulaire">
            <p>Nom d'utilisateur<br /> <input class="input_login" type="text" value="login" name="login"></p>
            <p>Mot de passe<br /><input class="input_password" type="password" value="password" name="password"></p>
            <input type="submit" class="input_bouton">
        </form>
        <div class="bouton"><a href="forget.php">Mot de passe oublié ?</a></div>
    </div>
</section>

<?php
include "footer.php";
?>

</body>
</html>
