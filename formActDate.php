
<form action='' method='POST'>

<!-- Menu pour le nom de l'activité -->

<select style='margin-bottom: .5em; margin-top: 1em;' name='act'>

<option disabled selected> </option>

<?php 

while($resultplan = mysqli_fetch_array($queryplan))
{
	echo "<option> {$resultplan['NOMANIM']}</option>";
}

?>

</select>

<!-- Menu pour la date de l'activité -->

<select style='margin-bottom:.5em; margin-top:1em; margin-left:.5em' name='dateact'>

<option disabled selected> </option>

<?php

while($resultplan2 = mysqli_fetch_array($queryplan2))
{
	echo "<option> {$resultplan2['DATEACT']} </option>";
}

?>

</select>

<br><input type='submit' name='bouton' value='Sélectionnez une activité' class='btn btn-outline-success'/>

</form>