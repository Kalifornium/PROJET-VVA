<meta charset="utf-8">
<body style="margin-left: 1em; margin-right: 1em;">
<?php
include 'header.php';
include 'function.php';
$con = mysqli_connect("localhost","root","root","gacti");
$req = "SELECT CODEANIM, NOMANIM, DATEVALIDITEANIM, DUREEANIM, LIMITEAGE, TARIFANIM, NBREPLACEANIM, DESCRIPTANIM FROM ANIMATION ORDER BY CODEANIM";
$query = mysqli_query($con, $req);

echo "<br><table border='1' style='width: 100%; text-align:center;'>
  <tr>
    <th>Code animation :</th>
    <th>Nom de l'animation:</th>
    <th>Date validité :</th>
    <th>Durée :</th>
    <th>Age minimum :</th>
    <th>Tarif :</th>
    <th>Places disponibles :</th>
    <th>Description :</th>
  </tr>";

  while($result = mysqli_fetch_array($query)){

    echo "<tr>
      <td>{$result['CODEANIM']}</td>
      <td>".strtoupper($result['NOMANIM'])."</a></td>
      <td>{$result['DATEVALIDITEANIM']}</td>
      <td>{$result['DUREEANIM']}&nbsp heures</td>
      <td>{$result['LIMITEAGE']}ans et +</td>
      <td>{$result['TARIFANIM']}€</td>
      <td>{$result['NBREPLACEANIM']}&nbsp places</td>
      <td>{$result['DESCRIPTANIM']}</td>
    </tr>";

  }

echo "</table>";

if(permission("en") || permission("ad"))
{
  echo '<br><form method="post" action="addanimation.php"><span>';
  echo '<input type="submit" class="btn btn-outline-success" value="Enregistrer une nouvelle animation"></form>';
  echo '<a href="editanimation.php"><input type="button"style="margin-left: .5em;" class="btn btn-outline-success" value="Modifier une animation"></a></span>';
}

?>
</body>
