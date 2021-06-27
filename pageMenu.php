<?php
    require $_SERVER['DOCUMENT_ROOT'].'/headToMenu.php';
    $parametrsScreen = getScreenByID($_GET['screenNumber']);//id screen
    if ($parametrsScreen['img_active'] == 1) {
        $style1 = "background: url( ";
        $style2 =") no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;";
        $style0 = $style1.$parametrsScreen['img_url'].$style2;
    }
    switch ($parametrsScreen['type_template']) {
        case '1':
            require $_SERVER['DOCUMENT_ROOT'].'/templateMenu/1menu.php';
            break;
        case '2':
            require $_SERVER['DOCUMENT_ROOT'].'/templateMenu/2menu.php';
            break;
        default:
            
            break;
    }



?>