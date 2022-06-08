<?

require_once("./blocks/header.php");

//print_r($_SESSION);
if ($_SESSION['is_admin'] != 1) {
    echo "У вас нет прав для просмотра этого раздела.";
    die();
}

    require_once("./blocks/header.php");
    $id = $_GET['id_product'];
    $result = executeRowSql('catalog','id',$id);
    $item = mysqli_fetch_assoc($result);
?>
<div class="info">
    <div class="container_2">
        <div class="main_text">Редактирование товара: <?=$item['name']?></div>
        <div class="product-edit-item">
            <div class="catalog-item-img">
                <img src="data:image/jpeg;base64, <?=base64_encode($item['img'])?>">
<!--                --><?//print_r($item)?>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-row"> Название: <input required type="text" name="name" value=""></div>
                <div class="form-row">Цена: <input required type="text" name="price" value=""></div>
                <div class="form-row">Масса: <input required type="text" name="weight" value=""></div>
                <input type="file" name="img_upload">
                <button type="submit" name="upload">Отправить</button>
            </form>
        </div>
            <?
            if (isset($_POST['upload'])) {
                    $arrayValues = [
                        'name' => $_POST['name'],
                        'weight' => $_POST['weight'],
                        'price' => $_POST['price'],
                    ];
                    if($_FILES['img_upload']){
                        $img = getBlobFromImage($_FILES['img_upload']);
                        $arrayValues['img'] = $img;
                    }

                    $result = addRowsSql('catalog', $arrayValues);
                    if($result){
                        echo "Товар успешно добавлен!";
                    }
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
