<meta charset="utf-8">

<?php
include 'header.php';
include 'function.php';

$con = mysqli_connect("localhost","root","root","gacti");

$reqplan = "SELECT * FROM ANIMATION AN, ACTIVITE A WHERE AN.CODEANIM = A.CODEANIM GROUP BY (AN.NOMANIM)";
$queryplan = mysqli_query($con, $reqplan);

$reqplan2 = "SELECT DATEACT FROM ACTIVITE";
$queryplan2 = mysqli_query($con, $reqplan2);

echo "<form action='' method='POST'>
<select style='margin-bottom: .5em; margin-top: 1em;' name='act'>
<option disabled selected> </option>";

while($resultplan = mysqli_fetch_array($queryplan))
{
	echo "<option> {$resultplan['NOMANIM']}</option>";
}

echo "</select>";

// 2EME LISTE

echo "<select style='margin-bottom:.5em; margin-top:1em; margin-left:.5em' name='dateact'>
<option disabled selected> </option>";

while($resultplan2 = mysqli_fetch_array($queryplan2))
{
	echo "<option> {$resultplan2['DATEACT']} </option>";
}

echo "</select>";

// FIN 2EME LISTE

echo "<br><input type='submit' name='bouton' value='Sélectionnez une activité' class='btn btn-outline-success'/></form>";

?>

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
	if ((!empty($_POST['noact'])) && (!empty($_POST['code'])) && (!empty($_POST['etatact'])) && (!empty($_POST['date']))
				&& (!empty($_POST['heurerdv'])) && (!empty($_POST['tarif']))  && (!empty($_POST['hrdebut']))  && (!empty($_POST['hrfin']))
				&& (!empty($_POST['dateannule'])) && (!empty($_POST['nom'])) && (!empty($_POST['prenom'])))
	{
		$con = mysqli_connect("localhost","root","root","gacti");
		$noact = $_POST['noact'];
		$code = $_POST['code'];
		$etatact = $_POST['etatact'];
		$date = $_POST['date'];
		$heurerdv = $_POST['heurerdv'];
		$tarif = $_POST['tarif'];
		$hrdebut = $_POST['hrdebut'];
		$hrfin = $_POST['hrfin'];
		$dateannule = $_POST['dateannule'];
		$nom = $_POST['nom'];
		$prenom = $_POST['prenom'];

		$req = "SELECT * FROM ACTIVITE WHERE CODEANIM = $code, DATEACT = $date";
		$query = mysqli_query($con, $req);
		$bool1 = mysqli_fetch_array($query);
		if(!$bool1)
		{
			$req = "UPDATE activite SET NOACT = '$noact', CODEANIM = '$code', CODEETATACT = '$etatact', DATEACT = '$date',
							HRRDVACT = '$heurerdv', PRIXACT = '$tarif', HRDEBUTACT = '$hrdebut', HRFINACT = '$hrfin',
							DATEANNULEACT = '$dateannule', NOMRESP = '$nom', PRENOMRESP = '$prenom' WHERE CODEANIM = '$code' AND NOACT = '$noact' ";
		}
		else
		{
			echo "<script language=javascript>alert('Impossible de modifier l activité, la date est déja prise !!');</script>";
		}

		if (!mysqli_query($con,$req))
		{
			echo "<script language=javascript>alert('Impossible de modifier l activité');</script>";
		}
		else
		{
			echo "<script language=javascript>alert('Modification réussie');</script>";
		}
	}
?>

<!-- Remplissage automatique des champs -->
<body>
	<?php

	$req = "SELECT * FROM ANIMATION AN, ACTIVITE A WHERE AN.CODEANIM = A.CODEANIM";
	$query = mysqli_query($con, $req);

	while($result = mysqli_fetch_array($query))
	{
		if (isset($_POST['act']) && isset($_POST['dateact']))
		{
			if(strpos($_POST['dateact'], $result['DATEACT']) !== false)
			{ ?>

				<form method="post" action="editactivite.php">

					<a>Numéro de l'activité :</a>
					<input type="text" name="noact" onblur="verifchamps(this)" value="<?php echo $result["NOACT"]; ?>"><br>

					<a>Code de l'animation :</a>
					<input type="text" name="code" onblur="verifchamps(this)" value="<?php echo $result["CODEANIM"]; ?>"><br>

					<a>État :</a><br>
					<input type="text" name="etatact" onblur="verifchamps(this)" value="<?php echo $result["CODEETATACT"]; ?>"><br>

					<a>Date :</a>
					<input type="date" name="date" onblur="verifchamps(this)" value="<?php echo $result["DATEACT"]; ?>"><br>

					<a>Heure :</a>
					<input type="text" name="heurerdv" onblur="verifchamps(this)" value="<?php echo $result["HRRDVACT"]; ?>"><br>

					<a>Tarif (en €) :</a>
					<input type="text" name="tarif" onblur="verifchamps(this)" value="<?php echo $result["PRIXACT"]; ?>"><br>

					<a>Heure début :</a>
					<input type="text" name="hrdebut" onblur="verifchamps(this)" value="<?php echo $result["HRDEBUTACT"]; ?>"><br>

					<a>Heure fin :</a>
					<input type="text" name="hrfin" onblur="verifchamps(this)" value="<?php echo $result["HRFINACT"]; ?>"><br>

					<a>Date max pour annuler :</a>
					<input type="text" name="dateannule" onblur="verifchamps(this)" value="<?php echo $result["DATEANNULEACT"]; ?>"><br>

					<a>Nom responsable :</a>
					<input type="text" name="nom" onblur="verifchamps(this)" value="<?php echo $result["NOMRESP"]; ?>"><br>

					<a>Prénom responsable :</a>
					<input type="text" name="prenom" onblur="verifchamps(this)" value="<?php echo $result["PRENOMRESP"]; ?>"><br>

					<input type="submit" class="btn btn-outline-success my-2 my-sm-0" value="Modifier une activité">
				</form>

				<?php
			}
		}
	} ?>

	<a href="activite.php">Retour aux activités</a>

</body>
