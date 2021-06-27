<?php
require $_SERVER['DOCUMENT_ROOT'].'/manager/generate/connect.php';
$idCatToScreen = $_POST['idRow'];
$stmt = $dbProd->prepare('DELETE FROM `categories_screen` WHERE `categories_screen`.`id` = ?');
$stmt->bind_param('s', $idCatToScreen);
$stmt->execute();
?>