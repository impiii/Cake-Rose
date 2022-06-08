<?
require_once($_SERVER["DOCUMENT_ROOT"] . "/blocks/header.php");
?>
<div class="info">
    <div class="container_2">
        <div class="main_text">Регистрация</div>
        <?
        if( $_SESSION['LOGIN'] == 'YES')
        {   echo '<div class="form_auth">';
                echo "Приветствую, ".$_SESSION['login_name'] ;
                if($_SESSION['LOGIN'])
            echo '</div>';
        }
        if($_SESSION['LOGIN'] != 'YES'  || $_SESSION['is_admin']){
        ?>
                <div class="form_auth">
                <form action="/handlers/registerEx.php" method="POST">
                    <div><input required placeholder="Логин" name="login" type="text"></div>
                    <div><input required placeholder="Пароль" name="password" type="password" ></div>
                    <?if($_SESSION['is_admin']){?>

                        <div>Сделать администратором: <input type="checkbox" name="is_admin" value="1"></div>
                        <button type='submit'>Зарегистрировать пользователя</button>

                    <?}else{?>

                        <button type='submit'>Зарегистрироваться</button>

                    <?}?>
                </form>
            </div>
            <?
        }
        if(isset($_GET['user_exist'])){
            echo '<div class="error_registration-text">Пользователь с таким логином уже существует</div>';
        }
        if(isset($_GET['complete'])){
            if($_SESSION['is_admin']){
                echo '<div class="complete_registration-text">Пользователь успешно зарегестирован!</div>';
            }
            else{
                echo '<div class="complete_registration-text">Вы успешно зарегестировались, теперь <a href="/auth.php">авторизуйтесь</a> </div>';
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

</body>
</html>

