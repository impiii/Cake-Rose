<?php
require_once("../blocks/db.php");

if(!isset($_POST["user_id"]) && !isset($_POST["products_desc"])){
    echo "Не переданы ID пользователя и тело заказа";
    die();
}
else{
    $values = [
        'user_id' => $_POST["user_id"],
        'products_desc' => $_POST["products_desc"],
        'address' => $_POST["address"],
        'phone' => $_POST["phone"],
    ];
//    print_r($values);
    if(!empty($_POST["comments"])){
        $values['comments'] = $_POST["comments"];
    }
    $result = (addRowsSql('orders', $values));
    if($result){
        $_SESSION['products'] = [];
    }
    $referer = parse_url($_SERVER['HTTP_REFERER']);
    header("Location: ".$referer['path']."?order_success=yes");
}
