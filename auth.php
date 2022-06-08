<?
require_once($_SERVER["DOCUMENT_ROOT"] . "/blocks/header.php");
?>
<div class="info">
    <div class="container_2">
        <div class="main_text">Авторизация</div>
        <?
        if( $_SESSION['LOGIN'] == 'YES')
        {   echo '<div class="form_auth">';
                echo "Приветствую, ".$_SESSION['login_name'] ;
            echo '</div>';
        }else{
            if ($_GET['error_auth']) {
                echo "<div style='color:red'>Неверный логин или пароль!</div>";
            }
            ?>
            <div class="form_auth">
                <form action="handlers/authEx.php" method="POST" >
                    <div><input required placeholder="Логин" name="login" type="text"></div>
                    <div><input required placeholder="Пароль" name="password" type="password"></div>
                    <button type='submit'>Войти</button>
                </form>
                <div class="under_auth">
                    <div>Нет аккаунта?</div>
                    <div><a href="registration.php">Зарегестироваться</a></div>
                </div>
            </div>
        <?}?>
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

