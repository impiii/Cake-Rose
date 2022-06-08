<?
require_once($_SERVER["DOCUMENT_ROOT"] . "/blocks/db.php");
if(isset($_POST["login"]) && isset($_POST["password"])){
    $login = $_POST["login"];
    $password = $_POST["password"];
    $result = executeRowSql('users', 'login', $login);
    $data = mysqli_fetch_assoc($result);
    $referer = parse_url($_SERVER['HTTP_REFERER']);

    if($data['login'] == $login && $data['password'] == $password){
        $_SESSION['user_id'] = $data['id'];
        $_SESSION['is_admin'] = $data['is_admin'];
        $_SESSION['login_name'] = $login;
        $_SESSION['LOGIN'] = 'YES';

        header("Location: /index.php");
    }
    else{
        header("Location: ".$referer['path']."?error_auth=true");
    }
}

