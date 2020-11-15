
<?php

/* Importation de la navbar et des fonctions stockées */
include 'header.php';
include 'function.php';

/* Définition de la timezone (obligatoire sinon bug) */
date_default_timezone_set('Europe/Paris');

/* Connexion à la BDD */
$con = mysqli_connect("localhost","root","root","gacti");

/* Requête pour afficher le menu des activités */
$reqplan = "SELECT * FROM ANIMATION AN, ACTIVITE A WHERE AN.CODEANIM = A.CODEANIM GROUP BY (AN.NOMANIM)";
$queryplan = mysqli_query($con, $reqplan);

/* Requête pour afficher le menu des dates des activités */
$reqplan2 = "SELECT DATEACT FROM ACTIVITE";
$queryplan2 = mysqli_query($con, $reqplan2);

/* Vérifie que le bouton "Annuler une activité" est utilisé */
if(isset($_POST['noactivite'])) 
{
	$noAct = $_POST['noactivite'];

	/* On attribue la date actuelle au champs date d'annulation afin qu'il ne soit plus NULL */
	$reqAnnul = "UPDATE ACTIVITE SET DATEANNULEACT = DATE(NOW()) WHERE NOACT = '$noAct' ";
	
	/* Si la requête s'éxécute correctement, on le confirme */
	if(mysqli_query($con, $reqAnnul))
		echo "<script language=javascript>alert('Activité n° {$noAct} annulée');</script>";
}

include 'formActDate.php';

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
				&& (!empty($_POST['nom'])) && (!empty($_POST['prenom'])))
	{
		/* Connexion à la BDD */
		$con = mysqli_connect("localhost","root","root","gacti");

		/* Stockage des données du formulaire */
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

		/* Si le champ date d'annulation est vide -> le champ deviens null */
		if(empty($_POST['dateannule']))
		{
			$req = "UPDATE activite SET DATEANNULEACT = NULL WHERE CODEANIM = '$code' AND NOACT = '$noact' ";
			$res = mysqli_query($con,$req);
		}
						
		/* Sinon on vérifie si la date de l'activité est déja prise. Si elle est libre -> On enregistre la date */
		if (verifDate($date)) /* Renvoie true -> Donc 0 résultat -> Libre */
		{
			/* PROBLEME = QUAND ON CHANGE PAS DE DATE -> RETOURNE 1 DANS LA FONCTION */
			$requete = "UPDATE activite SET NOACT = '$noact', CODEANIM = '$code', CODEETATACT = '$etatact', DATEACT = '$date',
					HRRDVACT = '$heurerdv', PRIXACT = '$tarif', HRDEBUTACT = '$hrdebut', HRFINACT = '$hrfin', 
					NOMRESP = '$nom', PRENOMRESP = '$prenom' WHERE CODEANIM = '$code' AND NOACT = '$noact' ";
			$resultat = mysqli_query($con, $requete);
			echo "<script language=javascript>alert('Modification réussie');</script>";
		}

		/* Sinon on enregistre pas et on affiche un message d'erreur */
		else if (verifDate($date) == false)
			echo "<script language=javascript>alert('Erreur, il y a déja une activité pour cette animation à ce jour');</script>";
	}

?>

<body>
	<?php

	/* Requête pour selectionner l'activité */
	$req = "SELECT * FROM ANIMATION AN, ACTIVITE A WHERE AN.CODEANIM = A.CODEANIM";
	$query = mysqli_query($con, $req);

	while($result = mysqli_fetch_array($query))
	{
		/* On vérifie qu'un activité et une date ait été choisies */
		if (isset($_POST['act']) && isset($_POST['dateact']))
		{ 
			/* On vérifie que c'est la même date dans le menu et dans la BDD */
			if(strpos($_POST['dateact'], $result['DATEACT']) !== false)
			{ 

			/* Remplissage automatique des champs */ ?>
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

				<a>Date d'annulation :</a>
				<input type="text" name="dateannule" onblur="verifchamps(this)" value="<?php echo $result["DATEANNULEACT"]; ?>"><br>

				<a>Nom responsable :</a>
				<input type="text" name="nom" onblur="verifchamps(this)" value="<?php echo $result["NOMRESP"]; ?>"><br>

				<a>Prénom responsable :</a>
				<input type="text" name="prenom" onblur="verifchamps(this)" value="<?php echo $result["PRENOMRESP"]; ?>"><br>

				<input type="submit" class="btn btn-outline-success my-2 my-sm-0" value="Modifier l'activité">

			</form>

				<?php 
			} 
		}
	}

	/* Formulaire pour annuler une activité */ ?>
	<form method="POST" action="editactivite.php">
		<input type="submit" class="btn btn-outline-success my-2 my-sm-0" value="Annuler l'activité">
		<input type="text" name="noactivite" onblur="verifchamps(this)">
	</form>

</body>