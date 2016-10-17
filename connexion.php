<?php
  session_start();
// If your session is not over you are redirected to the member page
  // vérifier la présence des variables session, si ok renvoyer vers espace membre
  if (isset($_SESSION['pseudo']) && isset($_SESSION['pass'])) {
    header("Location: espacemembre.php");
    exit;
  }
// Vérifier la présence de cookies
//Si y en a pas, rediriger vers l'espace membre
  if (isset($_COOKIE['pseudo']) && isset($_COOKIE['pass']) && $_GET['code'] != 3) {
    header("Location: espacemembre.php?code=2");
    exit;
  }
// Connexion base de données
  require ('db.php');
// Vérifier les champs du formulaire
  if (isset($_POST['pseudo']) && isset($_POST['pass'])) {
// Sécuriser les champs du formulaire
  $pseudo = htmlspecialchars($_POST['pseudo']);
  $pass = sha1(htmlspecialchars($_POST['pass']));

// Vérifier dans la DB si le pseudo et le pass existent
  $request = $bdd->prepare('SELECT * FROM membres WHERE pseudo= :pseudo AND pass= :pass');
  $request->execute([
    'pseudo'=>$pseudo,
    'pass'=>$pass
  ]);
$user = $request->fetch();
// Si c'est bon, j'ouvre une session
if ($user) {
  $_SESSION['pseudo'] = $pseudo;
  $_SESSION['pass'] = $pass;
  if (isset($_POST['cookie'])) {
    setcookie('pseudo', $pseudo, time() + 365*24*3600, null, null, false, true);
    setcookie('pass', $pass, time() + 365*24*3600, null, null, false, true);
  }
  header("Location: espacemembre.php");
  exit;
}
else {
  echo "Ce compte n'existe pas ";
}
}
 ?>

<html>

    <head>
        <meta charset="utf-8" />
        <title>Un espace membres</title>
        
    </head>

    <body>

<!-- Codes d'erreur -->
      <?php
          if (!empty($_GET['code'])) {
            if ($_GET['code'] == 1) {
              echo "<p>Identifiez-vous</p>";
            }
            if ($_GET['code'] == 2) {
              echo "<p>Vous êtes déconnecté</p>";
            }
            if ($_GET['code'] == 3) {
              echo "<p>Votre session a expiré</p>";
            }
            else {
              echo "<p>Connectez-vous</p>";
            }
          }
       ?>

       <!-- Formulaire -->
              <form action="" method="post">

                  <label>Votre pseudo
                    <p>
                      <input type="text" name="pseudo">
                    </p>
                  </label>
                   <label>Mot de passe
                    <p>
                      <input type="password" name="pass">
                    </p>
                  </label>
                  <label>Connexion automatique
                     <input type="checkbox" name="cookie">
                 </label>

                <p>
                  <input type="submit" value="Me connecter">
                </p>

              </form>

    </body>

  </html>