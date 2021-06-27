<?php
require $_SERVER['DOCUMENT_ROOT'].'/manager/generate/header.php';
$accountId = getUserById($_GET['id']);
$userID = $accountId['id'];
$userName = $accountId['name'];
$nameUser = $accountId['username'];
$colorInterfaceUserSetting = $accountId['colorinterface'];
$foreachTypeUser = $accountId['type_user'];
if ($foreachTypeUser === "1") {
    $adminAcc = "Администратор";
}elseif ($foreachTypeUser === "0") {
    $adminAcc = "Пользователь";
};
$url = $_SERVER['REQUEST_URI'];
$data=$_POST;
if (isset($data['passwordButton'])) {
    $errors = array();
    if( $data['password'] == '' || strlen($data['password']) > 20 || strlen($data['password']) < 5){
        $errors[]= 'Проверьте пароль!';
    }
    if( $data['password_2'] != $data['password']){
        $errors[]= 'Пароли не совпадают!';
    }
    if (empty($errors)) {
        $password = $data['password'];
        $password = password_hash($data['password'], PASSWORD_DEFAULT);
        $dbProd->query("UPDATE `accounts` SET `password` = '$password' WHERE `id` = '$userID'");
        $message = "Пароль изменён";
        $color = 'alert-success';
    }else {
        $message = array_shift($errors);
        $color = 'alert-danger';
    }
}
if (isset($data['loginButton'])) {
    $errors = array();
    if( $data['login'] == ''){
        $errors[]= 'Логин не введён!';
    }
    if (empty($errors)) {
        $loginForm = $data['login'];
        str_replace(" ","",$loginForm);
        $dbProne->query("UPDATE `accounts` SET `username` = '$loginForm' WHERE `id` = '$userID'");
        exit("<meta http-equiv='refresh' content='0; url= $url'>");
    }else {
        $message = array_shift($errors);
        $color = 'alert-danger';
    }
}
if (isset($data['accessButton'])) {
    $accessForm = $data['access'];
    switch ($accessForm) {
        case 0:
            $dbProd->query("UPDATE `accounts` SET `type_user` = '$accessForm' WHERE `id` = '$userID'");
            exit("<meta http-equiv='refresh' content='0; url= $url'>");
            break;
        case 1:
            $dbProd->query("UPDATE `accounts` SET `type_user` = '$accessForm' WHERE `id` = '$userID'");
            exit("<meta http-equiv='refresh' content='0; url= $url'>");
            break;
        default:
            exit("<meta http-equiv='refresh' content='0; url= $url'>");
            break;
    }      
};
if (isset($data['colorInterfaceButton'])) {
    $colorInterfaceForm = $data['color'];
    $dbProd->query("UPDATE `accounts` SET `colorinterface` = '$colorInterfaceForm' WHERE `id` = '$userID'");
    exit("<meta http-equiv='refresh' content='0; url= $url'>");
};
?>

    <div class="container-fluid pt-5">
        <div class="row">
            <div class="col-lg-12 mb-4">
                <div class="card wow slideInLeft <?php echo $bgColorCard?>">
                    <?php
                    if ($typeUser === "user") {?>
                        <div class="card-body">
                            <h3 class="text-center text-danger">У вас недостаточно прав</h3>
                        </div>
                    <?php } else{ ?>
                        <div class="card-body">
                            <div class="col-12 h-3 pb-1 pt-3 border-bottom border-light waves-effect <?php echo $logoColorText?>"><span><?php echo $userName ?></span></div>
                            <?php if(!empty($message)) { ?>
                                <div class="alert <?php echo $color ?> alert-dismissible fade show" role="alert">
                                    <?php echo $message; ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php } ?>
                            <div class="card-text <?php echo $colorTextContant?>">
                                <a href="#" class="text-muted" data-toggle="modal" data-target="<?php if ($typeUser=="user") {echo "#";}?>#login">
                                    <div class="container-fluid p-2 pt-3 border-bottom border-light waves-effect pl-4 <?php echo $colorTextContant?>">
                                        <div class="row">
                                            <div class="col-12 col-sm-2">Логин: </div>
                                            <div class="col-12 col-sm-10">
                                                <?php echo $nameUser ?>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <a href="#" class="text-muted" data-toggle="modal" data-target="<?php if ($typeUser=="user") {echo "#";}?>#password">
                                    <div class="container-fluid p-2 pt-3 border-bottom border-light waves-effect pl-4 <?php echo $colorTextContant?>">
                                        <div class="row">
                                            <div class="col-12 col-sm-2">Пароль: </div>
                                            <div class="col-12 col-sm-10">
                                                ***********
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <a href="#" class="text-muted" data-toggle="modal" data-target="<?php if ($typeUser=="user") {echo "#";}?>#access">
                                    <div class="container-fluid p-2 pt-3 border-bottom border-light waves-effect pl-4 <?php echo $colorTextContant?>">
                                        <div class="row">
                                            <div class="col-12 col-sm-2">Права доступа: </div>
                                            <div class="col-12 col-sm-10">
                                                <?php echo $adminAcc ?>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <a href="#" class="text-muted" data-toggle="modal" data-target="#themeColor">
                                    <div class="container-fluid p-2 pt-3 border-bottom border-light waves-effect pl-4 <?php echo $colorTextContant?>">
                                        <div class="row">
                                            <div class="col-12 col-sm-2">Тема: </div>
                                            <div class="col-12 col-sm-10">
                                                <?php echo $colorInterfaceUserSetting ?>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <?php }?>
                </div>
            </div>
        </div>
    </div>
    </main>
    <?php
    if ($typeUser === "admin") {?>
        <div class="modal fade" id="password" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content <?php echo $bgColorCard?>">
                    <div class="modal-header text-center <?php echo $colorTextContant?>">
                        <h4 class="modal-title w-100 font-weight-bold">Изменение пароля</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form action="<?php echo $url?>" method="POST">
                        <div class="modal-body mx-3">
                            <div class="md-form mb-5">
                                <i class="fas fa-lock prefix grey-text"></i>
                                <input type="password" id="orangeForm-password" name="password" class="form-control validate <?php echo $colorTextContant?>">
                                <label data-error="wrong" class="<?php echo $colorTextContant?>" data-success="right" for="orangeForm-password">Новый пароль</label>
                            </div>
                            <div class="md-form mb-4">
                                <i class="fas fa-lock prefix grey-text"></i>
                                <input type="password" id="orangeForm-pass" name="password_2" class="form-control validate <?php echo $colorTextContant?>">
                                <label data-error="wrong" class="<?php echo $colorTextContant?>" data-success="right" for="orangeForm-pass">Пароль ещё раз</label>
                            </div>
                            <div class="text-center <?php echo $colorTextContant?>">Требования: не менее 5 и не более 20 символов в пароле</div>
                            <div class="modal-footer d-flex justify-content-center">
                                <button type="submit" name="passwordButton" class="btn <?php echo $btnColor?>">Изменить</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content <?php echo $bgColorCard?>">
                    <div class="modal-header text-center">
                        <h4 class="modal-title w-100 font-weight-bold <?php echo $colorTextContant?>">Изменение логина</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form action="<?php echo $url?>" method="POST">
                        <div class="modal-body mx-3">
                            <div class="md-form mb-5 <?php echo $colorTextContant?>">
                                <i class="fas fa-address-card prefix grey-text"></i>
                                <input type="text" id="orangeForm" name="login" class="form-control validate <?php echo $colorTextContant?>">
                                <label class="<?php echo $colorTextContant?>" data-error="wrong" data-success="right" for="orangeForm">Новый логин</label>
                            </div>
                            <div class="modal-footer d-flex justify-content-center">
                                <button type="submit" name="loginButton" class="btn <?php echo $btnColor?>">Изменить</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="access" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content <?php echo $bgColorCard?>">
                    <div class="modal-header text-center <?php echo $colorTextContant?>">
                        <h4 class="modal-title w-100 font-weight-bold <?php echo $colorTextContant?>">Изменение прав доступа</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form action="<?php echo $url?>" method="POST">
                        <div class="modal-body mx-3">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text <?php echo $bgColorCard?> <?php echo $colorTextContant?>" for="accessUser">Права пользователя</label>
                                </div>
                                <select class="browser-default custom-select <?php echo $bgColorCard?> <?php echo $colorTextContant?>" name="access" id="accessUser">
                                    <option value="0">Пользователь</option>
                                    <option value="1">Администратор</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="submit" name="accessButton" class="btn <?php echo $btnColor?>">Изменить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php }?>
        <div class="modal fade" id="themeColor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content <?php echo $bgColorCard?>">
                    <div class="modal-header text-center">
                        <h4 class="modal-title w-100 font-weight-bold <?php echo $colorTextContant?>">Изменение темы</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form action="<?php echo $url?>" method="POST">
                        <div class="modal-body mx-3">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text <?php echo $bgColorCard?> <?php echo $colorTextContant?>" for="themeColorUser">Цвет темы</label>
                                </div>
                                <select class="browser-default custom-select <?php echo $bgColorCard?> <?php echo $colorTextContant?>" name="color" id="themeColorUser">
                                    <option value="white">white</option>
                                    <option value="dark">dark</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="submit" name="colorInterfaceButton" class="btn <?php echo $btnColor?>">Изменить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php require $_SERVER['DOCUMENT_ROOT'].'/manager/generate/footer.php'?>
    </body>

    </html>