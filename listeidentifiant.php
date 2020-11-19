
<meta charset="utf-8">
<body style="margin-left: 1em; margin-right: 1em;">

<?php
include 'header.php';

$con = mysqli_connect("localhost","root","root","gacti");
$req = "SELECT USER, MDP, TYPEPROFIL FROM COMPTE";
$query = mysqli_query($con, $req);

echo "<br><table border='1' style='width: 50%; text-align:center;'>
    <tr>
        <th>Identifiant : </th>
        <th>Mot de passe :</th>
        <th>Type de compte : </th>
    </tr>";

while($result = mysqli_fetch_array($query))
 {
    echo "<tr>
        <td>{$result['USER']}</td>
        <td>{$result['MDP']}</td>
        <td>"; switch($result['TYPEPROFIL']){ 
                case "en": 
                    echo "Encadrant"; 
                    break;
                case "us": 
                    echo "Utilisateur"; 
                    break;
                case "ad": 
                    echo "Administrateur"; 
                    break;
                } echo "</td>
    </tr>";

}

echo "</table>";

?>