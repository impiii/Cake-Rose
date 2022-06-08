<body>
<?
require_once($_SERVER["DOCUMENT_ROOT"] . "/blocks/header.php");
?>
<div class="info">
    <div class="container_2">
        <div class="main_text">Корзина</div>
        <?if(!empty($_SESSION['products'])){?>
            <div></div>
            <div>Ваш заказ, дорогой <?=$_SESSION['login_name']?>:</div>
    
            <table class="resp-tab">
                <thead>
                <tr>
                    <th>Наименование</th>
                    <th>Стоимость</th>
                    <th>Масса</th>
                    <th>Количество</th>
                </tr>
                </thead>
                <tbody>
            <?
            $totalPrice = 0;
            $productString = '';
                foreach ($_SESSION['products'] as $productsBasketId => $quantity) {
                    $products = getProductById($productsBasketId);
                    $totalPrice += $products['price']*$quantity;
                    $productString .= $products['name']. " - ". $quantity. " шт.;"
                ?>
                    <tr>
                        <td><span>Наименование</span>
                            <a class="quantity-delete"  title="Удалить позицию" href="/handlers/changeQuantityOrder.php?action=delete&id_product=<?=$products['id']?>">
                                <i class="fa-solid fa-xmark"></i>
                            </a>
                            <?=$products['name']?>
                            </td>
                        <td><span>Стоимость</span><?=$products['price']?> ₽</td>
                        <td><span>Масса</span><?=$products['weight']?> гр.</td>
                        <td><span>Количество</span>
                            <a  class="quantity-minus" title="Уменьшить позицию" href="/handlers/changeQuantityOrder.php?action=minus&id_product=<?=$products['id']?>">-</a> <?=$quantity?>
                            <a title="Добавить позицию" class="quantity-plus" href="/handlers/changeQuantityOrder.php?action=plus&id_product=<?=$products['id']?>"">+</a>
                        </td>
                    </tr>
                <?}?>
                </tbody>
            </table>
            <div class="total-count-price">
                Общая сумма: <?=number_format($totalPrice, 0,'', ' ')?> ₽
            </div>
            <div class="admin-post">Уважаемый покупатель, заказы обрабатываются в течение часа. Для уточнения деталей заказа с Вами свяжется администратор. Стоимость доставки Cake&Rose - бесплатная.</div>
             <div class="form_comment">
                <form action="/handlers/addOrder.php" method="POST">
                    <div>Пожалуйста, заполните все поля для завершения заявки на доставку:</div>
                    <input name="user_id" type="hidden" value="<?=$_SESSION['user_id']?>">
                    <div><input   required class="input-form-basket" name="phone" id="phone" type="text" placeholder="Телефон">
                    
                    
                    
                    
                    </div>
                    <div><input  required class="input-form-basket" name="address" type="text" placeholder="Адрес доставки"></div>
                    <textarea placeholder="Комментарий" class="textarea-comment" required name="comments" id="" rows="5"></textarea>
                    <input type="hidden" required name="products_desc" id="" rows="5"  value="<?=htmlspecialchars($productString)?>">
                    <div class="comment_submit">
                        <button type="submit">Оформить заказ</button>
                    </div>
                </form>
            </div>
        <?}else{
            if($_SESSION['LOGIN']=='YES'){
                if($_GET['order_success'] == 'yes'){
                    echo "Заказ успешно оформлен!";
                }
                else{
                    echo "Чтобы оформить заказ перейдите в каталог и добавьте товары в корзину";
                }
            }
            else{
                echo "Чтобы оформить заказ авторизуйтесь на сайте";
            }

        }?>
    </div>
</div>
<?
require_once("./blocks/footer.php");
?>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.2.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery.maskedinput@1.4.1/src/jquery.maskedinput.min.js"></script>
<script>
    $(document).ready(function() {
    $("#phone").mask("+7(999) 999-9999");
  });
</script>
</body>






