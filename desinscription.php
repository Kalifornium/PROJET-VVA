<?php
session_start();

$con = mysqli_connect("localhost","root","root","gacti");
$user = $_SESSION['username'];
$noact = $_SESSION['noact'];
var_dump($user);
var_dump($noact);

$req = "DELETE FROM INSCRIPTION WHERE USER = '$user' AND NOACT = $noact";
$query = mysqli_query($con, $req);

//header('location:activite.php')

?>