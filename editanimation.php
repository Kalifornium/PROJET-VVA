<meta charset="utf-8">

<?php
include 'header.php';
include 'function.php';

ini_set('display_errors','on');

$con = mysqli_connect("localhost","root","root","gacti");
$req = "SELECT * FROM ANIMATION";
$query = mysqli_query($con, $req);

$reqplan = "SELECT * FROM ANIMATION";
$queryplan = mysqli_query($con, $reqplan);

echo "<form action='' method='POST'>
<select style='margin-bottom: .5em; margin-top: 1em;' name='anim'>
<option disabled selected> </option>";

while($resultplan = mysqli_fetch_array($queryplan))
{
	echo "<option> {$resultplan['NOMANIM']} </option>";
}

echo "</select><br>
<input type='submit' value='Sélectionnez une animation' class='btn btn-outline-success'/>
</form>";

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
	if ((!empty($_POST['code'])) && (!empty($_POST['nom'])) && (!empty($_POST['date'])) && (!empty($_POST['duree'])) && (!empty($_POST['age']))
	&& (!empty($_POST['tarif']))  && (!empty($_POST['place']))  && (!empty($_POST['description'])))
	{
	$con = mysqli_connect("localhost","root","root","gacti");
	$code = $_POST['code'];
	$nom = $_POST['nom'];
	$date = $_POST['date'];
	$duree = $_POST['duree'];
	$age = $_POST['age'];
	$tarif = $_POST['tarif'];
	$place = $_POST['place'];
	$description = $_POST['description'];

	$req = "UPDATE animation SET NOMANIM = '$nom', DATEVALIDITEANIM = '$date', DUREEANIM = '$duree', LIMITEAGE = '$age',
							TARIFANIM = '$tarif', NBREPLACEANIM = '$place', DESCRIPTANIM = '$description' WHERE CODEANIM = '$code' ";

		if (!mysqli_query($con,$req))
		{
			echo "<script language=javascript>alert('Impossible de modifier l animation');</script>";
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
	while($result = mysqli_fetch_array($query))
	{
		if (isset($_POST['anim']))
		{
			if($result['NOMANIM'] == $_POST['anim'])
			{ ?>

				<form method="post" action="">
					<a>Code de l'animation :</a>
					<input type="text" name="code" onblur="verifchamps(this)" value="<?php echo $result["CODEANIM"]; ?>"><br>

					<a>Nom de l'animation :</a>
					<input type="text" name="nom" onblur="verifchamps(this)" value="<?php echo $result["NOMANIM"]; ?>"><br>

					<a>Date validité :</a><br>
					<input type="date" name="date" onblur="verifchamps(this)" value="<?php echo $result["DATEVALIDITEANIM"]; ?>"><br>

					<a>Durée (en heures) :</a>
					<input type="text" name="duree" onblur="verifchamps(this)" value="<?php echo $result["DUREEANIM"]; ?>"><br>

					<a>Age minimum :</a>
					<input type="text" name="age" onblur="verifchamps(this)" value="<?php echo $result["LIMITEAGE"]; ?>"><br>

					<a>Tarif (en €) :</a>
					<input type="text" name="tarif" onblur="verifchamps(this)" value="<?php echo $result["TARIFANIM"]; ?>"><br>

					<a>Places disponibles :</a>
					<input type="text" name="place" onblur="verifchamps(this)" value="<?php echo $result["NBREPLACEANIM"]; ?>"><br>

					<a>Description :</a>
					<input type="text" name="description" onblur="verifchamps(this)" value="<?php echo $result["DESCRIPTANIM"]; ?>"><br>

					<input type="submit" class="btn btn-outline-success my-2 my-sm-0" value="Modifier une animation">
				</form>

				<?php
			}
		}
	} ?>

	<a href="animation.php">Retour aux animations</a>

</body>
