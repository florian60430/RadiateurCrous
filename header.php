<?php 
include "config.php";

try
{
	$bdd = new PDO('mysql:host=' . $ip . '; dbname=' . $dbname . '; charset=utf8', $username, $password);
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

?>