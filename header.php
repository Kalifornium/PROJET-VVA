<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>GACTI VVA</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">GACTI</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">

        <li class="nav-item">
          <a class="nav-link" href="accueil.php">Page d'accueil</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="animation.php">Animation</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="activite.php">Planning des activités</a>
        </li>

        <?php if(isset($_SESSION['username'])){ $user = $_SESSION['username']; ?>
        <li class="nav-item">
          <a class="nav-link"><?php echo "Bonjour, $user !"?></a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="logout.php"><?php echo "Déconnexion"?></a>
        <?php } else { ?>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="pagelogin.php">Connexion</a>
        </li>
      <?php } ?>

    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Rechercher" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit" > Go !</button>
    </form>
  </div>
</nav>
