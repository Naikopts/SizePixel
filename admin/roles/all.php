<?php 







//SEULE LES REDACTEUR PEUVENT Y acceder
if(isset($_SESSION['admin']) AND $_SESSION['admin'] == 0) {
    exit();
    }
    if(isset($_SESSION['admin']) AND $_SESSION['admin'] == 2) {
        exit();
        }


//SEULE LES REDACTEUR / Modo / ADMIN PEUVENT Y acceder
if(isset($_SESSION['admin']) AND $_SESSION['admin'] == 0) {
    exit();
    }



//SEULE LES Modo / ADMIN PEUVENT Y acceder
if(isset($_SESSION['admin']) AND $_SESSION['admin'] == 0) {
    exit();
    }
if(isset($_SESSION['admin']) AND $_SESSION['admin'] == 1) {
    exit();
    }



//SEULE LES ADMINS PEUVENT Y acceder
if(isset($_SESSION['admin']) AND $_SESSION['admin'] == 0) {
    exit();
    }
if(isset($_SESSION['admin']) AND $_SESSION['admin'] == 1) {
    exit();
    }
    if(isset($_SESSION['admin']) AND $_SESSION['admin'] == 2) {
        exit();
        }