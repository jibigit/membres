<?php
// Treat the data in variables and protect them
$pseudo = htmlspecialchars($_POST['pseudo']);
$pass = sha1(htmlspecialchars($_POST['pass']));
$passconfirm = sha1(htmlspecialchars($_POST['passconfirm']));
$mail = htmlspecialchars($_POST['email']);
// Check if there is no empty field
if (empty($pseudo) || empty($pass) || empty($passconfirm) || empty($mail)) {
  header("Location: inscription.php?code=1");
  exit;
}
// Check if it is the right password
if ($pass != $passconfirm) {
  header("Location: inscription.php?code=2");
  exit;
}
// Addtionnaly checking for the email adresse with regex
if (!preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $mail)) {
  header("Location: inscription.php?code=3");
  exit;
}
// Connexion to the data base
require ('db.php');
// Check if the pseudo is already used otherwise add the user
$data = $bdd->query('SELECT * FROM membres WHERE pseudo="'.$pseudo.'" ');
$test = $data->fetch();
if ($test) {
  header("Location: inscription.php?code=4");
  exit;
}
else {
  $request = $bdd->prepare('INSERT INTO membres (pseudo, pass, email, date_inscription) VALUES(:pseudo, :pass, :email, NOW())');
  $request->execute([
    'pseudo'=>$pseudo,
    'pass'=>$pass,
    'email'=>$mail,
  ]);
  header("Location: connexion.php?code=1");
  exit;
}
$data->closeCursor();
$request->closeCursor();
 ?>