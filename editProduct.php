<?

require_once("./blocks/header.php");

//print_r($_SESSION);
if ($_SESSION['is_admin'] != 1) {
    echo "У вас нет прав для просмотра этого раздела.";
    die();
}
if(false/*!isset($_GET['id_product'])*/){

}
else{
    require_once("./blocks/header.php");
    $id = $_GET['id_product'];
    $result = executeRowSql('catalog','id',$id);
    $item = mysqli_fetch_assoc($result);
?>
<div class="info">
    <div class="container_2">
        <div class="content-headers">
            <div class="main_text">Редактирование товара: <?=htmlspecialchars($item['name'])?></div>
            <div class="main_text delete"><a href="/handlers/deleteProduct.php?id=<?=$item['id']?>">Удалить товар <i class="fa-solid fa-trash-can"></i></a></div>
        </div>
        <div class="product-edit-item">
            <div class="catalog-item-img">
                <img src="data:image/jpeg;base64, <?=base64_encode($item['img'])?>">
<!--                --><?//print_r($item)?>
            </div>
            <form action="/handlers/updateProduct.php" method="POST" enctype="multipart/form-data">
                <div class="form-row"><input type="hidden" name="id" value="<?=$item['id']?>"></div>
                <div class="form-row"> Название: <input required type="text" name="name" value="<?=htmlspecialchars($item['name'])?>"></div>
                <div class="form-row">Цена: <input required type="text" name="price" value="<?=htmlspecialchars($item['price'])?>"></div>
                <div class="form-row">Масса: <input required type="text" name="weight" value="<?=htmlspecialchars($item['weight'])?>"></div>
                <input type="file" name="img_upload">
                <button type="submit" name="upload">Отправить</button>
            </form>
        </div>
            <?

        }
        ?>

    </div>
</div>
</div>
<?
require_once("./blocks/footer.php");
?>
</body>
</html>
