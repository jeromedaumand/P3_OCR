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
    <?php
    show_error_message("Vous êtes maintenant déconnecté.",5);
    ?>
</section>

<?php
include "footer.php";
?>

</body>
</html>
