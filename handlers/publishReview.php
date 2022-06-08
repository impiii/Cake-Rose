<?
require_once($_SERVER["DOCUMENT_ROOT"] . "/blocks/db.php");
if ($_SESSION['is_admin'] != 1) {
    echo "У вас нет прав для просмотра этого раздела.";
    die();
}
if(!isset($_GET['review_id'])){
    echo "Не указан ID отзыва.";
    die();
}
else{
        if (isset($_GET['review_id'])) {
            $idElement = $_GET['review_id'];
            $arrayValues = [
                'is_moderated' => 1,

            ];
            $resultUpdate = updateRow('reviews', $arrayValues, $idElement);
            if($resultUpdate){
                $referer = parse_url($_SERVER['HTTP_REFERER']);
                header("Location: ".$referer['path']);
            }
        }
        ?>

<?php
}
?>
