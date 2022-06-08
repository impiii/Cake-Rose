<?php
require_once("../blocks/db.php");
if(!$_SESSION['user_id']){
    echo "Вы не авторизованы!";
    die();
}
if(!isset($_GET["user_id"]) && !isset($_GET["text"])){
    echo "Не переданы ID пользователя и текст комментария!";
    die();
}
else{
    $values = [
        'user_id' => $_GET["user_id"],
        'text' => htmlspecialchars($_GET["text"]),
    ];
    $user_id = $_GET["user_id"];
    $text = $_GET["text"];
    $result = addRowsSql('reviews', $values);
    if($result){
        $referer = parse_url($_SERVER['HTTP_REFERER']);
        header("Location: ".$referer['path']."?reviews_added=yes");
    }
}

