<?php 
session_start();
require_once '../../config/config.php';


if(isset($_SESSION['admin']) AND $_SESSION['admin'] == 0) {
  exit();
  }
  if(isset($_SESSION['admin']) AND $_SESSION['admin'] == 1) {
    exit();
    }
if(isset($_SESSION['admin']) AND $_SESSION['admin'] == 2) {
    exit();
    }
include("../includes/header.php"); ?>

<?php




if(isset($_GET['type']) AND $_GET['type'] == 'membre') {
   if(isset($_GET['confirme']) AND !empty($_GET['confirme'])) {
      $confirme = (int) $_GET['confirme'];


      $req = $bdd->prepare('UPDATE membres SET confirme = 1 WHERE id = ?');
      $req->execute(array($confirme));
   }
   if(isset($_GET['supprime']) AND !empty($_GET['supprime'])) {
      $supprime = (int) $_GET['supprime'];
      $req = $bdd->prepare('DELETE FROM membres WHERE id = ?');
      $req->execute(array($supprime));
   }
} 

$membres = $bdd->query('SELECT * FROM membres ORDER BY id DESC LIMIT 0,5');
?>



<?php 
if(!isset($_SESSION['id'])) { ?>


<div class="row mb-10">
<?php while($m = $membres->fetch()) { ?>

    <div class="col-md-6">
        
      <div class="row g-0 border rounded overflow-hidden flex-md-row mb-10 shadow-sm h-md-250 position-relative">
        
        <div class="col p-10 d-flex flex-column position-static">
        <img src="../../membres/avatars/<?= $m['avatar'] ?>" width="60" height="65" alt=""> </br>
          <strong class="d-inline-block mb-10 text-primary"><?= $m['pseudo'] ?></strong>
          <div class="mb-1 text-muted">Identification : <?= $m['id'] ?></div>

          <p class="card-text mb-auto">

            <?= $m['mail'] ?> </br>
        
        




        </p>
        
          <li>
            
          <?php if($m['confirme'] == 0) { ?>
          <a href="utilisateur.php?type=membre&confirme=<?= $m['id'] ?>">Confirmer</a>
                <?php } ?>
           <a href="utilisateur.php?type=membre&supprime=<?= $m['id'] ?>">Supprimer</a>
        
        
        </li>

        
      </div>
    </div>

  </div>
  <?php } } ?>


<?php include("../includes/footer.php"); ?>