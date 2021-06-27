<?php
function getScreen(){
    global $dbProd;
    $screen = $dbProd->query("SELECT * FROM screenconf");
    return $screen;
};
function getFullOptionsProd($idCatFromSite){
    global $dbProd;
    $fullOptionsProd = $dbProd->query("SELECT p.id, p.name, p.name_en, p.mass, p.price, p.visible, ct.name_cat, ct.name_cat_en, ct.mass_name FROM `menu` p INNER JOIN `categories` ct ON ct.id = p.id_cat WHERE ct.id = $idCatFromSite ORDER BY p.name ASC");
    return $fullOptionsProd;
};
function getFullCat(){
    global $dbProd;
    $fullCat = $dbProd->query("SELECT * FROM `categories`ORDER BY `name_cat` ASC");
    return $fullCat;
};
function getFullCatStop(){
    global $dbProd;
    $fullCatStop = $dbProd->query("SELECT * FROM `categories` WHERE screen IS NULL");
    return $fullCatStop;
};
function getsumTemplateMenu(){
    global $dbProd;
    $screenTemplateNumber = $dbProd->query("SELECT `sum_template_screen` FROM `config`");
    $screenTemplateNumber = mysqli_fetch_assoc($screenTemplateNumber);
    $screenTemplateNumber = $screenTemplateNumber['sum_template_screen'];
    return $screenTemplateNumber;
};
function getNumberScreen($numberScreen){
    global $dbProd;
    $numberScreen = $dbProd->query("SELECT `number` FROM `screen` WHERE `screen`.`id` = '$numberScreen'");
    $numberScreen = mysqli_fetch_assoc($numberScreen);
    $numberScreen = $numberScreen['number'];
    return $numberScreen;
};
function getFullCatScreen($screnCat){
    global $dbProd;
    $fullCatScreen = $dbProd->query("SELECT * FROM `categories` WHERE `screen` = '$screnCat' OR `screen2` = '$screnCat' ORDER BY `name_cat` ASC");
    return $fullCatScreen;
};
function getCountMenuForCat($idCatHomePage){
    global $dbProd;
    $countMenu = $dbProd->query("SELECT COUNT(`id`) AS 'countCat' FROM `menu` WHERE `id_cat` = $idCatHomePage");
    $countMenu = mysqli_fetch_assoc($countMenu);
    $countMenu = $countMenu['countCat'];
    return $countMenu;
};
function getVisibleMenu($screenNumber){
    global $dbProd;
    $visibleMenu = $dbProd->query("SELECT screen_visible FROM `screenconf` WHERE `screen` = $screenNumber");
    $visibleMenu = mysqli_fetch_assoc($visibleMenu);
    $visibleMenu = $visibleMenu['screen_visible'];
    return $visibleMenu;
};
function getDesignMenu($screenNumber){
    global $dbProd;
    $visibleMenu = $dbProd->query("SELECT img_on_off FROM `screenconf` WHERE `screen` = $screenNumber");
    $visibleMenu = mysqli_fetch_assoc($visibleMenu);
    $visibleMenu = $visibleMenu['img_on_off'];
    return $visibleMenu;
};
function getScreenStatus(){
    global $dbProd;
    $statusScreen = $dbProd->query("SELECT `id`,`screen_active`,`number`,`name` FROM `screen`");
    return $statusScreen;
};
function getScreenSetting(){
    global $dbProd;
    $settingScreen = $dbProd->query("SELECT * FROM `screen`");
    return $settingScreen;
};
function getScreenByID($idScreen){
    global $dbProd;
    $screen = $dbProd->query("SELECT * FROM `screen` WHERE `screen`.`id` = $idScreen");
    $screen = mysqli_fetch_assoc($screen);
    return $screen;
};
function getIDCatByIDAndPosition($idScreen, $position){
    global $dbProd;
    $screen = $dbProd->query("SELECT `id_categories` FROM `categories_screen` WHERE `categories_screen`.`id_screen` = $idScreen AND `categories_screen`.`category_screen_positions` = $position");
    return $screen;
};
function getFullCatByID($idCat){
    global $dbProd;
    $fullCat = $dbProd->query("SELECT * FROM `categories` WHERE `categories`.`id` = $idCat");
    $fullCat  = mysqli_fetch_assoc($fullCat);
    return $fullCat;
};
function getUser(){
    global $dbProd;
    $accounts = $dbProd->query("SELECT * FROM accounts ORDER BY id DESC");
    return $accounts;
};
function getUserById($id){
    global $dbProd;
    $accountsId = $dbProd->query("SELECT `id`, `username`, `name`, `type_user`, `colorinterface` FROM `accounts` WHERE id = $id");
    $accountId = mysqli_fetch_assoc($accountsId);
    return $accountId;
};


?>