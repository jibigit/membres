<?php
// Try to connect to the database
try {
  $bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', 'amsterdam');
}
// If the connection is impossible get the error message
catch (Exception $exception) {
  die ('erreur :'. $exception->getMessage());
}
 ?>