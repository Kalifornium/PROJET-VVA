<?php
session_start();

/* Définition de la timezone (obligatoire sinon bug) */
date_default_timezone_set('Europe/Paris');

$con = mysqli_connect("localhost","root","root","gacti");
$user = $_SESSION['username'];
$noact = $_GET['act'];

$requete = "SELECT * FROM COMPTE C, ACTIVITE A WHERE A.NOACT = $noact AND C.USER = '$user' ";
$execrequete = mysqli_query($con, $requete);
$resultat = mysqli_fetch_array($execrequete);
$dateact = $resultat['DATEACT'];
$datedebutvac = $resultat['DATEDEBSEJOUR'];
$datefinvac = $resultat['DATEFINSEJOUR'];
if($dateact >= $datedebutvac && $dateact <= $datefinvac)
{
    $req = "INSERT INTO INSCRIPTION VALUES('', '$user', $noact, DATE(NOW()), NULL)";
    $query = mysqli_query($con, $req);
    header('location:activite.php?alert=good');
}
else
{
    header('location:activite.php?alert=error');
}

?>
