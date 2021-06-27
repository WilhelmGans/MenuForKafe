<?php require $_SERVER['DOCUMENT_ROOT'].'/manager/generate/header.php';
$urlAdminSp = $_SERVER['REQUEST_URI'];
$data = $_POST;

$deleteCat = $dbProd->query("SELECT COUNT('id') AS countCat FROM categories"); // количество элкементов в таблице Categories для вывода где удаление из таблиц
$deleteCatRow = mysqli_fetch_assoc($deleteCat);
$idCat = $deleteCatRow['countCat'];

$deleteMenu = $dbProd->query("SELECT COUNT('id') AS countMenu FROM menu"); // количество элкементов в таблице Categories для вывода где удаление из таблиц
$deleteMenuRow = mysqli_fetch_assoc($deleteMenu);
$idMenu = $deleteMenuRow['countMenu'];

    if( isset($data['сatRegisterButton']) ){
        $checkPing = '0';
        $userFormPhone = $data['nameCat'];
        $userAccessFormPhone = $data['nameCatEn'];
        $numberForm = $data['massName'];
        $errors = array();
        if( trim($data['nameCat']) == ''){
            $errors[]= 'Введите название категории';
        }
        if (empty($errors)) {
            if ($stmt = $dbProd->prepare('SELECT `name_cat` FROM categories WHERE `name_cat` = ?')) {
                $stmt->bind_param('s', $data['nameCat']);
                $stmt->execute();
                $stmt->store_result();
                if ($stmt->num_rows > 0) {
                    $message = 'Такая категория уже есть';
                    $color = 'alert-danger';
                }else{
                    if ($stmt = $dbProd->prepare('INSERT INTO categories (`name_cat`) VALUES (?)')) {
                        $stmt->bind_param('s', $data['nameCat']);
                        $stmt->execute();
                        $message = 'Категория '.$data['nameCat'].' добавлена!';
                        $color = 'alert-success';
                        $data = "";
                    } else {
                        $message = 'Ошибка отправки формы';
                        $color = 'alert-danger';
                    }
                }
            }

        }else {
            $message = array_shift($errors);
            $color = 'alert-danger';
        }
    };
    if( isset($data['posRegisterButton']) ){
        $checkPing = '0';
        $userFormPhone = $data['namePos'];
        $userAccessFormPhone = $data['namePosEn'];
        $numberForm = $data['massPos'];
        $pricePos = $data['pricePos'];
        $errors = array();
        if( trim($data['namePos']) == ''){
            $errors[]= 'Введите массу блюда';
        }
        if (empty($errors)) {
            if ($stmt = $dbProd->prepare('SELECT `name` FROM menu WHERE `name` = ?')) {
                $stmt->bind_param('s', $data['namePos']);
                $stmt->execute();
                $stmt->store_result();
                if ($stmt->num_rows > 0) {
                    $message = 'Такое блюдо уже есть';
                    $color = 'alert-danger';
                }else{
                    if ($stmt = $dbProd->prepare('INSERT INTO menu (`id_cat`,`name`,`mass`,`price`) VALUES (?, ?, ?, ?)')) {
                        $stmt->bind_param('ssss', $data['catNamePos'],$data['namePos'],$data['massPos'], $data['pricePos']);
                        $stmt->execute();
                        $message = 'Блюдо '.$data['namePos'].' добавлено!';
                        $color = 'alert-success';
                        $data = "";
                    } else {
                        $message = 'Ошибка отправки формы';
                        $color = 'alert-danger';
                    }
                }
            }

        }else {
            $message = array_shift($errors);
            $color = 'alert-danger';
        }
    };
    if( isset($data['delete_cat']) ){
        $nameCatDel = $data['delete_cat'];
        $dbProd->query("DELETE FROM `categories` WHERE `id` = '$nameCatDel'");
        //$dbProd->query("DELETE FROM `phones` WHERE `depends` = '$namePhoneDelete'");
    };
    if( isset($data['delete_prod']) ){
        $nameProdDel = $data['delete_prod'];
        $dbProd->query("DELETE FROM `menu` WHERE `id` = '$nameProdDel'");
        //$dbProd->query("DELETE FROM `phones` WHERE `depends` = '$namePhoneDelete'");
    };
    if( isset($data['update_screen_and_position_cat']) ){
        if ($stmt = $dbProd->prepare('UPDATE `categories` SET `screen` = ?, `position` = ? WHERE `categories`.`id` = ?')) {
            $stmt->bind_param('sss', $data['screenCat'],$data['positionCat'],$data['update_screen_and_position_cat']);
            $stmt->execute();
            $data = "";
        } else {
            $message = 'Ошибка отправки формы';
            $color = 'alert-danger';
        }
    };
    if( isset($data['update_screen_and_position_cat_2']) ){
        if ($stmt = $dbProd->prepare('UPDATE `categories` SET `screen2` = ?, `position2` = ? WHERE `categories`.`id` = ?')) {
            $stmt->bind_param('sss', $data['screen2Cat'],$data['position2Cat'], $data['update_screen_and_position_cat_2']);
            $stmt->execute();
            $data = "";
        } else {
            $message = 'Ошибка отправки формы';
            $color = 'alert-danger';
        }
    };
    if( isset($data['update_screen_and_position_cat_err']) ){
        if ($data['screenCat'] != 'NULL') {
            if ($data['positionCat'] != 'NULL') {
                if ($stmt = $dbProd->prepare('UPDATE `categories` SET `screen` = ?, `position` = ?, `screen2` = ?, `position2` = ? WHERE `categories`.`id` = ?')) {
                    $stmt->bind_param('sssss', $data['screenCat'],$data['positionCat'], $data['screen2Cat'],$data['position2Cat'], $data['update_screen_and_position_cat_err']);
                    $stmt->execute();
                    $data = "";
                } else {
                    $message = 'Ошибка отправки формы';
                    $color = 'alert-danger';
                }
            }
        }

    };
    if( isset($data['screen_visible']) ){
        if ($stmt = $dbProd->prepare('UPDATE `screenconf` SET `screen_visible` = ? WHERE `screen` = ?')) {
            $stmt->bind_param('ss', $data['screenVis'],$data['screen_visible']);
            $stmt->execute();
            $data = "";
        } else {
            $message = 'Ошибка отправки формы';
            $color = 'alert-danger';
        }
    };
    if( isset($data['catUpdateButton']) ){
        if ($stmt = $dbProd->prepare('UPDATE `categories` SET `name_cat` = ? WHERE `id` = ?')) {
            $stmt->bind_param('ss', $data['newCatName'], $data['catID']);
            $stmt->execute();
            $data = "";
        } else {
            $message = 'Ошибка отправки формы';
            $color = 'alert-danger';
        }
    };
    if( isset($data['update_screen_setting']) ){
        $screenData = $data['update_screen_setting'];
        $colorBG = $data['colorBG'];
        $color_text = $data['colorText'];
        if (isset($data['checkVisible'])) {
            $checkVisible = "on";
        }else{
            $checkVisible = "off";
        }
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
                        $uploadUrlDB = "/manager/resources/upload/".$newFileName;
                        if(move_uploaded_file($fileTmpPath, $dest_path)){
                            $message ='Файл успешно загружен';
                            $dbProd->query("UPDATE `screenconf` SET  `color_bg` = '$colorBG', `img_url_bg` = '$uploadUrlDB', `text_color` = '$color_text', `img_on_off` = '$checkVisible' WHERE `screen` = '$screenData'");
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
            
            $_SESSION['message'] = $message;
            $dbProd->query("UPDATE `screenconf` SET  `color_bg` = '$colorBG', `text_color` = '$color_text', `img_on_off` = '$checkVisible' WHERE `screen` = '$screenData'");
    };
?>
<div class="container-fluid pt-5">
    <div class="row">
        <div class="col-lg-12 mb-4">

            <?php
            if ($typeUser === "user") {?>
                <div class="card wow slideInLeft <?php echo $bgColorCard?>">
                    <div class="card-body">
                        <h3 class="text-center text-danger">У вас недостаточно прав</h3>
                    </div>
                </div>
                <?php } else{
            ?>

                    <?php
                    if ($_GET['id'] == "1") {?>
                        <div class="card wow slideInLeft <?php echo $bgColorCard?>">
                            <div class="card-body <?php echo $colorTextContant?>">
                                <form class="pt-2 pl-5 pr-5 pb-5" action="<?php echo $urlAdminSp?>" method="POST">
                                    <?php if(!empty($message)) { ?>
                                        <div class="alert <?php echo $color ?> alert-dismissible fade show" role="alert">
                                            <?php echo $message; ?>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    <?php } ?>
                                    <p class="h4 mb-4 text-center <?php echo $colorTextContant?>">Новая категория</p>
                                    <input class="form-control mb-4 <?php echo $bgColorCard?> <?php echo $colorTextContant?>" name="nameCat" id="nameCat" type="text" placeholder="Название категории" value="<?php echo @$data['nameCat']?>" required pattern="^[а-яА-Я0-9\s]+$" title="только символы кирилицы и цифры">
                                    <button class="btn <?php echo $btnColor?> btn-block my-4" type="submit" name="сatRegisterButton">Добавить категорию</button>
                                </form>
                            <div>
                        </div>
                    <?php }
                    if ($_GET['id'] == "2") {?>
                        <div class="card wow slideInLeft <?php echo $bgColorCard?>">
                            <div class="card-body <?php echo $colorTextContant?>">
                                <form class="pt-2 pl-5 pr-5 pb-5" action="<?php echo $urlAdminSp?>" method="POST">
                                    <?php if(!empty($message)) { ?>
                                        <div class="alert <?php echo $color ?> alert-dismissible fade show" role="alert">
                                            <?php echo $message; ?>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    <?php } ?>
                                    <p class="h4 mb-4 text-center <?php echo $colorTextContant?>">Новое блюдо</p>
                                    <input class="form-control mb-4 <?php echo $bgColorCard?> <?php echo $colorTextContant?>" name="namePos" id="namePos" type="text" placeholder="Название блюда" value="<?php echo @$data['namePos']?>" required>
                                    <input class="form-control mb-4 <?php echo $bgColorCard?> <?php echo $colorTextContant?>" name="massPos" id="massPos" type="text" placeholder="вес" value="<?php echo @$data['massPos']?>">
                                    <input class="form-control mb-4 <?php echo $bgColorCard?> <?php echo $colorTextContant?>" name="pricePos" id="pricePos" type="text" placeholder="цена " value="<?php echo @$data['prisePos']?>" pattern="^[0-9\s]+$" title="только цифры">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text <?php echo $bgColorCard?> <?php echo $colorTextContant?>" for="inputGroupSelect01">Категория продукта</label>
                                        </div>
                                        <select name="catNamePos" class="browser-default custom-select <?php echo $bgColorCard?> <?php echo $colorTextContant?>" id="inputGroupSelect01">
                                        <?php
                                                $namesCatID = $dbProd->query("SELECT `name_cat`,`id` FROM `categories`");
                                                foreach ($namesCatID as $nameCatID){?>
                                                    <option value="<?php echo $nameCatID['id']?>"><?php echo $nameCatID['name_cat'] ?></option>
                                                <?php }
                                            ?>
                                        </select>
                                    </div>
                                    <button class="btn <?php echo $btnColor?> btn-block my-4" type="submit" name="posRegisterButton">Добавить категорию</button>
                                </form>
                            <div>
                        </div>
                    <?php }
                    if ($_GET['id'] == "3") {?>
                        <div class="card wow slideInLeft <?php echo $bgColorCard?>" >

                            <div class="card-body <?php echo $colorTextContant?>">
                                <div class="card-title <?php echo $colorTextContant?>">
                                    Категории
                                </div>
                                <div class="row">
                                    <?php
                                    $foreachCatsDel = getFullCat();
                                    foreach ($foreachCatsDel as $foreachCatDel){
                                        $idCatDel = $foreachCatDel['id'];
                                        $nameCatDel = $foreachCatDel['name_cat'];?>
                                        <div class="col-12 col-lg-6 text-muted" >
                                            <div class="container-fluid mb-1 border border-light rounded">
                                                <div class="row">
                                                    <div class="col-12 col-md-3 p-2 pl-5 text-left <?php echo $colorTextContant?>">
                                                        <i class="fas fa-cog"> <?php echo $nameCatDel ?></i><br>
                                                    </div>
                                                    <div class="col-12 col-md-6 p-2 pl-5 text-left <?php echo $colorTextContant?>">
                                                        <?php echo "Категория" ?>
                                                    </div>
                                                    <div class="col-12 col-md-3 p-2 pl-5 d-flex justify-content-md-end ">
                                                        <form action="adminSpecification.php?id=3" method="POST">
                                                            <button class="btn btn-danger z-depth-1 m-0 waves-effect btn-sm" type="submit" value="<?php echo $idCatDel?>" name="delete_cat">удалить</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php }; ?>
                                </div>
                            </div>
                        </div>
                        <?php
                            $foreachCatsDelCart = getFullCat();
                            foreach ($foreachCatsDelCart as $foreachCatDelCart){
                                $idCatDelCart = $foreachCatDelCart['id'];
                                $nameCatDelCart = $foreachCatDelCart['name_cat'];
                                $countMenuInCat = getCountMenuForCat($idCatDelCart);
                                if ($countMenuInCat == 0) {
                                }else{
                                ?>
                                <div class="card wow slideInLeft <?php echo $bgColorCard?> mt-4" id="prodDel<?php echo $idCatDelCart?>">
                                    <div class="card-body <?php echo $colorTextContant?>">
                                        <div class="title <?php echo $colorTextContant?>">
                                            <?php echo $nameCatDelCart ?>
                                        </div>
                                        <div class="row">
                                            <?php
                                            $foreachProdForm = getFullOptionsProd($idCatDelCart);
                                            foreach ($foreachProdForm as $foreachProdForm){
                                                $idFormDeleteProd = $foreachProdForm['id'];
                                                $nameDeleteProd = $foreachProdForm['name'];?>
                                                    <div class="col-12 col-lg-4">
                                                        <div class="container-fluid mb-1 border border-light rounded waves-effect">
                                                            <div class="row">
                                                                <div class="col-12 col-md-6 p-2 pl-5 text-left <?php echo $colorTextContant?>">
                                                                    <i class="fas fa-cog"> <?php echo $nameDeleteProd ?></i><br>
                                                                </div>
                                                                <div class="col-12 col-md-6 p-2 pl-5 d-flex justify-content-md-end ">
                                                                    <form action="adminSpecification.php?id=3#prodDel<?php echo $idCatDelCart?>" method="POST">
                                                                        <button class="btn btn-danger z-depth-1 m-0 waves-effect btn-sm" type="submit" value="<?php echo $idFormDeleteProd?>" name="delete_prod">удалить</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                            <?php }; ?>
                                        </div>
                                    </div>
                                </div>
                        <?php } }; ?>

                    <?php }
                    if ($_GET['id'] == "4") {?>
                    <div class="card wow slideInLeft <?php echo $bgColorCard?>">
                        <div class="card-body <?php echo $colorTextContant?>">
                            <div class="container-fluid mb-1 border border-light rounded waves-effect">
                                <div class="row">
                                    <div class="col-12 col-md-3 p-2 pl-5 text-left">
                                        Очистить базу данных блюд
                                    </div>
                                    <div class="col-12 col-md-6 p-2 pl-5 text-left">
                                        Количество записей: <?php echo $idMenu ?>
                                    </div>
                                    <div class="col-12 col-md-3 p-2 pl-5 d-flex justify-content-md-end ">
                                        <?php
                                        if ($foreachTypeUserForUserSetting === "Пользователь" || $name != $foreachNameForLoginForUserSetting) {?>
                                            <form action="adminSpecification.php?id=4" method="POST">
                                                <button class="btn btn-danger z-depth-1 m-0 waves-effect btn-sm" type="submit" name="delete_dbProd_menu">удалить</button>
                                            </form>
                                        <?php }; ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                                if( isset($data['delete_dbProd_menu'])){
                                    $dbProd->query('TRUNCATE TABLE `menu`');
                                };
                            ?>
                        </div>
                    </div>
                    <?php }
                    if ($_GET['id'] == "6") {?>
                        <div class="card wow slideInLeft <?php echo $bgColorCard?>">
                            <div class="card-body <?php echo $colorTextContant?>">
                                <form class="pt-2 pl-5 pr-5 pb-5" action="<?php echo $urlAdminSp?>" method="POST">
                                    <?php if(!empty($message)) { ?>
                                        <div class="alert <?php echo $color ?> alert-dismissible fade show" role="alert">
                                            <?php echo $message; ?>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    <?php } ?>
                                    
                                    <p class="h4 mb-4 text-center <?php echo $colorTextContant?>">Изменить категорию</p>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text <?php echo $bgColorCard?> <?php echo $colorTextContant?>" for="inputGroupSelect01">Категория</label>
                                        </div>
                                        <select name="catID" class="browser-default custom-select <?php echo $bgColorCard?> <?php echo $colorTextContant?>" id="inputGroupSelect01">
                                        <?php
                                                $namesCatID = $dbProd->query("SELECT `name_cat`,`id` FROM `categories`");
                                                foreach ($namesCatID as $nameCatID){?>
                                                    <option value="<?php echo $nameCatID['id']?>"><?php echo $nameCatID['name_cat'] ?></option>
                                                <?php }
                                            ?>
                                        </select>
                                    </div>
                                    <input class="form-control mb-4 <?php echo $bgColorCard?> <?php echo $colorTextContant?>" name="newCatName" id="newNameCat" type="text" placeholder="Новое имя категории" value="<?php echo @$data['newNameCat']?>" required>
                                    <button class="btn <?php echo $btnColor?> btn-block my-4" type="submit" name="catUpdateButton"> Изменить категорию</button>
                                </form>
                            <div>
                        </div>
                    <?php } }?>
            </div>
        </div>
    </div>
</div>
</main>
<!-- Footer -->
<?php require $_SERVER['DOCUMENT_ROOT'].'/manager/generate/footer.php'?>
</body>

</html>