<?
require_once($_SERVER["DOCUMENT_ROOT"] . "/blocks/db.php");
if($_SESSION['LOGIN'] !== 'YES'){
    header("Location: /auth.php");
}
else{
//    $result = executeRowSql('catalog', 'id', $_GET['id_product']);
//    $item = mysqli_fetch_assoc($result);
//    $product =
//        [
//            'id' => $item['id'],
//            'price' => $item['price'],
//            'weight' => $item['weight'],
//        ];
    if(!isset($_SESSION['products'])){
        $_SESSION['products'] = [];
    }
    if(isset($_GET['id_product'])){
        if(!isset($_SESSION['products'][$_GET['id_product']])){
            $_SESSION['products'][$_GET['id_product']]=1;
        }
        else{
            $_SESSION['products'][$_GET['id_product']]++;
        }
        $referer = parse_url($_SERVER['HTTP_REFERER']);
        header("Location: ".$referer['path']);
    }
}

?>


