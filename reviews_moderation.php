<?

require_once("./blocks/header.php");
if ($_SESSION['is_admin'] != 1) {
    echo "У вас нет прав для просмотра этого раздела.";
    die();
}
?>

<!-- ..........................................
CENTRE
............................................-->
<div class="info">
    <div class="container_2">
        <div>
            <div class="main_text">Модерация отзывов</div>
        </div>
        <div class="text_1">
            <div class="novosti_container">
                <div class="novosti_ryad">
                    <?php
                    $result = executeRowSql("reviews", 'is_moderated', 0);
                    while ($item = mysqli_fetch_assoc($result)){
                        $emptyPage = true;
                        ?>

                        <div class="review_item">
                            <div class="review_top">
                                <?if($_SESSION['is_admin']){?>
                                    <span class="review_delete"><a href="/handlers/deleteReview.php?id_review=<?=$item['id']?>" title="Опубликовать комментарий"><i class="fa-solid fa-circle-xmark"></i></a></span>
                                <span class="review_moderated"><a href="/handlers/publishReview.php?review_id=<?=$item['id']?>" title="Удалить комментарий"><i class="fa-solid fa-circle-check"></i></a></span>
                                <?}?>
                                <div class="review_login"><?=getUserLoginById($item["user_id"])?></div>
                            </div>
                           <div class="review_text"><?=htmlspecialchars($item["text"])?></div>
                            <div class="review-date"><?=date("d.m.Y", strtotime($item["date"]))?></div>
                            <div class="review-date review-time"><?=date("H:i:s", strtotime($item["date"]))?></div>
                       </div>
                    <?}
                    if(!isset($emptyPage)){
                        echo "<div class='review_item'>Все отзывы промодерированы, отличная работа!</div>";
                    }?>

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