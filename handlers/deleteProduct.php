<?
require_once($_SERVER["DOCUMENT_ROOT"] . "/blocks/db.php");
if ($_SESSION['is_admin'] != 1) {
    echo "У вас нет прав для просмотра этого раздела.";
    die();
}
if(!isset($_GET['id'])){
    echo "Не указан ID товара.";
    die();
}
else {
    $resultDelete = deleteRowFromTable('catalog', $_GET['id']);
    if ($resultDelete) {
        $referer = parse_url($_SERVER['HTTP_REFERER']);
        header("Location:/catalog.php");
    }
}
