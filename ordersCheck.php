<?
require_once("./blocks/header.php");

?>
<div class="info">
    <div class="container_2">
        <div class="content-headers">
        <?
        if($_SESSION['is_admin']!=1){
            echo "У вас недостаточно прав для просмотра данного раздела";
        }
        else{?>
            <div class="main_text">Модерация заказов</div>
        </div>
        <div class="text_1">
            <div class="novosti_container">
                <div class="novosti_ryad">
                    <?php
                    $result = executeRowSql("orders", '', 1);
                    if(!$result){

                        echo "<div class='review_item'>Пока что нет ни одного заказа</div>";
                    }
                    while ($item = mysqli_fetch_assoc($result)){?>
                        <div class="review_item">
                            <div class="review_top">
                                <div class="date_order">Заказ № <?=$item['id']?> от <?=date("d.m.Y H:i:s", strtotime($item["date"]))?></div>
                                <div class="review_login">Пользователь: <?=getUserLoginById($item["user_id"])?></div>
                            </div>
                            <div class="order_phone">Телефон: <?=htmlspecialchars($item["phone"])?></div>
                            <div class="order_address">Адрес: <?=htmlspecialchars($item["address"])?></div>
                            <div class="order_address">Комментарий: <?=htmlspecialchars($item["comments"])?></div>
                            <div class="order_products_desc">
                                <div>Список товаров:</div>
                                <?
                                $itemsArray = $pieces = explode(";", $item["products_desc"]);
                                $count = 0;
                                foreach($itemsArray as $product){
                                    if(empty($product)){
                                        continue;
                                    }
                                    $count++;
                                    echo $count.") ".htmlspecialchars($product)."<br>";
                                }
                                ?>
                            </div>
                            <div class="cancel_order"><a href="/handlers/cancelOrder.php?id_order=<?=$item['id']?>" title="Завершить обработку заказа">
                                        <i class="fa-solid fa-truck-arrow-right"></i> Завершить обработку заказа</a>
                            </div>
                        </div>
                    <?}?>
                <?}?>
                </div>
            </div>
        </div>
    </div>
</div>
<?
require_once("./blocks/footer.php");
?>
</body>
</html>