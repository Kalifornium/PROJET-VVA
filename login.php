<?php include 'header.php';

$con = mysqli_connect("localhost","root","root","gacti");

$username = $_POST['login'];
$password = $_POST['password'];
$req = "SELECT USER, MDP, TYPEPROFIL FROM COMPTE WHERE USER = '$username' AND MDP = '$password'";
$query = mysqli_query($con, $req);
$result = mysqli_fetch_array($query);
if($result == NULL)
{
  header('Location: pagelogin.php');
}
else {
  $_SESSION['username'] = $username;
  $_SESSION['typeprofil'] = $result['TYPEPROFIL'];
  header('Location: accueil.php');
}

?>
