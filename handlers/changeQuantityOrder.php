<?php
require_once("../blocks/db.php");

if(!isset($_GET["action"]) && !isset($_GET["id_product"])){
    die();
}
else{
//    print_r($_SESSION['products']);
    $id = $_GET["id_product"];
    if($_GET["action"] == 'plus'){
        $_SESSION['products'][$id]++;
    }
    if($_GET["action"] == 'minus'){
        if($_SESSION['products'][$id]>0){
            $_SESSION['products'][$id]--;
        }

    }
    if($_GET["action"] == 'delete'){
        unset($_SESSION['products'][$id]);
    }
    $referer = parse_url($_SERVER['HTTP_REFERER']);
    header("Location: ".$referer['path']);
}
