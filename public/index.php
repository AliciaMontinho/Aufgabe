<?php
require_once '../views/login.php';
require_once '../views/dashboard.php';
//Si hay cookie no quiero ir a login quiero ir a dashboard.php... 
if(isset($_COOKIE['usuario_email'])){
    header("Location: ../views/dashboard.php");
    exit;
}else{
    header("Location: ../views/login.php");
    exit;
}
