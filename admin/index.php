<?php
session_start();
if(isset($_SESSION['id']));
//PERMISIONS ADMIN (INTERDICTION) 
if(isset($_SESSION['admin']) AND $_SESSION['admin'] == 0) {
    exit();
    }



 
require_once '../config/config.php';





include("includes/header.php"); ?>


Il a actuellement : [] UTILISATEUR(S)





<?php include("includes/footer.php"); ?>