<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/blocks/db.php");
if($_SESSION['is_admin']!=1){
    echo "У вас недостаточно прав для просмотра данного раздела";
    die();
}
if(isset($_GET['id_order'])){
    $id = $_GET['id_order'];
    deleteRowFromTable('orders', $id);
    $referer = parse_url($_SERVER['HTTP_REFERER']);
    header("Location: ".$referer['path']);
}

