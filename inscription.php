<html>

    <head>
        <meta charset="utf-8" />
        <title>Inscrivez vous dans l'espace MEMBRES</title>
        
    </head>

    <body>

       <h1>Inscription membres</h1>

       <!-- Vérifier les erreur renvoyées dans l'url et afficher un message d'erreur-->
       <?php
       if (!empty($_GET['code'])) {
          if ($_GET['code'] == 1) {
            echo "Vous n'avez  pas rempli tous les champs";
          }
          elseif ($_GET['code'] == 2) {
            echo "Les mots de passe ne correspondent pas !";
          }
          elseif ($_GET['code'] == 3) {
            echo "Adresse mail invalide";
          }
          elseif ($_GET['code'] == 4) {
            echo "Ce pseudonyme est déjà utilisé, veuillez en choisir un autre !";
          }
          else {
            echo "Erreur, veuillez réessayer";
          }
        }
        ?>

<!-- Formulaire -->
       <form action="traitementform.php" method="post">

           <label>Pseudo
             <p>
               <input type="text" name="pseudo">
             </p>
           </label>
            <label>Mot de passe
             <p>
               <input type="password" name="pass">
             </p>
           </label>
           <label>Confirmez votre mot de passe
            <p>
              <input type="password" name="passconfirm">
            </p>
          </label>
          <label>Votre email
           <p>
             <input type="email" name="email">
           </p>
         </label>

         <input type="submit" name="name" value="M'inscrire">
       </form>

<!-- Lien direct vers la page connexio -->
       <div>
         <a href="connexion.php">Déja inscrit ? Identifiez-vous</a>
       </div>

    </body>

  </html>