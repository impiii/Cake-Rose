<?
require_once($_SERVER["DOCUMENT_ROOT"] . "/blocks/db.php");
if(isset($_POST["login"]) && isset($_POST["password"])){
    $login = mysqli_real_escape_string($db, $_POST["login"]);
    $password = mysqli_real_escape_string($db,$_POST["password"]);
    $result = executeRowSql('users', 'login', $login);
    $data = mysqli_fetch_assoc($result);
    $referer = parse_url($_SERVER['HTTP_REFERER']);
    if(!empty($data)){
        header("Location: ".$referer['path']."?user_exist=yes");
    }
    else{
        $arrayValues = [
            'login' => $login,
            'password' => $password,
            'is_admin' => $_POST["is_admin"] ?? 0,
        ];

        addRowsSql("users", $arrayValues);
        header("Location: ".$referer['path']."?complete=yes");
    }
}


