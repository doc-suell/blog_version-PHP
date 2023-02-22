<?php 
// pour se connecter, on va utiliser la classe native PHP PDO
try{
	$bdd = new PDO('mysql:host=localhost;dbname=blog', 'root', '');
}
catch (Exception $e)
{
	die('Erreur : ' .$e->getMessage());
}


