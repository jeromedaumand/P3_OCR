<?php
// parametre de connection MYSQL
$my_server = "localhost";
$my_db = "ocr";
$my_user = "";
$my_password = "";



if ( ($my_password == "") and ($my_user == "") )
{
	Echo "Merci de renseigner les noms d'utilisateur et mot de passe de la base de données dans le fichier inc_db_connection.php !!";
}

if ( ($my_server == "") and ($my_db == "") )
{
	echo "Merci de renseigner le serveur et la base de données dans le fichier inc_db_connection.php !!";
}


try
{
	$bdd = new PDO('mysql:host='.$my_server.';dbname='.$my_db.';charset=utf8', $my_user, $my_password,  array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch (Exception $e)
{
	die('erreur : ' . $e->getMessage());
}


?>