<?php require $_SERVER['DOCUMENT_ROOT'] . '/manager/generate/header.php';
$urlAdminSp = $_SERVER['REQUEST_URI']; 
$data = $_POST;
if( isset($data['screenSettingBtn']) ){
    $idScreen = $data['screenSettingBtn'];
    $nameScreen = $data['nameScreen'];
    $numberScreen = $data['numberScreen'];
    $numberTemplateScreen = $data['numberTemplateScreen'];
    $screenActive = $data['screenActive'];
    $fastAccessMenuScreen = $data['fastAccessMenuScreen'];
    $colorBG = $data['colorBG'];
    $colorTitleText = $data['colorTitleText'];
    $colorText = $data['colorText'];
    $uploadedFile = $data['uploadedFile'];
    $checkVisible = $data['checkVisible'];
    if (isset($data['checkVisible'])) {
        $data['checkVisible'] = "1";
    }else{
        $data['checkVisible'] = "0";
    }
    $errors = array();
    if( trim($data['nameScreen']) == ''){
        $errors[]= 'Введите название экрана';
    }
    if( trim($data['numberScreen']) == ''){
        $errors[]= 'Введите номер экрана';
    }
    if( trim($data['numberTemplateScreen']) == ''){
        $errors[]= 'Введите номер шаблона';
    }
    if( trim($data['fastAccessMenuScreen']) == ''){
        $errors[]= 'Введите быстрый доступ';
    }
    if( trim($data['colorBG']) == ''){
        $errors[]= 'Введите название цвета фона';
    }
    if( trim($data['colorTitleText']) == ''){
        $errors[]= 'Введите название цвета заголовка';
    }
    if( trim($data['colorText']) == ''){
        $errors[]= 'Введите название цвета текста';
    }
    if (empty($errors)) {
        if ($stmt = $dbProd->prepare('SELECT `number` FROM screen WHERE `number` = ?')) {
            $stmt->bind_param('s', $data['numberScreen']);
            $stmt->execute();
            $stmt->bind_result($numberScreen);
            $stmt->fetch();
            $stmt->close();
            $numberScreenFunction= getNumberScreen($idScreen);
            if (($numberScreenFunction == $data['numberScreen']) || empty($numberScreen)) {
                if ($stmt = $dbProd->prepare('UPDATE `screen` SET `number` = ?, `name` = ?,`type_template` = ?,`screen_active` = ?,`img_active` = ?, `bg_color` = ?,`text_title_color` = ?,`text_color` = ?,`fast_access` = ? WHERE `screen`.`id` = ?')) {
                    $stmt->bind_param('ssssssssss', $data['numberScreen'], $data['nameScreen'], $data['numberTemplateScreen'], $data['screenActive'], $data['checkVisible'], $data['colorBG'], $data['colorTitleText'],$data['colorText'], $data['fastAccessMenuScreen'],$data['screenSettingBtn']);
                    $stmt->execute();
                    if (isset($_FILES['uploadedFile']) && $_FILES['uploadedFile']['error'] === UPLOAD_ERR_OK){// update img url
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
                            $uploadUrlDB = "/manager/resources/upload/".$newFileName;
                            if(move_uploaded_file($fileTmpPath, $dest_path)){
                                $dbProd->query("UPDATE `screen` SET `img_url` = '$uploadUrlDB'  WHERE `screen`.`id` = '$idScreen'");
                                $message ='Файл успешно загружен';
                                $color = 'alert-success';
                            }else{
                                $message = 'При перемещении файла в каталог загрузки произошла ошибка. Убедитесь, что каталог загрузки доступен для записи веб-сервером.';
                                $color = 'alert-danger';
                            }
                        }else {
                            $message = 'Загрузка не удалась. Допустимые типы файлов: ' . implode(', ', $allowedfileExtensions);
                            $color = 'alert-danger';
                        }
                    }else {
                        $message = 'При загрузке файла произошла ошибка. Пожалуйста, проверьте следующую ошибку. <br>';
                        $message .= 'Error:' . $_FILES['uploadedFile']['error'];
                        $color = 'alert-danger';
                    }
                    $message = 'Настройки экрана '.$data['numberScreen'].' обновлены!';
                    $color = 'alert-success';
                    $data = "";
                } else {
                    $message = 'Ошибка отправки формы';
                    $color = 'alert-danger';
                }
            }else{
                $message = 'Такой номер экрана уже есть';
                $color = 'alert-danger';
            }
        }
    }else {
        $message = array_shift($errors);
        $color = 'alert-danger';
    }
    
};
if( isset($data['addCatToScreen']) ){
    $idCatToScreen = $data['addCatToScreen'];// id screen
    $IDcat = $data['IDcat'];//id categories
    $numberPositionScreen = $data['numberPositionScreen'];// position
    $errors = array();
    if( trim($data['addCatToScreen']) == ''){
        $errors[]= 'Введите номер экрана не известен';
    }
    if( trim($data['IDcat']) == ''){
        $errors[]= 'Введите категорию';
    }
    if( trim($data['numberPositionScreen']) == ''){
        $errors[]= 'Введите позицию категории на экране';
    }
    if (empty($errors)) {
        if ($stmt = $dbProd->prepare('SELECT `id` FROM categories_screen WHERE `id_screen` = ? AND `id_categories` = ?')) {
            $stmt->bind_param('ss', $data['addCatToScreen'], $data['IDcat']);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows > 0) {
                $message = 'Такая категория уже есть на экране';
                $color = 'alert-danger';
            }else{
                if ($stmt = $dbProd->prepare('INSERT INTO `categories_screen` (`id_screen`, `id_categories`, `category_screen_positions`) VALUES (?, ?, ?)')) {
                    $stmt->bind_param('sss', $idCatToScreen, $IDcat, $numberPositionScreen);
                    $stmt->execute();
                    $message = 'Настройки экрана '.$data['numberScreen'].' обновлены!';
                    $color = 'alert-success';
                    $data = "";
                    $_POST = "";
                }else {
                    $message = array_shift($errors);
                    $color = 'alert-danger';
                }
            }
        }

    }else {
        $message = array_shift($errors);
        $color = 'alert-danger';
    }
    
    
};
if( isset($data['screenInsertBtn']) ){
    $idCatToScreen = $data['nameScreen'];
    $IDcat = $data['numberScreen'];
    $nnumberPositionScreen = $data['numberPositionScreen'];
    $errors = array();
    if( trim($data['numberScreen']) == ''){
        $errors[]= 'Введите номер экрана не известен';
    }
    if( trim($data['nameScreen']) == ''){
        $errors[]= 'Введите категорию';
    }
    if ($stmt = $dbProd->prepare('SELECT `number` FROM screen WHERE `number` = ?')) {
        $stmt->bind_param('s', $data['numberScreen']);
        $stmt->execute();
        $stmt->bind_result($numberScreen);
        $stmt->fetch();
        $stmt->close();
        $numberScreenFunction= getNumberScreen($idScreen);
        if (($numberScreen != $data['numberScreen'])) {
            if ($stmt = $dbProd->prepare('INSERT INTO `screen` (`number`, `name`) VALUES ( ?, ?)')){
                $stmt->bind_param('ss', $data['numberScreen'], $data['nameScreen']);
                $stmt->execute();
                $message = 'Экран '.$data['numberScreen'].' добавлен!';
                $color = 'alert-success';
                $data = "";
                $_POST = "";
            }else {
                $message = array_shift($errors);
                $color = 'alert-danger';
            }
        }else{
            $message = 'Такой номер экрана уже есть';
            $color = 'alert-danger';
        }
    }
    
};
if( isset($data['screenDeleteBtn']) ){
    $idCatToScreen = $data['screenDelete'];
    $errors = array();
    if( trim($data['screenDelete']) == ''){
        $errors[]= 'Введите номер экрана не известен';
    }
    if ($stmt = $dbProd->prepare('DELETE FROM `screen` WHERE `screen`.`id` = ?')) {
        $stmt->bind_param('s', $idCatToScreen);
        $stmt->execute();
        $message = 'Экран удалён';
        $color = 'alert-success';
        $data = "";
        $_POST = "";
    }else {
        $message = array_shift($errors);
        $color = 'alert-danger';
    }
    
};
?>
<div class="container-fluid pt-5">
    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card mb-3 <?php echo $bgColorCard ?>">
                <div class="card-body">
                    <div class="card-title <?php echo $bgColorCard?> <?php echo $colorTextContant?>">
                        <h5>Экраны</h5>
                    </div>
                    <?php if(!empty($message)) { ?>
                        <div class="alert <?php echo $color ?> alert-dismissible fade show" role="alert">
                            <?php echo $message; ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                    <?php } ?>
                    <div class="card-text row" id="block1floor<?php echo $quantityFloorRaundArray?>">
                        <?php
                            $screensStatus =  getScreenStatus();
                            global $arrayIcon;
                            global $arrayColor;
                            foreach ($screensStatus as $screenStatus) {
                                $number = $screenStatus['number'];
                                $parametres = generateParametresForModal($screenStatus['screen_active']);?>
                                    <div class="list-group list-group-flush">
                                        <a href="#" class="list-group-item list-group-item-action waves-effect p-3 <?php echo $bgColorCard?> <?php echo $colorTextContant?>" data-toggle="modal" data-target="#modalFor<?php echo $screenStatus['id'] ?>" title="<?php echo $parametres['0'] ?>">Экран <?php echo $number." ".$screenStatus['name'] ?> 
                                            <span class="badge <?php echo $parametres['2'] ?> badge-pill pull-right"><?php echo $parametres['0'] ?><i class="<?php echo $parametres['1'] ?>"></i></span>
                                        </a>
                                    </div>
                        <?php };?>
                        <div class="list-group list-group-flush">
                            <a href="#" class="list-group-item list-group-item-action waves-effect p-3 <?php echo $bgColorCard?> <?php echo $colorTextContant?>" data-toggle="modal" data-target="#modalInsertScreen" title="">Добавить экран
                                <span class="badge badge-info badge-pill pull-right">+</span>
                            </a>
                        </div>
                        <div class="list-group list-group-flush">
                            <a href="#" class="list-group-item list-group-item-action waves-effect p-3 <?php echo $bgColorCard?> <?php echo $colorTextContant?>" data-toggle="modal" data-target="#modalDeleteScreen" title="">Удалить экран
                                <span class="badge badge-warning badge-pill pull-right">&times;</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="modal">
    <?php
        $screensSetting =  getScreenSetting();
        foreach ($screensSetting as $screenSetting) {
            if ($screenSetting['screen_active'] == 1) {$screenMenu = "Включено";}else{$screenMenu = "Выключено";};
            if ($screenSetting['fast_access'] == 1) {$screenFastAccess = "Да";}else{$screenFastAccess = "Нет";};
            if ($screenSetting['img_active'] == '1') {$checkBoxchecked = "checked";}else{$checkBoxchecked = "";};
            ?>
                <div class="modal fade" id="modalFor<?php echo $screenSetting['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" wfd-invisible="true" data-gtm-vis-first-on-screen-2340190_1302="182897" data-gtm-vis-total-visible-time-2340190_1302="100" data-gtm-vis-has-fired-2340190_1302="1" aria-hidden="true">
                    <div class="modal-dialog cascading-modal" role="document">
                        <!--Content-->
                        <div class="modal-content <?php echo $bgColorCard ?>">
                            <!--Modal cascading tabs-->
                            <div class="modal-c-tabs <?php echo $bgColorCard ?>">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs md-tabs tabs-2 <?php echo $orangColor ?> p-2 rounded " role="tablist" <?php echo $orangColorBorder ?>>
                                    <li class="nav-item waves-effect waves-light">
                                        <a class="nav-link color-light active" data-toggle="tab" href="#settingScreen<?php echo $screenSetting['id'] ?>" role="tab" aria-selected="true"> Настройки экрана</a>
                                    </li>
                                    <li class="nav-item waves-effect waves-light">
                                        <a class="nav-link color-light" data-toggle="tab" href="#catScreen<?php echo $screenSetting['id'] ?>" role="tab" aria-selected="false"> Категории на экране</a>
                                    </li>
                                </ul>
                                <!-- Tab panels -->
                                <div class="tab-content <?php echo $bgColorCard ?>">
                                    <!--Panel 17-->
                                    <div class="tab-pane fade in active show fadeIn" id="settingScreen<?php echo $screenSetting['id'] ?>" role="tabpanel" wfd-invisible="true">
                                        <!--Body-->
                                        <div class="modal-body mb-1">
                                            <form action="conf.php" class="<?php echo $colorTextContant ?>" method="POST" id="settingScreenForm<?php echo $screenSetting['id'] ?>" enctype="multipart/form-data">
                                                <div class="col-12 col-xl-12 text-left <?php echo $colorTextContant ?>">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <label class="<?php echo $bgColorCard ?> <?php echo $colorTextContant ?>" for="nameScreen">Имя экрана</label>
                                                            <input class="form-control mb-1 <?php echo $bgColorCard ?> <?php echo $colorTextContant ?>" name="nameScreen" id="nameScreen" type="text" placeholder="Главный экран" value="<?php echo $screenSetting['name'] ?>" title="Введите имя экрана">
                                                            <label class="<?php echo $bgColorCard ?> <?php echo $colorTextContant ?>" for="numberScreen">Номер экрана</label>
                                                            <input class="form-control mb-1 <?php echo $bgColorCard ?> <?php echo $colorTextContant ?>" name="numberScreen" id="numberScreen" type="text" placeholder="№ 1" value="<?php echo $screenSetting['number'] ?>" title="Введите номер экрана">
                                                            <label class="<?php echo $bgColorCard ?> <?php echo $colorTextContant ?>" for="numberTemplateScreen">Номер шаблона экрана</label>
                                                            <select name="numberTemplateScreen" class="browser-default custom-select mb-1 <?php echo $bgColorCard ?> <?php echo $colorTextContant ?>" id="numberTemplateScreen">
                                                                <option value="<?php echo $screenSetting['type_template'] ?>"><?php echo $screenSetting['type_template'] ?></option>
                                                                <?php
                                                                $screenTemplateNumber = getsumTemplateMenu();

                                                                $numberTemplateWhile = 1;
                                                                while ($numberTemplateWhile <= $screenTemplateNumber) {
                                                                    if($numberTemplateWhile == $screenSetting['type_template']){}else{?>
                                                                        <option value="<?php echo $numberTemplateWhile ?>"><?php echo $numberTemplateWhile ?></option>
                                                                    <?php }
                                                                    $numberTemplateWhile++;
                                                                }?>
                                                            </select>
                                                            <label class="<?php echo $bgColorCard ?> <?php echo $colorTextContant ?>" for="screenActive">Статус меню на экране</label>
                                                            <select name="screenActive" class="browser-default custom-select mb-1 <?php echo $bgColorCard ?> <?php echo $colorTextContant ?>" id="screenActive">
                                                                <option value="<?php echo $screenSetting['screen_active'] ?>"><?php echo $screenMenu ?></option>
                                                                <?php
                                                                if ($screenSetting['screen_active'] == 1) { ?>
                                                                    <option value="0">Выключено</option>
                                                                <?php } else { ?>
                                                                    <option value="1">Включено</option>
                                                                <?php } ?>
                                                            </select>
                                                            <label class="<?php echo $bgColorCard ?> <?php echo $colorTextContant ?>" for="fastAccessMenuScreen">Отображение в меню быстрого доступа</label>
                                                            <select name="fastAccessMenuScreen" class="browser-default custom-select mb-1 <?php echo $bgColorCard ?> <?php echo $colorTextContant ?>" id="fastAccessMenuScreen">
                                                                <option value="<?php echo $screenSetting['fast_access'] ?>"><?php echo $screenFastAccess ?></option>
                                                                <?php
                                                                if ($screenSetting['fast_access'] == 1) { ?>
                                                                    <option value="0">Нет</option>
                                                                <?php } else { ?>
                                                                    <option value="1">Да</option>
                                                                <?php } ?>
                                                            </select>
                                                            <label class="<?php echo $bgColorCard ?> <?php echo $colorTextContant ?>" for="colorBg<?php echo $screenSetting['id'] ?>">Цвет фона</label>
                                                            <select name="colorBG" class="browser-default custom-select mb-1 <?php echo $bgColorCard ?> <?php echo $colorTextContant ?>" id="colorBg<?php echo $screenSetting['id'] ?>">
                                                                <option value="<?php echo $screenSetting['bg_color'] ?>"><?php echo $screenSetting['bg_color'] ?></option>
                                                                <?php require $_SERVER['DOCUMENT_ROOT'] . '/manager/generate/colorBG.php';
                                                                ?>
                                                            </select>
                                                            <label class="<?php echo $bgColorCard ?> <?php echo $colorTextContant ?>" for="colorTextTitle<?php echo $screenSetting['id'] ?>">Цвет текста заголовка</label>
                                                            <select name="colorTitleText" class="browser-default custom-select mb-1 <?php echo $bgColorCard ?> <?php echo $colorTextContant ?>" id="colorTextTitle<?php echo $screenSetting['id'] ?>">
                                                                <option value="<?php echo $screenSetting['text_title_color'] ?>"><?php echo $screenSetting['text_title_color'] ?></option>
                                                                <?php require $_SERVER['DOCUMENT_ROOT'] . '/manager/generate/colorText.php';
                                                                ?>
                                                            </select>
                                                            <label class="<?php echo $bgColorCard ?> <?php echo $colorTextContant ?>" for="colorText<?php echo $screenSetting['id'] ?>">Цвет текста</label>
                                                            <select name="colorText" class="browser-default custom-select mb-1 <?php echo $bgColorCard ?> <?php echo $colorTextContant ?>" id="colorText<?php echo $screenSetting['id'] ?>">
                                                                <option value="<?php echo $screenSetting['text_color'] ?>"><?php echo $screenSetting['text_color'] ?></option>
                                                                <?php require $_SERVER['DOCUMENT_ROOT'] . '/manager/generate/colorText.php';
                                                                ?>
                                                            </select>
                                                            <div class="input-group mt-2">
                                                                <div class="custom-file">
                                                                    <label class="custom-file-label <?php echo $bgColorCard ?> <?php echo $colorTextContant ?>" for="imgInputScreen<?php echo $screenSetting['id'] ?>">Картинка фона</label>
                                                                    <input name="uploadedFile" type="file" class="custom-file-input <?php echo $bgColorCard ?> <?php echo $colorTextContant ?>" id="imgInputScreen" aria-describedby="inputGroupFileAddon01">
                                                                </div>
                                                            </div>

                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" name="checkVisible" id="checkVisible<?php echo $screenSetting['id'] ?>" <?php echo $checkBoxchecked ?>>
                                                                <label class="custom-control-label" for="checkVisible<?php echo $screenSetting['id'] ?>">Показывать картинку</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="text-center mt-4">
                                                        <button class="btn <?php echo $btnColor ?> waves-effect waves-light" type="submit" name="screenSettingBtn" value="<?php echo $screenSetting['id'] ?>" <?php echo $disabled ?>>Обновить</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <!--Footer-->
                                        <div class="modal-footer">
                                            <button type="button" class="btn <?php echo $btnOutlineColor ?> waves-effect ml-auto" data-dismiss="modal">Закрыть</button>
                                        </div>
                                    </div>
                                    <!--/.Panel 7-->
                                    <!--Panel 18-->
                                    <div class="tab-pane fade" id="catScreen<?php echo $screenSetting['id'] ?>" role="tabpanel" wfd-invisible="true">
                                        <!--Body-->
                                        <div class="tab-pane fade active show fadeIn" id="form<?php echo $screenSetting['id'] ?>" role="tabpanel" wfd-invisible="true">
                                            <!--Body-->
                                            <div class="modal-body mb-1">
                                                <h5 class="text-center <?php echo $colorTextContant?>">Управление категориями</h5>
                                                <div class="container-fluid mb-1 p-3 border border-light rounded <?php echo $colorTextContant?>">
                                                    <form action="conf.php" class="<?php echo $colorTextContant ?>" method="POST" id="settingScreenCatForm<?php echo $screenSetting['id'] ?>">
                                                        <!-- Start Insert categories to screen -->
                                                        <div class="col-12 col-xl-12 text-left <?php echo $colorTextContant ?> p-1">
                                                            <div class="row">
                                                                <div class="col-12 col-md-5 p-1">
                                                                    <label class="<?php echo $bgColorCard ?> <?php echo $colorTextContant ?>" for="numberTemplateScreen">Имя категории</label>
                                                                    <select name="IDcat" class="browser-default custom-select mb-1 <?php echo $bgColorCard ?> <?php echo $colorTextContant ?>" id="numberTemplateScreen">
                                                                        <?php
                                                                        $namesCatID = $dbProd->query("SELECT `id`,`name_cat` FROM `categories`");
                                                                        foreach ($namesCatID as $nameCatID) { ?>
                                                                            <option value="<?php echo $nameCatID['id'] ?>"><?php echo $nameCatID['name_cat'] ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                                <div class="col-12 col-md-5 p-1">
                                                                    <label class="<?php echo $bgColorCard ?> <?php echo $colorTextContant ?>" for="numberPositionScreen">Позиция категории</label>
                                                                    <select name="numberPositionScreen" class="browser-default custom-select mb-1 <?php echo $bgColorCard ?> <?php echo $colorTextContant ?>" id="numberPositionScreen">
                                                                        <?php
                                                                            $numberPositionCatScreen = getsumTemplateMenu();
                                                                            $numberPositionCatScreenWhile = 1;
                                                                            while ($numberPositionCatScreenWhile <= $numberPositionCatScreen) {?>
                                                                                <option value="<?php echo $numberPositionCatScreenWhile ?>"><?php echo $numberPositionCatScreenWhile ?></option>
                                                                        <?php
                                                                            $numberPositionCatScreenWhile++;
                                                                        }?>
                                                                    </select>
                                                                </div>
                                                                <div class="text-center col-12 col-md-2 p-1 mt-3">
                                                                    <button name="addCatToScreen" class="btn text-capitalize mt-3 <?php echo $btnColor ?> waves-effect waves-light p-1 m-0 btn-rounded" value="<?php echo $screenSetting['id'] ?>" type="submit" onclick="" <?php echo $disabled ?>>Добавить</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Stop Insert categories to screen -->
                                                    </form>
                                                </div>
                                                <?php
                                                $idScreen = $screenSetting['id'];
                                                $catsScreen = $dbProd->query("SELECT * FROM `categories_screen` WHERE `id_screen` = '$idScreen'");
                                                foreach ($catsScreen as $catScreen) {
                                                    $idRowTableScreenCat = $catScreen['id'];
                                                    $idCat = $catScreen['id_categories'];
                                                    $catParam = $dbProd->query("SELECT `name_cat` FROM `categories` WHERE `id` = '$idCat'");
                                                    $catParam = mysqli_fetch_assoc($catParam);
                                                    $catParam = $catParam['name_cat'];?>
                                                    <form action="#" class="<?php echo $colorTextContant ?>" method="POST" id="catPositionForm<?php echo $idCat.$idScreen ?>">
                                                        <div class="container-fluid mb-1 p-3 border border-light rounded <?php echo $colorTextContant?>">
                                                            <div class="row">
                                                                <div class="col-12 col-md-6 d-flex align-middle p-0 pl-2 pt-2">
                                                                    Категория <?php echo $catParam?> <br>
                                                                </div>
                                                                <input class="form-control mb-1 none <?php echo $bgColorCard ?> <?php echo $colorTextContant ?>" name="idRow" type="text" value="<?php echo $idRowTableScreenCat ?>">
                                                                <select name="positionCat" class="browser-default custom-select mb-1 col-12 col-md-4 d-flex align-middle <?php echo $bgColorCard ?> <?php echo $colorTextContant ?>" id="positionCat<?php echo $idCat.$idScreen?>">
                                                                    <option value="<?php echo $catScreen['category_screen_positions']?>"><?php echo $screenColor ?><?php echo $catScreen['category_screen_positions']?></option>
                                                                    <?php
                                                                        if ($catScreen['category_screen_positions'] == 1) {?>
                                                                            <option value="2">2</option>
                                                                        <?php }else{?>
                                                                            <option value="1">1</option>
                                                                    <?php }?>
                                                                </select>
                                                                <script>
                                                                    positionCat<?php echo $idCat.$idScreen ?>.onblur = function () {
                                                                        sendCatPositionModal("#catPositionForm<?php echo $idCat.$idScreen ?>");
                                                                    };
                                                                </script>
                                                                <div class="col-12 col-md-2 d-flex justify-content-md-end align-middle">
                                                                    <a href="#" onclick="deleteCatScreenModal<?php echo $idCat.$idScreen ?>()">
                                                                        <span class="badge badge-danger badge-pill p-2 m-1 pull-right"> &times; </span>
                                                                    </a>
                                                                </div>
                                                                <script>
                                                                    function deleteCatScreenModal<?php echo $idCat.$idScreen ?>(){
                                                                        deleteCatScreen("#catPositionForm<?php echo $idCat.$idScreen ?>");
                                                                        document.getElementById("catPositionForm<?php echo $idCat.$idScreen ?>").remove();
                                                                    };
                                                                </script>
                                                            </div>
                                                        </div>
                                                    </form>
                                                <?php }
                                                ?>
                                                
                                            </div>
                                            <!--Footer-->
                                            <div class="modal-footer">
                                                <button type="button" class="btn <?php echo $btnOutlineColor ?> waves-effect ml-auto" data-dismiss="modal">Закрыть</button>
                                            </div>

                                            <!--Footer-->
                                        </div>
                                        <!--/.Panel 8-->
                                    </div>
                                </div>
                            </div>
                            <!--/.Content-->
                        </div>
                    </div>
                </div>
        <?php };?>
        <div class="modal fade" id="modalInsertScreen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" wfd-invisible="true" data-gtm-vis-first-on-screen-2340190_1302="182897" data-gtm-vis-total-visible-time-2340190_1302="100" data-gtm-vis-has-fired-2340190_1302="1" aria-hidden="true">
            <div class="modal-dialog cascading-modal" role="document">
                <!--Content-->
                <div class="modal-content <?php echo $bgColorCard ?>">
                    <!--Modal cascading tabs-->
                    <div class="modal-c-tabs <?php echo $bgColorCard ?>">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs md-tabs tabs-2 <?php echo $orangColor ?> p-2 rounded " role="tablist" <?php echo $orangColorBorder ?>>
                            <li class="nav-item waves-effect waves-light">
                                <a class="nav-link color-light active" data-toggle="tab" href="#settingScreen<?php echo $screenSetting['id'] ?>" role="tab" aria-selected="true"> Добавление экрана</a>
                            </li>
                        </ul>
                        <!-- Tab panels -->
                        <div class="tab-content <?php echo $bgColorCard ?>">
                            <!--Panel 17-->
                            <div class="tab-pane fade in active show fadeIn" id="settingScreen<?php echo $screenSetting['id'] ?>" role="tabpanel" wfd-invisible="true">
                                <!--Body-->
                                <div class="modal-body mb-1">
                                    <form action="conf.php" class="<?php echo $colorTextContant ?>" method="POST" id="settingScreenForm<?php echo $screenSetting['id'] ?>" enctype="multipart/form-data">
                                        <div class="col-12 col-xl-12 text-left <?php echo $colorTextContant ?>">
                                            <div class="row">
                                                <div class="col-12">
                                                    <label class="<?php echo $bgColorCard ?> <?php echo $colorTextContant ?>" for="nameScreen">Имя экрана</label>
                                                    <input class="form-control mb-1 <?php echo $bgColorCard ?> <?php echo $colorTextContant ?>" name="nameScreen" id="nameScreen" type="text" placeholder="Главный экран" value="" title="Введите имя экрана" require>
                                                    <label class="<?php echo $bgColorCard ?> <?php echo $colorTextContant ?>" for="numberScreen">Номер экрана</label>
                                                    <input class="form-control mb-1 <?php echo $bgColorCard ?> <?php echo $colorTextContant ?>" name="numberScreen" id="numberScreen" type="number" placeholder="1" value="" title="Введите номер экрана" pattern="" require>
                                                </div>
                                            </div>
                                            <div class="text-center mt-4">
                                                <button class="btn <?php echo $btnColor ?> waves-effect waves-light" type="submit" name="screenInsertBtn" <?php echo $disabled ?>>Добавить</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!--Footer-->
                                <div class="modal-footer">
                                    <button type="button" class="btn <?php echo $btnOutlineColor ?> waves-effect ml-auto" data-dismiss="modal">Закрыть</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/.Content-->
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalDeleteScreen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" wfd-invisible="true" data-gtm-vis-first-on-screen-2340190_1302="182897" data-gtm-vis-total-visible-time-2340190_1302="100" data-gtm-vis-has-fired-2340190_1302="1" aria-hidden="true">
            <div class="modal-dialog cascading-modal" role="document">
                <!--Content-->
                <div class="modal-content <?php echo $bgColorCard ?>">
                    <!--Modal cascading tabs-->
                    <div class="modal-c-tabs <?php echo $bgColorCard ?>">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs md-tabs tabs-2 <?php echo $orangColor ?> p-2 rounded " role="tablist" <?php echo $orangColorBorder ?>>
                            <li class="nav-item waves-effect waves-light">
                                <a class="nav-link color-light active" data-toggle="tab" href="#settingScreen<?php echo $screenSetting['id'] ?>" role="tab" aria-selected="true"> Удаление экрана</a>
                            </li>
                        </ul>
                        <!-- Tab panels -->
                        <div class="tab-content <?php echo $bgColorCard ?>">
                            <!--Panel 17-->
                            <div class="tab-pane fade in active show fadeIn" id="settingScreen<?php echo $screenSetting['id'] ?>" role="tabpanel" wfd-invisible="true">
                                <!--Body-->
                                <div class="modal-body mb-1">
                                    <form action="conf.php" class="<?php echo $colorTextContant ?>" method="POST" id="settingScreenForm<?php echo $screenSetting['id'] ?>" enctype="multipart/form-data">
                                        <div class="col-12 col-xl-12 text-left <?php echo $colorTextContant ?>">
                                            <div class="row">
                                                <div class="col-12">
                                                <label class="<?php echo $bgColorCard ?> <?php echo $colorTextContant ?>" for="screenIDDelete">Номер шаблона экрана</label>
                                                    <select name="screenDelete" class="browser-default custom-select mb-1 <?php echo $bgColorCard ?> <?php echo $colorTextContant ?>" id="screenIDDelete">
                                                        <?php
                                                        $screensID = getScreenStatus();
                                                        foreach ($screensID as $screenID) {?>
                                                            <option value="<?php echo $screenID['id'] ?>"><?php echo "Экран ".$screenID['number']." ".$screenID['name'] ?></option>
                                                        <?php }?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="text-center mt-4">
                                                <button class="btn <?php echo $btnColor ?> waves-effect waves-light" type="submit" name="screenDeleteBtn" <?php echo $disabled ?>>удалить</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!--Footer-->
                                <div class="modal-footer">
                                    <button type="button" class="btn <?php echo $btnOutlineColor ?> waves-effect ml-auto" data-dismiss="modal">Закрыть</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/.Content-->
                </div>
            </div>
        </div>
</div>
<script type="text/javascript">
    function deleteCatScreen(idModal) {
        swal({
            title: "Категория удалена",
            text: "Нажмите на кнопку закрыть",
            icon: "success",
            button: "закрыть",
            timer: 2000
        });
        sendDeleteCatScreen('result_form', idModal, '../scriptPHP/catDeleteModal.php');
        return false;
    };

    function sendDeleteCatScreen(result_form, ajax_form, url) {
        jQuery.ajax({
            url: url, //url страницы (sendScript.php)
            type: "POST", //метод отправки
            dataType: "html", //формат данных
            data: jQuery(ajax_form).serialize(), // Сеарилизуем объект
            error: function(response) { // Данные не отправлены
                swal({
                title: "Ошибка. Данные не отправленны",
                text: "Нажмите на кнопку закрыть",
                icon: "error",
                button: "закрыть",
                timer: 1000
                });
            }
        });
    };

    function sendCatPositionModal(idModal) {
        swal({
            title: "Положение категории на экране изменено",
            text: "Нажмите на кнопку закрыть",
            icon: "success",
            button: "закрыть",
            timer: 2000
        });
        sendAjaxForm('result_form', idModal, '../scriptPHP/catPositionModal.php');
        console.log(idModal);
        return false;
    };

    function sendAjaxForm(result_form, ajax_form, url) {
        jQuery.ajax({
            url: url, //url страницы (sendScript.php)
            type: "POST", //метод отправки
            dataType: "html", //формат данных
            data: jQuery(ajax_form).serialize(), // Сеарилизуем объект
            
            error: function(response) { // Данные не отправлены
                swal({
                title: "Ошибка. Данные не отправленны",
                text: "Нажмите на кнопку закрыть",
                icon: "error",
                button: "закрыть",
                timer: 1000
                });
            }
        });
        //console.log(jQuery.ajax({data}));
    };
    
</script>