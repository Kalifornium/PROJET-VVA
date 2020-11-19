<body style="margin-left: 1em; margin-right: 1em;">
  <?php
  include 'header.php';

  $con = mysqli_connect("localhost","root","root","gacti");

  ini_set('display_errors','on');

  $reqplan = "SELECT * FROM ANIMATION AN, ACTIVITE A WHERE AN.CODEANIM = A.CODEANIM GROUP BY (AN.NOMANIM) ORDER BY AN.NOMANIM";
  $queryplan = mysqli_query($con, $reqplan);

  echo "<form action='' method='POST' style='margin-top: 1em;'>
  Trier par animation : <select name='anim'>
  <option disabled selected> </option>";

  while($resultplan = mysqli_fetch_array($queryplan))
  {
    echo "<option> {$resultplan['NOMANIM']} </option>";
  }

  echo "</select>
  <input type='submit' value='Sélectionnez une animation' class='btn btn-outline-success'/>
  </form>";

  echo "<br><table border='1' style='width: 100%; text-align:center;'>
  <tr>
  <th>N° activité :</th>
  <th>Code animation :</th>
  <th>Nom animation :</th>
  <th>Places libres :</th>
  <th>Code État Activité :</th>
  <th>Date :</th>
  <th>Heure RDV :</th>
  <th>Prix :</th>
  <th>Heure Début :</th>
  <th>Heure Fin :</th>
  <th>Date d'annulation :</th>
  <th>Nom responsable :</th>
  <th>Prénom responsable :</th>
  </tr>";

  $req = 'SELECT * FROM ANIMATION AN, ACTIVITE A WHERE AN.CODEANIM = A.CODEANIM AND DATEANNULEACT IS NULL ORDER BY A.NOACT';
  $query = mysqli_query($con, $req);

  while($result = mysqli_fetch_array($query))
  {
    if (isset($_POST['anim']))
    {
      if($result['NOMANIM'] == $_POST['anim'])
      {
        echo "<tr>
        <td>{$result['NOACT']}</td>
        <td>{$result['CODEANIM']}</td>
        <td>{$result['NOMANIM']}</td>
        <td>{$result['NBREPLACEANIM']}</td>
        <td>{$result['CODEETATACT']}</td>
        <td>{$result['DATEACT']}</td>
        <td>{$result['HRRDVACT']}</td>
        <td>{$result['PRIXACT']}</td>
        <td>{$result['HRDEBUTACT']}</td>
        <td>{$result['HRFINACT']}</td>
        <td>{$result['DATEANNULEACT']}</td>
        <td>{$result['NOMRESP']}</td>
        <td>{$result['PRENOMRESP']}</td>";
        if(permission("us"))
        {
          if($result['CODEETATACT'] == "FE")
          {
            echo "<td>Activité fermée</td>";
          }
          else
          {
            estInscrit($result['NOACT']);
          }
        }
        echo "</tr>";
      }
    }
    else
    {
      echo "<tr>
      <td>{$result['NOACT']}</td>
      <td>{$result['CODEANIM']}</td>
      <td>{$result['NOMANIM']}</td>
      <td>{$result['NBREPLACEANIM']}</td>
      <td>{$result['CODEETATACT']}</td>
      <td>{$result['DATEACT']}</td>
      <td>{$result['HRRDVACT']}</td>
      <td>{$result['PRIXACT']}</td>
      <td>{$result['HRDEBUTACT']}</td>
      <td>{$result['HRFINACT']}</td>
      <td>{$result['DATEANNULEACT']}</td>
      <td>{$result['NOMRESP']}</td>
      <td>{$result['PRENOMRESP']}</td>";
      if(permission("us"))
      {
        $_SESSION['noact'] = $result['NOACT'];
        if($result['CODEETATACT'] == "FE")
          echo "<td>Activité fermée</td>";
        else if (estInscrit($result['NOACT']))
        {
          echo "<td style='text-decoration: none;'><a href='activite.php?desinscription=test'>Se désinscrire</a></td>";
          if(isset($_GET['desinscription']))
          {
            $user = $_SESSION['username'];
            $noact = $result['NOACT'];
            $reqDesinscrire = "DELETE FROM INSCRIPTION WHERE USER = '$user' AND NOACT = $noact";
            $queryDesinscrire = mysqli_query($con, $reqDesinscrire);

            var_dump($user);
            var_dump($noact);

          }
        }
        else
        {
          echo "<td><a href='activite.php?inscription=test'>S'inscrire</a></td>";
          if(isset($_GET['inscription']))
          {
            $user = $_SESSION['username'];
            $noact = $result['NOACT'];
            $reqDesinscrire = "INSERT INTO INSCRIPTION VALUES('', '$user', $noact, DATE(NOW()), NULL)";
            $queryDesinscrire = mysqli_query($con, $reqDesinscrire);

            var_dump($user);
            var_dump($noact);

          }
        }
      }
      echo "</tr>";
    }
  }

  echo "</table>";

  if(permission("en") || permission("ad"))
  {
    echo '<br><form method="post" action="addactivite.php"><span>';
    echo '<input type="submit" class="btn btn-outline-success" value="Enregistrer une nouvelle activité"></form>';
    echo '<a href="editactivite.php"><input type="button"style="margin-left: .5em;" class="btn btn-outline-success" value="Modifier une activité"></a></span>';
  }

?>