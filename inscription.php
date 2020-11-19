<?php
session_start();

/* Définition de la timezone (obligatoire sinon bug) */
date_default_timezone_set('Europe/Paris');

$con = mysqli_connect("localhost","root","root","gacti");
$user = $_SESSION['username'];
$noact = $_SESSION['noact'];
var_dump($user);
var_dump($noact);

$req = "INSERT INTO INSCRIPTION VALUES('', '$user', $noact, DATE(NOW()), NULL)";
$query = mysqli_query($con, $req);

//header('location:activite.php')

?>