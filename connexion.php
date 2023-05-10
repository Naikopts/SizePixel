<?php
session_start();



if(isset($_SESSION['id'])) {
   header("Location: profil.php?id=".$_SESSION['id']);
}





include("includes/header.php");






require_once 'config/config.php';

if(isset($_POST['formconnexion'])) {
   $mailconnect = htmlspecialchars($_POST['mailconnect']);
   $mdpconnect = sha1($_POST['mdpconnect']);
   if(!empty($mailconnect) AND !empty($mdpconnect)) {
      $requser = $bdd->prepare("SELECT * FROM membres WHERE mail = ? AND motdepasse = ?");
      $requser->execute(array($mailconnect, $mdpconnect));
      $userexist = $requser->rowCount();
      if($userexist == 1) {
         $userinfo = $requser->fetch();
         $_SESSION['id'] = $userinfo['id'];
         $_SESSION['pseudo'] = $userinfo['pseudo'];
         $_SESSION['mail'] = $userinfo['mail'];
         $_SESSION['admin'] = $userinfo['admin'];

         
         header("Location: profil.php?id=".$_SESSION['id']);
      } else {
         $erreur = "Mauvais mail ou mot de passe !";
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
                    <h2 class="page-title">Connexion</h2>
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
                            <h3 class="small-title mt-0">Connexion</h3>
                        </div>
                        <form method="POST" class="mt-5 mt-md-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="single-input-inner style-border">
                                    <input type="email" name="mailconnect" placeholder="Mail" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="single-input-inner style-border">
                                    <input type="password" name="mdpconnect" placeholder="Mot de passe" />
                                    </div>
                                </div>

                                <div class="col-12">
                                <input type="submit" class="btn btn-base" name="formconnexion" value="Se connecter !" />

                                <?php
                                    if(isset($erreur)) {
                                       echo '<font color="red">'.$erreur."</font>";
                                    }
                                    ?>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <br>
        <br>
<center>
   <h4>Vous n'avez pas de compte ?</h4>
<a href="inscription.php" class="btn btn-base">Se crée un compte !</a>
</center>

    </div>







   </body>
</html>

<?php include("includes/footer.php"); ?>