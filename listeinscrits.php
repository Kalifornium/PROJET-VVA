
<meta charset="utf-8">
<body style="margin-left: 1em; margin-right: 1em;">

<?php 
include 'header.php';

$con = mysqli_connect("localhost","root","root","gacti");
$req = "SELECT I.USER, I.NOACT, A.NOMANIM FROM INSCRIPTION I, ACTIVITE AC, ANIMATION A WHERE I.NOACT = AC.NOACT AND A.CODEANIM = AC.CODEANIM ORDER BY A.NOMANIM";
$query = mysqli_query($con, $req); 

echo "
<table border='1' style='width: 25%; text-align:center;'>
    <tr>
        <th>Nom :</th>
        <th>Nom de l'activité :</th>
    </tr>";

while($res = mysqli_fetch_array($query))
{
    echo "<tr>
    <td> {$res['USER']} </td>
    <td> {$res['NOMANIM']} </td>
    </tr>";
} 

echo "</table>";

?>