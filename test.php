<?
function validateFile($name){
    $extensionAllowed = ['jpg','jpeg','png'];
    $path = pathinfo($name);

    return in_array($path['extension'], $extensionAllowed);
};

if (isset($_FILES['image'])){
    $fileName = $_FILES['image']['name'];

    if (validateFile($fileName)){
        if(!is_dir(__DIR__ . '/image/')) {
            mkdir('image/');
        }

        $fileTmpName = $_FILES['image']['tmp_name'];
        $fileUploadPath = __DIR__ . '/image/' . $fileName;

        move_uploaded_file($fileTmpName, $fileUploadPath);

        echo "Файл загружен успешно. Путь: " . $fileUploadPath;
    }
    else{
        echo "Файл не загружен, необходимо загружать jpg, jpeg или png";
    }
};
?>
<form action="" method="POST" enctype="multipart/form-data">
    <input type="file" name="image">
    <button type="submit">Отправить</button>
</form>
