<?php
session_start();
include("includes/header.php");

require_once 'config/config.php';
 
if(isset($_SESSION['id'])) {
   $requser = $bdd->prepare("SELECT * FROM membres WHERE id = ?");
   $requser->execute(array($_SESSION['id']));
   $user = $requser->fetch();
   if(isset($_POST['newpseudo']) AND !empty($_POST['newpseudo']) AND $_POST['newpseudo'] != $user['pseudo']) {
      $newpseudo = htmlspecialchars($_POST['newpseudo']);
      $insertpseudo = $bdd->prepare("UPDATE membres SET pseudo = ? WHERE id = ?");
      $insertpseudo->execute(array($newpseudo, $_SESSION['id']));
      header('Location: profil.php?id='.$_SESSION['id']);
   }



   if(isset($_POST['newsteam']) AND !empty($_POST['newsteam']) AND $_POST['newsteam'] != $user['steam']) {
    $newsteam = htmlspecialchars($_POST['newsteam']);
    $insertpseudo = $bdd->prepare("UPDATE membres SET steam = ? WHERE id = ?");
    $insertpseudo->execute(array($newsteam, $_SESSION['id']));
    header('Location: profil.php?id='.$_SESSION['id']);
 }
 if(isset($_POST['newepic']) AND !empty($_POST['newepic']) AND $_POST['newepic'] != $user['epic']) {
    $newepic = htmlspecialchars($_POST['newepic']);
    $insertpseudo = $bdd->prepare("UPDATE membres SET epic = ? WHERE id = ?");
    $insertpseudo->execute(array($newepic, $_SESSION['id']));
    header('Location: profil.php?id='.$_SESSION['id']);
 }
 if(isset($_POST['newbattle']) AND !empty($_POST['newbattle']) AND $_POST['newbattle'] != $user['battlenet']) {
    $newbattle = htmlspecialchars($_POST['newbattle']);
    $insertpseudo = $bdd->prepare("UPDATE membres SET battlenet = ? WHERE id = ?");
    $insertpseudo->execute(array($newbattle, $_SESSION['id']));
    header('Location: profil.php?id='.$_SESSION['id']);
 }

 if(isset($_POST['newdiscord']) AND !empty($_POST['newdiscord']) AND $_POST['newdiscord'] != $user['discord']) {
    $newdiscord = htmlspecialchars($_POST['newdiscord']);
    $insertpseudo = $bdd->prepare("UPDATE membres SET discord = ? WHERE id = ?");
    $insertpseudo->execute(array($newdiscord, $_SESSION['id']));
    header('Location: profil.php?id='.$_SESSION['id']);
 }
 if(isset($_POST['newbio']) AND !empty($_POST['newbio']) AND $_POST['newbio'] != $user['presentation']) {
    $newbio = htmlspecialchars($_POST['newbio']);
    $insertpseudo = $bdd->prepare("UPDATE membres SET presentation = ? WHERE id = ?");
    $insertpseudo->execute(array($newbio, $_SESSION['id']));
    header('Location: profil.php?id='.$_SESSION['id']);
 }




   if(isset($_FILES['avatar']) AND !empty($_FILES['avatar']['name']))
   {
    $taillemax = 16097152;
    $extensionsValides = array('jpg', 'png', 'gif', 'jpeg');
    if($_FILES['avatar']['size'] <= $taillemax)
    {
        $extensionUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));
        if(in_array($extensionUpload, $extensionsValides))
        {
            $chemin = "membres/avatars/".$_SESSION['id'].".".$extensionUpload;
            $resultat = move_uploaded_file($_FILES['avatar']['tmp_name'], $chemin);

            if($resultat)
            {
                $updateavatar = $bdd->prepare('UPDATE membres SET avatar = :avatar WHERE id = :id');
                $updateavatar->execute(array(
                    'avatar' => $_SESSION['id'].".".$extensionUpload,
                    'id' => $_SESSION['id']
                ));
            }
            else
            {
                $msg = "L'image ne ses pas télécharger .... ";
            }
        }
        else
        {
            $msg = "Votre format d'images n'est pas correct !";
        }

    }
    else
    {
        $msg = " Votre photo de profil ne doit pas dépasser 2MO";
    }


   }


   if(isset($_FILES['banner']) AND !empty($_FILES['banner']['name']))
   {
    $taillemax = 16097152;
    $extensionsValides = array('jpg', 'png', 'gif', 'jpeg');
    if($_FILES['banner']['size'] <= $taillemax)
    {

        $extensionUpload = strtolower(substr(strrchr($_FILES['banner']['name'], '.'), 1));
        if(in_array($extensionUpload, $extensionsValides))
        {
            $chemin = "membres/banner-m/".$_SESSION['id'].".".$extensionUpload;
            $resultat = move_uploaded_file($_FILES['banner']['tmp_name'], $chemin);

            if($resultat)
            {
                $updatebanner = $bdd->prepare('UPDATE membres SET banner = :banner WHERE id = :id');
                $updatebanner->execute(array(
                    'banner' => $_SESSION['id'].".".$extensionUpload,
                    'id' => $_SESSION['id']
                ));
            }
            else
            {
                $msg = "L'image ne ses pas télécharger .... ";
            }
        }
        else
        {
            $msg = "Votre format d'images n'est pas correct !";
        }


    }
    else
    {
        $msg = " Votre photo de profil ne doit pas dépasser 2MO";
    }

    
   }




   if(isset($_POST['newmail']) AND !empty($_POST['newmail']) AND $_POST['newmail'] != $user['mail']) {
      $newmail = htmlspecialchars($_POST['newmail']);
      $insertmail = $bdd->prepare("UPDATE membres SET mail = ? WHERE id = ?");
      $insertmail->execute(array($newmail, $_SESSION['id']));
      header('Location: profil.php?id='.$_SESSION['id']);
   }
   if(isset($_POST['newmdp1']) AND !empty($_POST['newmdp1']) AND isset($_POST['newmdp2']) AND !empty($_POST['newmdp2'])) {
      $mdp1 = sha1($_POST['newmdp1']);
      $mdp2 = sha1($_POST['newmdp2']);
      if($mdp1 == $mdp2) {
         $insertmdp = $bdd->prepare("UPDATE membres SET motdepasse = ? WHERE id = ?");
         $insertmdp->execute(array($mdp1, $_SESSION['id']));
         header('Location: profil.php?id='.$_SESSION['id']);
      } else {
         $msg = "Vos deux mdp ne correspondent pas !";
      }
   }
?>
<html>
<div class="breadcrumb-area bg-overlay" style="background-image:url('assets/img/bg/13.png')">
        <div class="container">
            <div class="breadcrumb-inner text-center">
                <div class="section-title mb-0">
                    <h2 class="page-title">Editer mon profil</h2>
                    <ul class="page-list">
                        <li><a href="/index.php">Accueil</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>>
   <body>



      <div class="contact-form-area pd-top-100 pd-bottom-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7 mt-4 mt-lg-0 ps-lg-5">
                    <div class="contact-form-inner-wrap">
                        <div class="section-title mb-0">
                            <h3 class="small-title mt-0">Edition du profil</h3>
                        </div>
                        <form method="POST" action="" enctype="multipart/form-data" class="mt-5 mt-md-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="single-input-inner style-border">
                                    <input type="text" name="newpseudo" placeholder="Pseudo" value="<?php echo $user['pseudo']; ?>" /><br /><br />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="single-input-inner style-border">
                                    <input type="text" name="newmail" placeholder="Mail" value="<?php echo $user['mail']; ?>" /><br /><br />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="single-input-inner style-border">
                                    <input type="password" name="newmdp1" placeholder="Mot de passe"/><br /><br />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="single-input-inner style-border">
                                    <input type="password" name="newmdp2" placeholder="Confirmation du mot de passe" /><br /><br />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="single-input-inner style-border">

<br>
<br>
<center>                                        <h4>Votre images de profil</h4>
</center>
                                    <input type="file"  name="avatar" /><br /><br />

                                    <br>
<br>
<center>                                        <h4>Votre Banniere de profil</h4>
</center>
                                    <input type="file" name="banner" /><br /><br />


                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="single-input-inner style-border">
                                    <input type="text" name="newsteam" placeholder="Steam" value="<?php echo $user['steam']; ?>" /><br /><br />
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="single-input-inner style-border">
                                    <input type="text" name="newepic" placeholder="Epic-game" value="<?php echo $user['epic']; ?>" /><br /><br />
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="single-input-inner style-border">
                                    <input type="text" name="newbattle" placeholder="BattleNet" value="<?php echo $user['battlenet']; ?>" /><br /><br />
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="single-input-inner style-border">
                                    <input type="text" name="newdiscord" placeholder="Discord" value="<?php echo $user['discord']; ?>" /><br /><br />
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="single-input-inner style-border">
                                        <textarea type="text" name="newbio" placeholder="Présentation" value="<?php echo $user['presentation']; ?>"></textarea>
                                    </div>
                                </div>


                                <div class="col-12">
                                <input class="btn btn-base" type="submit" value="Mettre à jour mon profil !" />
                                </div>
                            </div>
                        </form>
                        <?php if(isset($msg)) { echo $msg; } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>




   </body>
</html>
<?php   
}
else {
   header("Location: connexion.php");
}
?>


<?php include("includes/footer.php"); ?>