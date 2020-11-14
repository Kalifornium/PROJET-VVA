<?php
include 'header.php';
date_default_timezone_set('Europe/Paris');
$con = mysqli_connect("localhost","root","root","gacti");
$req = "SELECT * FROM ANIMATION";
$query = mysqli_query($con, $req);
?>
<meta charset="utf-8">
<style>
  body
  {
    margin-left: 1em;
    margin-right: 1em;
  }
  input[type=text], [type=date] 
  {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
  }
</style>


<?php
if ((isset($_POST['code'])) && (isset($_POST['nom'])) && (isset($_POST['date']))  && (isset($_POST['duree'])) && (isset($_POST['age'])) && (isset($_POST['tarif']))
  && (isset($_POST['place'])) && (isset($_POST['description'])))
{
  if ((!empty($_POST['code'])) && (!empty($_POST['nom'])) && (!empty($_POST['date'])) && (!empty($_POST['duree'])) && (!empty($_POST['age']))
    && (!empty($_POST['tarif']))  && (!empty($_POST['place']))  && (!empty($_POST['description'])))
  {
    $con = mysqli_connect("localhost","root","root","gacti");
    $today = date("y.m.d");
    $req = "INSERT INTO animation VALUES ('$_POST[code]', '', '$_POST[nom]', '$today', '$_POST[date]', '$_POST[duree]',
    '$_POST[age]', '$_POST[tarif]', '$_POST[place]', '$_POST[description]', '', '')";
    if (!mysqli_query($con,$req))
    {
      echo "<script language=javascript>alert('Impossible d enregistrer l animation !');</script><br>";
    }
    else
    {
      echo "<script language=javascript>alert('L enregistrement est ajouté');</script>";
    }
  }
  else
  {
    $erreur = "<script language=javascript>alert('Un champs est vide');</script>";
  }
}
?>

<html>
<body>
  <?php if(isset($erreur)){echo $erreur;} ?>

  <form method="post" action="">
    <a>Code de l'animation :</a>
    <input type="text" name="code"><br>

    <a>Nom de l'animation :</a>
    <input type="text" name="nom"><br>

    <a>Date validité :</a><br>
    <input type="date" name="date" style="margin-top: .5em; margin-bottom: .5em; width: 100%;"><br>

    <a>Durée (en heures) :</a>
    <input type="text" name="duree"><br>

    <a>Age minimum :</a>
    <input type="text" name="age"><br>

    <a>Tarif (en €) :</a>
    <input type="text" name="tarif"><br>

    <a>Places disponibles :</a>
    <input type="text" name="place"><br>

    <a>Description :</a>
    <input type="text" name="description"><br>

    <input type="submit" class="btn btn-outline-success my-2 my-sm-0" value="Enregistrer une nouvelle animation">
  </form>

  <a href="animation.php">Retour aux animations</a>
</body>
</html>
