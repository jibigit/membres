<?php
  session_start();

// Si on a le code 2 on accède à la page

  // on demarre une session avec les variable cookies
  if (isset($_GET['code'])) {
    if ($_GET['code']== 2) {
      $_SESSION['pseudo'] = $_COOKIE['pseudo'];
      $_SESSION['pass'] = $_COOKIE['pass'];
    }
  }
// Reglage de la time session

  if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 60)) {
   session_unset();
   session_destroy();
}
$_SESSION['LAST_ACTIVITY'] = time();

// Si les variables de session sont vides, renvoie vers la page de connexion
if (empty($_SESSION['pseudo']) && empty($_SESSION['pass'])) {
  header("Location: connexion.php?code=3");
}
// Le code 1 renvoie vers une deconnexion de session

if (!empty($_GET['code'])) {
  if ($_GET['code'] == 1) {
    session_destroy();
    setcookie('pseudo', "");
    setcookie('pass', "");
  header("Location: connexion.php?code=2");
  }
}
?>

<html>

    <head>
        <meta charset="utf-8" />
        <title>Un espace membres</title>
        <link href="style.css" rel="stylesheet" />
    </head>

    <body>

      <?php
        echo "<p>Bonjour " . $_SESSION['pseudo'] . " bienvenu sur votre espace membre.</p>";
       ?>

       <a href="espacemembre.php?code=1">Me déconnecter</a>

    </body>

  </html>