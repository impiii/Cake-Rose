<?
require_once($_SERVER["DOCUMENT_ROOT"] . "/blocks/db.php");
if ($_SESSION['is_admin'] != 1) {
    echo "У вас нет прав для просмотра этого раздела.";
    die();
}
if(!isset($_POST['id'])){
    echo "Не указан ID товара.";
    die();
}
else{
        if (isset($_POST['upload'])) {
            $idElement = $_POST['id'];
            $arrayValues = [
                'name' => $_POST['name'],
                'weight' => $_POST['weight'],
                'price' => $_POST['price'],
            ];

            if($_FILES['img_upload']){
                $img = getBlobFromImage($_FILES['img_upload']);
                if($img){
                    $arrayValues['img'] = $img;
                }
            }
            $resultUpdate = updateRow('catalog', $arrayValues, $idElement);
            if($resultUpdate){
                $referer = parse_url($_SERVER['HTTP_REFERER']);
                header("Location: ".$referer['path']."?id_product=".$_POST['id']);
            }
        }
        ?>

<?php
}
?>
