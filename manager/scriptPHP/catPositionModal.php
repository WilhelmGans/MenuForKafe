<?php
require $_SERVER['DOCUMENT_ROOT'].'/manager/generate/connect.php';
$idCatToScreen = $_POST['idRow'];
$positionCat = $_POST['positionCat'];
$stmt = $dbProd->prepare('UPDATE `categories_screen` SET `category_screen_positions` = ? WHERE `categories_screen`.`id` = ?');
$stmt->bind_param('ss', $positionCat, $idCatToScreen);
$stmt->execute();
?>