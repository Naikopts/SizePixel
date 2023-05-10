<?php
session_start();
if(isset($_SESSION['id'])) {
   header("Location: profil.php?id=".$_SESSION['id']);
}
include("includes/header.php");



require_once 'config/config.php';
 
if(isset($_POST['forminscription'])) {
   $pseudo = htmlspecialchars($_POST['pseudo']);
   $mail = htmlspecialchars($_POST['mail']);
   $mail2 = htmlspecialchars($_POST['mail2']);
   $mdp = sha1($_POST['mdp']);
   $mdp2 = sha1($_POST['mdp2']);
   if(!empty($_POST['pseudo']) AND !empty($_POST['mail']) AND !empty($_POST['mail2']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2'])) {
      $pseudolength = strlen($pseudo);
      if($pseudolength <= 255) {
         if($mail == $mail2) {
            if(filter_var($mail, FILTER_VALIDATE_EMAIL)) {
               $reqmail = $bdd->prepare("SELECT * FROM membres WHERE mail = ?");
               $reqmail->execute(array($mail));
               $mailexist = $reqmail->rowCount();
               if($mailexist == 0) {
                  if($mdp == $mdp2) {

                     $longeurKey = 15;
                     $key = "";
                     for($i=1;$i<$longeurKey;$i++){
                        $key .= mt_rand(0,9);
                     }


                     $insertmbr = $bdd->prepare("INSERT INTO membres(pseudo, mail, motdepasse, confirmkey, uniqid) VALUES(?, ?, ?, ?, ?)");
                     $insertmbr->execute(array($pseudo, $mail, $mdp, $key, uniqid() ));





                     $erreur = "Votre compte a bien été créé ! <a href=\"connexion.php\">Me connecter</a>";
                  } else {
                     $erreur = "Vos mots de passes ne correspondent pas !";
                  }
               } else {
                  $erreur = "Adresse mail déjà utilisée !";
               }
            } else {
               $erreur = "Votre adresse mail n'est pas valide !";
            }
         } else {
            $erreur = "Vos adresses mail ne correspondent pas !";
         }
      } else {
         $erreur = "Votre pseudo ne doit pas dépasser 255 caractères !";
      }
   } else {
      $erreur = "Tous les champs doivent être complétés !";
   }
}





?>
<html>

   <body>
   <div class="breadcrumb-area bg-overlay" style="background-image:url('assets/img/bg/13.png')">
        <div class="container">
            <div class="breadcrumb-inner text-center">
                <div class="section-title mb-0">
                    <h2 class="page-title">Inscription</h2>
                    <ul class="page-list">
                        <li><a href="/index.php">Accueil</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    <div class="contact-form-area pd-top-100 pd-bottom-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7 mt-4 mt-lg-0 ps-lg-5">
                    <div class="contact-form-inner-wrap">
                        <div class="section-title mb-0">
                            <h3 class="small-title mt-0">Inscription</h3>
                        </div>
                        <form method="POST" action="" class="mt-5 mt-md-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="single-input-inner style-border">
                                    <input type="text" placeholder="Votre pseudo" id="pseudo" name="pseudo" value="<?php if(isset($pseudo)) { echo $pseudo; } ?>" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="single-input-inner style-border">
                                    <input type="email" placeholder="Votre mail" id="mail" name="mail" value="<?php if(isset($mail)) { echo $mail; } ?>" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="single-input-inner style-border">
                                    <input type="email" placeholder="Confirmez votre mail" id="mail2" name="mail2" value="<?php if(isset($mail2)) { echo $mail2; } ?>" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="single-input-inner style-border">
                                    <input type="password" placeholder="Votre mot de passe" id="mdp" name="mdp" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="single-input-inner style-border">
                                    <input type="password" placeholder="Confirmez votre mdp" id="mdp2" name="mdp2" />
                                    </div>
                                </div>
                                <div class="col-12">
                                <input class="btn btn-base" type="submit" name="forminscription" value="Je m'inscris" />

                                </div>
                            </div>
                        </form>
                        <?php
         if(isset($erreur)) {
            echo '<font color="red">'.$erreur."</font>";
         }
         ?>
                    </div>
                </div>
            </div>
        </div>
    </div>



   </body>
</html>

<?php include("includes/footer.php"); ?>