<?php
require $_SERVER['DOCUMENT_ROOT'].'/manager/generate/connect.php';
session_start();
$message = '';
$login = $_SESSION['login'];
if (isset($_POST['uploadBtn']) && $_POST['uploadBtn'] == 'Upload'){
    if (isset($_FILES['uploadedFile']) && $_FILES['uploadedFile']['error'] === UPLOAD_ERR_OK){
    // get details of the uploaded file
        $fileTmpPath = $_FILES['uploadedFile']['tmp_name'];
        $fileName = $_FILES['uploadedFile']['name'];
        $fileSize = $_FILES['uploadedFile']['size'];
        $fileType = $_FILES['uploadedFile']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        // sanitize file-name
        $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
        // check if file has one of the following extensions
        $allowedfileExtensions = array('jpg', 'png');
        if (in_array($fileExtension, $allowedfileExtensions)){
        // directory in which the uploaded file will be moved
            $uploadFileDir = '../resources/upload/';
            $dest_path = $uploadFileDir . $newFileName;
            $uploadUrlDB = "/resources/upload/".$newFileName;
            if(move_uploaded_file($fileTmpPath, $dest_path)){
                $message ='Файл успешно загружен';
                $dbProd->query("UPDATE `screenconf` SET `img_url_bg` = '$uploadUrlDB' WHERE `screen` = '$screenData'");
            }else{
                $message = 'При перемещении файла в каталог загрузки произошла ошибка. Убедитесь, что каталог загрузки доступен для записи веб-сервером.';
            }
        }else {
            $message = 'Загрузка не удалась. Допустимые типы файлов: ' . implode(', ', $allowedfileExtensions);
        }
    }else {
        $message = 'При загрузке файла произошла ошибка. Пожалуйста, проверьте следующую ошибку. <br>';
        $message .= 'Error:' . $_FILES['uploadedFile']['error'];
    }
}
$_SESSION['message'] = $message;
$urlRef = $_SERVER['HTTP_REFERER'];
header("location: $urlRef");
