<?
require_once("./blocks/header.php");
?>
<!-- ..........................................
CENTRE
............................................-->
<div class="info">
    <div class="container_2">
        <div class="content-headers">
            <div class="main_text">Каталог</div>
            <?if($_SESSION['is_admin']){?>
                <div class="main_text"><a href="/addProduct.php">Добавить товар</a></div>
            <?}?>
        </div>
        <div class="catalog-table">
            <?

                $result = executeRowSql('catalog','','');
                while ($item = mysqli_fetch_assoc($result)){
            ?>
                <div class="catalog-item-wrapper">
                <?if($_SESSION['is_admin']){?>
                    <div class="edit-product">
                        <a href="/editProduct.php?id_product=<?=$item['id']?>" title="Редактировать товар">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                    </div>

                <?}?>
                <a href="/handlers/addProductToBasket.php?id_product=<?=$item['id']?>">
                    <div class="catalog-item">
                        <div class="catalog-item-title"><?=htmlspecialchars($item['name'])?></div>
                        <div class="catalog-item-img-wrapper">
                            <div class="catalog-item-img">
                                <img src="data:image/jpeg;base64, <?=base64_encode($item['img'])?>">
                            </div>
                            <div class="catalog-item-to-basket">
                                Добавить в корзину
                            </div>
                        </div>
                        <div class="catalog-item-price">Цена: <?=htmlspecialchars($item['price'])?> ₽</div>
                        <div class="catalog-item-weight">Масса: <?=htmlspecialchars($item['weight'])?> гр.</div>

                    </div>
                </a>
                    <?if($_SESSION['is_admin']){?>
                        <div class="delete-product">
                            <a href="/handlers/deleteProduct.php?id=<?=$item['id']?>">
                                <i class="fa-solid fa-trash-can"></i>
                            </a>
                        </div>
                    <?}?>
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