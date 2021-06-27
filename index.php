<?php
require $_SERVER['DOCUMENT_ROOT'].'/manager/generate/array.php';
switch ( $_GET['typePage']) {
    case 'menu':
        require $menu;
        break;
    default:
        require $manager;
        break;
}
// http://kaferew.local/index.php?typePage=menu&screenNumber=1 <---ID screen 
?>