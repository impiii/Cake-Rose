<?php
session_start();
$db = mysqli_connect("127.0.0.1", "root", "root", "cake_db");


function executeRowSql($table, $filter, $valueFilter)
{
    global $db;
    if ($filter) {
        $filterString = " WHERE " . $filter . " = " . "'" . $valueFilter . "'";
    } else {
        $filterString = '';
    }
    $result = mysqli_query($db, "SELECT * FROM " . $table . $filterString);
    if (!$result) {
        echo "<p> Запрос на выборку данных из базы не прошёл. <br> Код ошибки: </p><br>";
        exit(mysqli_error());
    }
    return $result;
}

function getUserLoginById($id)
{
    global $db;
    $result = mysqli_query($db, "SELECT login FROM users WHERE id=" . $id);
    if (!$result) {
        echo "<p> Запрос на выборку данных из базы не прошёл. <br> Код ошибки: </p><br>";
        exit(mysqli_error());
    }
    $data = mysqli_fetch_assoc($result);
    return $data['login'];
}
function getProductById($id)
{
    global $db;
    $result = mysqli_query($db, "SELECT * FROM catalog WHERE id=" . $id);
    if (!$result) {
        echo "<p> Запрос на выборку данных из базы не прошёл. <br> Код ошибки: </p><br>";
        exit(mysqli_error());
    }
    $product = mysqli_fetch_assoc($result);
    return $product;
}

function addRowsSql($tableName, $arrayValues)
{
    global $db;
//    $result = mysqli_query($db, "INSERT INTO reviews (user_id, text) VALUES ('$user_id','$text')");
//    $arr = array('name' => 'lolo' , 'deg' => '100');
    $columns = array_keys($arrayValues);
    $values = array_values($arrayValues);
    $str = "INSERT INTO $tableName (`" . implode('`,`', $columns) . "`) VALUES ('" . implode("','", $values) . "')";
    $result = mysqli_query($db, $str);

    if (!$result) {
        echo mysqli_errno($db) . ": " . mysqli_error($db) . "\n";
    }
    return $result;
}

function deleteRowFromTable($table, $id)
{
    global $db;
    $result = mysqli_query($db, "DELETE FROM " . $table . " WHERE id=" . $id);
    if (!$result) {
        echo mysqli_errno($db) . ": " . mysqli_error($db) . "\n";
    }
    return $result;
}

function updateRow($tableName, $arrayValues, $id)
{
    global $db;
    $elements = [];
    foreach ($arrayValues as $key => $value) {
        $elements[] = $key . "='" . $value . "'";
    }
    $str = "UPDATE $tableName SET " . implode(', ', $elements) . " WHERE id = " . $id;
//    print_r($str);
    $result =  mysqli_query($db, $str);
    if (!$result) {
        echo mysqli_errno($db) . ": " . mysqli_error($db) . "\n";
    }
    return $result;
}

function getBlobFromImage($file)
{
    $img_type = substr($file['type'], 0, 5);
    $image_max_size = 3 * 1024 * 1024;
    
    if (!empty($file['tmp_name']) and $img_type === 'image' and $file['size'] <= $image_max_size) {
        return addslashes(file_get_contents($file['tmp_name']));
    }
    
    return false;
}

?>