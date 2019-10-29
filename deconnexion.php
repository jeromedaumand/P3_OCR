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
        <div class="main"><p>A bientot sur notre Extranet.</p></div>
    </div>
</section>

<?php
// vidage de la session
unset($_SESSION['username']);
unset($_SESSION['login']);
unset($_SESSION['auth']);
?>
<section class="login">
    <div class="main">
        <p>Vous êtes maintenant déconnecté</p>
    </div>
</section>

<?php
header ("Refresh: 5;URL=index.php");
include "footer.php";
?>

</body>
</html>
