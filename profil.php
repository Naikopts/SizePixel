<?php
session_start();
include("includes/header.php");
 require_once 'config/config.php';
 



if(isset($_GET['id']) AND $_GET['id'] > 0) {
   $getid = intval($_GET['id']);
   $requser = $bdd->prepare('SELECT * FROM membres WHERE id = ?');
   $requser->execute(array($getid));
   $userinfo = $requser->fetch();
?>
<html>
<div class="breadcrumb-area bg-overlay" style="background-image:url('membres/banner-m/<?php echo $userinfo['banner']; ?>')">
        <div class="container">
            <div class="breadcrumb-inner text-center">
                <div class="section-title mb-0">
                    <h2 class="page-title">Profil de : <?php echo $userinfo['pseudo']; ?></h2>
                    <ul class="page-list">
                        <li><a href="/index.php">Accueil</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
   <body>




      <div class="tipster-area bg-relative pd-top-100 pd-bottom-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4">
                    <div class="team-widget">
                        <div class="thumb">
                        <?php 
         if(!empty($userinfo['avatar']))
         {
            ?>
                            <img src="membres/avatars/<?php echo $userinfo['avatar']; ?>" alt="team"> 
                            <?php 
         }
         ?>
                        </div>
                        <div class="details">
                            <ul>
                            <?php
                                if(isset($_SESSION['id']) AND $_SESSION['id'] != $getid) {
                                    $isfollowingornot = $bdd->prepare('SELECT * FROM follow WHERE id_follower = ? AND id_following = ?');
                                    $isfollowingornot->execute(array($_SESSION['id'],$getid));
                                    $isfollowingornot = $isfollowingornot->rowCount();
                                    if($isfollowingornot == 1) {
                                        ?>

                                <a href="follow.php?followedid=<?php echo $getid; ?>" class="btn btn-base-2">UnFollow <?php echo $userinfo['pseudo']; ?></a> <span></span></li>
                              <?php      } else {
                                ?>

                                <a href="follow.php?followedid=<?php echo $getid; ?>" class="btn btn-base-2">Follow <?php echo $userinfo['pseudo']; ?></a> <span></span></li>
<?php
    }
  }
  ?>


<?php
                            if(isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id']) {
                            ?>

                                <li><i class="fas fa-arrow-alt-circle-right"></i>Parrainages : <span id="tocopy"><a href="inscription.php?p=<?php echo $userinfo['uniqid'] ?>">Clique ici</a></span></li>
<?php } ?>
                            </ul>
                        </div>

                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="team-details-area">
                        <div class="td-top">
                            <h6 class="mb-0">Pseudo: <?php  echo $userinfo['pseudo']; ?></h6>

                            <p>Roles : <?php echo $userinfo['roles']; ?> / admin : <?php echo $userinfo['admin']; ?></p>
                        </div>
                        <h4>Information public :</h4>
                        <ul class="price-list">
                            <li><strong><i class="fa fa-gamepad"></i> Steam :</strong>  <?php echo $userinfo['steam']; ?></li>
                            <li><strong><i class="fa fa-eercast"></i> Epic-Game:</strong>  <?php echo $userinfo['epic']; ?></li>
                            <li><strong><i class="fa fa-bold"></i> BattleNet:</strong>  <?php echo $userinfo['battlenet']; ?></li>
                            <li><strong><i class="fa fa-microphone"></i> Discord :</strong>  <?php echo $userinfo['discord']; ?></li>
                        </ul>
                        <div class="details">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="td-list-inner">
                                        <img src="assets/img/club-icon/12.png" alt="img">
                                        <strong>Parrainages :</strong>  
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="td-list-inner">
                                        <img src="assets/img/club-icon/13.png" alt="img">
                                        <strong>Messages :</strong>  
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="td-list-inner">
                                        <img src="assets/img/club-icon/12.png" alt="img">
                                        <strong>Amis :</strong>  
                                    </div>
                                </div>
                            </div>
                            <h6>Biographie :</h6>
                            <p class="pb-4"> <?php echo $userinfo['presentation']; ?> </p>

                            <?php
                            if(isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id']) {
                            ?>
                            <a class="btn btn-base-2 me-3 mb-2" href="edition-profile.php">Editer mon profils <i class="fab fa-grav ms-2"></i></a>
                            <a class="btn btn-base mb-2" href="deconnexion.php">Deconnexion <i class="fab fa-grav ms-2"></i></a>

                            <?php
         }
         ?>



                            <div class="td-bottom-inner mt-4">
                            <?php
                            if(isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id']) {
                            ?>

                                <h3>Profils SizePixel</h3> <br>
                                <h4>Information Privé :</h4>
                                <ul class="price-list">
                            <li><strong> Email :</strong>  <?php echo $userinfo['mail']; ?></li>
                            <li><strong> Ages :</strong>  <?php echo $userinfo['ages']; ?></li>
                            <li><strong> ID Sizepixel :</strong>  <?php echo $userinfo['id']; ?></li>



                        </ul>
                        <?php } ?>


                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



   </body>
</html>


<?php   
}
?>

<?php include("includes/footer.php"); ?>