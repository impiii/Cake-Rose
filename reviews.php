<?
require_once("./blocks/header.php");
?>
<!-- ..........................................
CENTRE
............................................-->
<div class="info">
    <div class="container_2">
        <div class="content-headers">
            <div class="main_text">Отзывы</div>
            <?if($_SESSION['is_admin']){?>
                <div class="main_text"><a href="/reviews_moderation.php">Модерация отзывов</a></div>
            <?}?>
        </div>
        <div class="text_1">
            <div class="novosti_container">
                <div class="novosti_ryad2">
                    <?php
                    $result = executeRowSql("reviews", 'is_moderated', 1);
                    while ($item = mysqli_fetch_assoc($result)){
                        $emptyPage = true;?>
                        <div class="review_item">
                            <div class="review_top">
                                <?if($_SESSION['is_admin']){?>
                                <span class="review_delete"><a href="/handlers/deleteReview.php?id_review=<?=$item['id']?>" title="Удалить комментарий"><i class="fa-solid fa-circle-xmark"></i></a></span>
                                <?}?>
                                <div class="review_login"><?=getUserLoginById($item["user_id"])?></div>
                            </div>
                           <div class="review_text"><?=htmlspecialchars($item["text"])?></div>
                            <div class="review-date"><?=date("d.m.Y", strtotime($item["date"]))?></div>
                            <div class="review-date review-time"><?=date("H:i:s", strtotime($item["date"]))?></div>
                       </div>
                    <?}
                    if(!isset($emptyPage)){
                        echo "<div class='review_item'>Пока что нет ни одного отзыва, вы можете стать первым.</div>";
                    }
                    if($_SESSION['LOGIN'] == 'YES'){
                        if($_GET['reviews_added']){
                            echo "Спасибо за отзыв,  он будет добавлен после проверки администратором сайта.";
                        }
                        ?>

                    <div class="form_comment">
                        <form action="/handlers/addReview.php" method="GET">
                            <div>Оставить комментарий</div>

                            <input name="user_id" type="hidden" value="<?=$_SESSION['user_id']?>">
                            <textarea class="textarea-comment" required name="text" id="" rows="10"></textarea>
                            <div class="comment_submit">
                                <button type="submit">Отправить</button>
                            </div>
                        </form>
                        <?

                        }else{
                        echo "Авторизуйтесь, чтобы оставить комментарий.";
                        }?>

                    </div>
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