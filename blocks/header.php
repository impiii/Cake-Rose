<?
require_once($_SERVER["DOCUMENT_ROOT"] . "/blocks/db.php");
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Cake&Rose</title>
    <!-- Нормализация стилей  -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.css">

    <!-- Собственные стили  -->
    <link rel="stylesheet" href="../css/main.css">

    <!-- Иконки  -->
    <script src="https://kit.fontawesome.com/f767654bb3.js" crossorigin="anonymous"></script>

    <!-- Подключение веб-шрифтов  -->
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300&family=PT+Sans+Caption&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
          rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="../img/favicon/favicon.png">
    <style>
    </style>
</head>

<!-- ..........................................
HEADER
............................................-->
<div class="header">
    <div class="auth_block">
        <?
            if($_SESSION['LOGIN'] !== 'YES'){
                echo '<a href="/auth.php"><i class="fa-solid fa-arrow-right-to-bracket"></i></i> Авторизоваться</a>';

            }
            else{
                echo '<a href="/handlers/authCancel.php"><i class="fa-solid fa-door-open"></i>Выход</a>';
                if($_SESSION['is_admin'] == 1){
                    echo '<a href="/registration.php"><i class="fa-solid fa-user"></i></i>Зарегистрировать администратора</a>';
                }
            }
        ?>


    </div>
    <div class="container">
        <div class="emblem">
            <a href="/index.php">
            <img src="../img/main/emblem0.jpg" alt="background-image">
            </a>
            <div>Кондитерская вкусов Cake&Rose</div>
        </div>
        <div class="header__menu">
            <ul class="main_menu">
               <li class="li__1"><a href="../index.php">О нас</a></li>
                <li class="li__1"><a href="../catalog.php">Каталог</a></li>
                <li class="li__1"><a href="/about.php">Записки кондитера</a></li>
                <li class="li__1"><a href="../reviews.php">Отзывы</a></li>
                
                <?
                    if($_SESSION['LOGIN']){
                        if(isset($_SESSION['products']) && count($_SESSION['products'])>0){
                            $countBasket = '<span class="count-menu-count-basket">'.count($_SESSION['products']).'</span>';
                    }
                }?>

                <li class="li__1"><a href="../basket.php">Корзина<?=$countBasket?></a></li>
                <?
                if($_SESSION['is_admin']){
                    echo '<li class="li__1"><a href="../ordersCheck.php">Заказы покупателей<?=$countBasket?></a></li>';
                }
                ?>

            </ul>
        </div>
    </div>
</div>