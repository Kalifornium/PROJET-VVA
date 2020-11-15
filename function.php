<?php

function estInscrit($ligne)
{
  $user = "";
  if(isset($_SESSION['username']))
  {
    $user = $_SESSION['username'];
  }
  $con = mysqli_connect("localhost","root","root","gacti");
  $req = "SELECT * FROM INSCRIPTION WHERE NOACT = '$ligne' AND USER = '$user' ";
  $query = mysqli_query($con, $req);
  $result = mysqli_fetch_array($query);

  if(mysqli_num_rows($query) == 0) echo "<td><a href='inscriptionactivite.php'>S'inscrire</a></td>";
  else echo "<td style='text-decoration: none;'><a href='#'>Se désinscrire</a></td>";
}

function permission($string)
{
  if(isset($_SESSION['username']))
  {
    $user = $_SESSION['username'];
    $con = mysqli_connect("localhost","root","root","gacti");
    $req = "SELECT * FROM COMPTE WHERE USER = '$user'";
    $query = mysqli_query($con, $req);
    $result = mysqli_fetch_array($query);
    $var = $string;
    if($result['TYPEPROFIL'] == $var)
      return true;
  }
}

function verifDate($date)
{
  $con = mysqli_connect("localhost","root","root","gacti");
  $req = "SELECT * FROM ACTIVITE WHERE DATEACT = '$date' ";
  $query = mysqli_query($con, $req);
  if(mysqli_num_rows($query) == 0)
    return true;
  else
    return false;
}

?>

<script type="text/javascript">
function verifchamps(champ)
{
  if(champ.value == "")
  {
    surligne(champ, true);
    return false;
  }
  else
  {
    surligne(champ, false);
    return true;
  }
}
function surligne(champ, erreur)
{
  if(erreur)
  {
    champ.style.border = "1px solid red";
    champ.placeholder = "Veuillez remplir le champ";
  }
  else {
    champ.style.border = "1px solid #ccc";
  }
}

function alertMessage(message)
{
  alert(message);
}
</script>