<?php
include 'header.php';
$con = mysqli_connect("localhost","root","root","gacti");
$req = "SELECT * FROM ACTIVITE, ANIMATION";
$query = mysqli_query($con, $req); 
ini_set('display_errors','on'); ?>

<meta charset="utf-8">
<style>
	body{
		margin-left: 1em;
		margin-right: 1em;
	}
	input[type=text], [type=number], [type=date], [type=time]{
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
if ((isset($_POST['noact'])) && (isset($_POST['code'])) && (isset($_POST['codeetatact'])) && (isset($_POST['date'])) 
	&& (isset($_POST['heurerdv'])) && (isset($_POST['prix'])) && (isset($_POST['heuredebut'])) && (isset($_POST['heurefin'])) && (isset($_POST['datemax'])) 
	&& (isset($_POST['prenomresp'])) && (isset($_POST['nomresp'])))
{
	if ((!empty($_POST['noact'])) && (!empty($_POST['code'])) && (!empty($_POST['codeetatact'])) && (!empty($_POST['date']))
		&& (!empty($_POST['heurerdv'])) && (!empty($_POST['prix']))  && (!empty($_POST['heuredebut']))  && (!empty($_POST['heurefin'])) 
		&& (!empty($_POST['datemax']))  && (!empty($_POST['prenomresp'])) && (!empty($_POST['nomresp'])))
	{
			$result = mysqli_fetch_array($query);
			if('$_POST[date]' == $result['DATEACT'] && '$_POST[code]' == $result['CODEANIM'])
			{
				echo "<script language=javascript>alert('Impossible d enregistrer l animation !');</script><br>";
			}
			else
			{
				$con = mysqli_connect("localhost","root","root","gacti");
				$req = "INSERT INTO activite VALUES ('$_POST[noact]', '$_POST[code]', '$_POST[codeetatact]', '$_POST[date]', '$_POST[heurerdv]',
				'$_POST[prix]', '$_POST[heuredebut]', '$_POST[heurefin]', '$_POST[datemax]', '$_POST[prenomresp]', '$_POST[nomresp]')";
				if (!mysqli_query($con,$req))
				{
					echo "<script language=javascript>alert('Impossible d enregistrer l animation !');</script><br>";
				}
				else
				{
					echo "<script language=javascript>alert('L enregistrement est ajouté');</script>";
				}
			}
		
	}
	else
	{
		$erreur = "<script language=javascript>alert('Un champs est vide');</script>";
	}
}
?>

<html>
<body style="margin-bottom: 1em;">
	<?php if(isset($erreur)){echo $erreur;} ?>

	<form method="post" action="">
		<a>N° activité :</a>
		<input type="text" name="noact"><br>

		<a>Code animation :</a><br>
		<input type="text" maxlength="8" name="code"><br>

		<a>Code État Activité :</a>
		<input type="text" maxlength="2" name="codeetatact"><br>

		<a>Date :</a><br>
		<input type="date" name="date"><br>

		<a>Heure RDV :</a><br>
		<input type="time" name="heurerdv"><br>

		<a>Prix :</a><br>
		<input type="number" name="prix"><br>

		<a>Heure Début :</a><br>
		<input type="time" name="heuredebut"><br>

		<a>Heure Fin :</a><br>
		<input type="time" name="heurefin"><br>

		<a>Date max pour annuler :</a><br>
		<input type="date" name="datemax"><br>

		<a>Prénom responsable :</a>
		<input type="text" maxlength="30" name="prenomresp"><br>

		<a>Nom responsable :</a>
		<input type="text" maxlength="40" name="nomresp"><br>

		<input type="submit" class="btn btn-outline-success my-2 my-sm-0" value="Enregistrer une nouvelle activité">
	</form>

	<a href="activite.php">Retour au planning des activités</a>
</body> 
</html>