<?php
$idCat = $_POST['idcat'];       
require $_SERVER['DOCUMENT_ROOT'].'/manager/generate/connect.php';
$screenID = $_POST['screenID'];
$allStatusPhone = array();
    $status = $_POST['status'];
    $res = $dbProd->query("SELECT sc.text_title_color, sc.text_color, p.id, p.name, p.name_en, p.mass, p.price, p.visible, ct.id AS id_cat, ct.name_cat, ct.name_cat_en, ct.mass_name FROM `menu` p INNER JOIN `categories` ct ON ct.id = p.id_cat INNER JOIN `screen` sc ON sc.id = $screenID WHERE p.visible = 'yes' ORDER BY p.name ASC");
    while ($row = mysqli_fetch_assoc($res)){
        $allStatusPhone[] = $row;
    }

echo json_encode($allStatusPhone);
?>