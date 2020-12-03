<?php
session_start();

/* Définition de la timezone (obligatoire sinon bug) */
date_default_timezone_set('Europe/Paris');

$con = mysqli_connect("localhost","root","root","gacti");
$user = $_SESSION['username'];
$noact = $_GET['act'];
var_dump($user);
var_dump($noact);

$req = "DELETE FROM INSCRIPTION WHERE USER = '$user' AND NOACT = $noact";
$query = mysqli_query($con, $req);
var_dump($query);

header('location:activite.php')

?>
