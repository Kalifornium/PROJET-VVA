<?php include 'header.php'; ?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link href="style.css" rel="stylesheet">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<div class="wrapper fadeInDown">
<div id="formContent">

  <!-- Login Form -->
  <form style="padding-top: 2em;" action="login.php" method="POST">
    <input type="text" id="login" class="fadeIn second" name="login" placeholder="Nom d'utilisateur">
    <input type="password" id="password" class="fadeIn third" name="password" placeholder="Mot de passe">
    <input type="submit" class="fadeIn fourth" value="Se connecter"
      onmouseover="this.style.background= '#28a745'; this.style.color='white'"  onmouseout="this.style.background= 'white'; this.style.color='#28a745'"
      style="margin-top: 2em; color: #28a745; background-color: white; box-shadow: unset; border: 1px solid #28a745;">
  </form>
</div>
</div>
