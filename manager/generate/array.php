<?php
    $menu = $_SERVER['DOCUMENT_ROOT'].'/pageMenu.php';
    $manager = $_SERVER['DOCUMENT_ROOT'].'/manager/index.php';
    $navbar = array('Главная', 'Администрирование');
    $navbarLink = array('homePage.php', 'page/adminPage.php');
    $navbarAccess = array('user', 'admin');
    $arrayIcon = array('fas fa-exclamation-triangle', 'fas fa-check');
    $arrayColor = array('badge-danger','badge-success','badge-warning');
    $arrayIconForActions = array('far fa-envelope', 'fas fa-cog', 'fas fa-users-cog');
    // function for working with an arrays
    global $typeAction;
    function generateIconForActions($typeAction){
        global $arrayIconForActions;
        if ($typeAction === "message"){
            $iconforActionType = $arrayIconForActions[0];
        }elseif($typeAction === "setting phone" || $typeAction === "setting base"){
            $iconforActionType = $arrayIconForActions[1];
        }elseif ($typeAction === "user setting"){
            $iconforActionType = $arrayIconForActions[2];
        };
        return $iconforActionType;
    };
    global $screenActive;
    function generateParametresForModal($screenActive){
        global $arrayIcon;
        global $arrayColor;
        $parametres = array('','','');
        if ($screenActive === '0'){
            $parametres[0] = " Меню выключено ";
            $parametres[1] = $arrayIcon[0];
            $parametres[2] = $arrayColor[0];
        }elseif($screenActive === '1'){
            $parametres[0] = " Меню включено ";
            $parametres[1] = $arrayIcon[1];
            $parametres[2] = $arrayColor[1];
        };
        return $parametres;
    }
?>