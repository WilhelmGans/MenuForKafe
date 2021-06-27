<?php
    require  $_SERVER['DOCUMENT_ROOT'].'/generate/header.php';
    $action = getPhoneById($_GET['id']);
    
    $idPhonePage = $action['id'];
    $numberPhonePage = $action['number'];
    $namePhonePage = $action['name'];
    $ipPhonePage = $action['ip'];
    $macPhonePage = $action['mac'];
    $typePhonePhonePage = $action['type_phone'];
    $dependsPhonePage = $action['depends'];
    $checkPingPhonePage = $action['check_ping'];
    $floorPhonePage = $action['floor'];
    $blockPhonePage = $action['block'];
    $portPatchPhonePage = $action['port_pp'];
    $url = $_SERVER['REQUEST_URI'];
    $data = $_POST;
    if( isset($data['phoneUpdateButton']) ){
        $checkPing = '0';
        $userFormPhone = $data['user'];
        $userAccessFormPhone = $data['accessUser'];
        $numberForm = $data['number'];
        $namePhoneForm = $data['namePhone'];
        $ipForm = $data['ip'];
        $blockForm = $data['blockPhone'];
        $floorForm = $data['floorPhone'];
        $portPanelForm = $data['portPatchPanel'];
        $errors = array();
        if( trim($data['number']) == ''){
            $errors[]= 'Введите номер';
        }
        if( trim($data['ip']) == ''){
            $errors[]= 'Введите ip';
        }
        if( trim($data['portPatchPanel'] == '')){
            $errors[]= 'Введите порт';
        }
        if( trim($data['namePhone'] == '')){
            $errors[]= 'Введите имя';
        }
        if( trim($data['floorPhone'] == '')){
            $errors[]= 'Введите этаж';
        }
        if( trim($data['blockPhone'] == '')){
            $errors[]= 'Введите корпус';
        }
        if (empty($errors)) {
            /* if ($stmt = $dbphones->prepare('SELECT `ip` FROM phones WHERE `ip` = ?')) {
            $stmt->bind_param('s', $data['ip']);//подготовка параметров
            $stmt->execute();// отправка запроса
            $stmt->store_result(); //сохранение запроса на клиенте
            

            if ($stmt->num_rows > 0) {
                //$arrayPhonesNumberIPCheck = $dbphones->query("SELECT `number`, `ip` FROM phones WHERE `ip` = '$ipForm' ");
                $message = 'Такой ip уже есть';
                $color = 'alert-danger';
            }else {
                $dbphones->query("UPDATE `phones` SET `name`= '$namePhoneForm' ,`ip`='$ipForm', `port_pp`='$portPanelForm' WHERE `id` = $idPhonePage ");
                $dbphones->query("INSERT INTO `actions` (`id`, `type`, `user`, `user_level`, `theme`, `text`, `subject`,`date`) VALUES (NULL, 'setting phone', '$userFormPhone', '$userAccessFormPhone', 'Изменение параметров телефона', 'Параметры у телефона номером: $numberForm изменены успешно', '$numberForm', '$today')");
                $message = 'Данные телефона '.$data['number'].' изменены!';
                $color = 'alert-success';
                $data = "";
                exit("<meta http-equiv='refresh' content='0; url= $url'>");
            }
            } else {
                $message = 'Ошибка отправки формы';
                $color = 'alert-danger';
            }*/
            if ($stmt = $dbphones->prepare('SELECT `ip` FROM phones WHERE `ip` = ?')) {
                $stmt->bind_param('s', $data['ip']);//подготовка параметров
                $stmt->execute();// отправка запроса
                $stmt->store_result(); //сохранение запроса на клиенте
                $dbphones->query("UPDATE `phones` SET `name`= '$namePhoneForm' ,`ip`='$ipForm', `port_pp`='$portPanelForm', `block` = '$blockForm', `floor` = '$floorForm' WHERE `id` = $idPhonePage ");
                $dbphones->query("INSERT INTO `actions` (`id`, `type`, `user`, `user_level`, `theme`, `text`, `subject`,`date`) VALUES (NULL, 'setting phone', '$userFormPhone', '$userAccessFormPhone', 'Изменение параметров телефона', 'Параметры у телефона номером: $numberForm изменены успешно', '$numberForm', '$today')");
                $message = 'Данные телефона '.$data['number'].' изменены!';
                $color = 'alert-success';
                $data = "";
                exit("<meta http-equiv='refresh' content='0; url= $url'>");
                } else {
                    $message = 'Ошибка отправки формы';
                    $color = 'alert-danger';
                }
        }else {
            $message = array_shift($errors);
            $color = 'alert-danger';
        }
    };
    if( isset($data['phoneDeleteButton']) ){
        $userFormPhone = $data['user'];
        $userAccessFormPhone = $data['accessUser'];
        $idPhoneDelete = $data['idPhoneDelete'];
        $numberForm = $data['number'];
        $errors = array();
        if( trim($data['idPhoneDelete']) == ''){
            $errors[]= 'Введите номер';
        }
        if (empty($errors)) {
            $dbphones->query("DELETE FROM `phones` WHERE `id` = '$idPhoneDelete'");
            $dbphones->query("INSERT INTO `actions` (`id`, `type`, `user`, `user_level`, `theme`, `text`, `subject`,`date`) VALUES (NULL, 'setting phone', '$userFormPhone', '$userAccessFormPhone', 'Изменение параметров телефона', 'Номер телефона: $numberForm удален успешно', '$numberForm','$today')");
            $message = 'Номер '.$data['number'].' удален!';
            $color = 'alert-success';
            $data = "";
        }else {
            $message = array_shift($errors);
            $color = 'alert-danger';
        }
    };
    ?>
        <div class="container-fluid pt-5">
            <div class="row">
                <div class="col-lg-9 mb-4">
                    <div class="card wow slideInLeft <?php echo $bgColorCard?>">
                    <?php
                    if ($typeUser === "user") {?>
                        <div class="card-body">
                            <h3 class="text-center text-danger">У вас недостаточно прав</h3>
                        </div>
                        <?php } else{
                    ?>
                        <div class="card-body">
                            <div class="card-title p-3 text-center <?php echo $colorTextContant?>">
                                <div class="col-12 h-3 pb-1 h4 "><span>Телефон: <?php echo $numberPhonePage?></span></div>
                                <div class="row">
                                    <div class="col-12 pl-5">
                                        <div class="row">
                                            <?php 
                                                if ($typePhonePhonePage == "primary") {?>
                                                    <span class="pl-1 h6 <?php echo $colorTextContant?>">Зависимые:  </span>
                                                    <?php
                                                        $dependsPhonesPageSetting = $dbphones->query("SELECT `id`, `number` FROM `phones` WHERE `depends` = '$numberPhonePage'");
                                                        foreach ($dependsPhonesPageSetting as $dependsPhonePageSetting) {?>
                                                            <a class="ml-1 <?php echo $logoColorText?>" href="phoneSetting.php?id=<?php echo $dependsPhonePageSetting['id']?>"><?php echo "".$dependsPhonePageSetting['number']?></a>
                                                        <?php }
                                                }else{ ?>
                                                    <span class="pl-1 h6 <?php echo $colorTextContant?>">Основной:  </span>
                                                    <?php
                                                        $dependsPhonesPageSetting = $dbphones->query("SELECT `id`, `number` FROM `phones` WHERE `number` = '$dependsPhonePage'");
                                                        foreach ($dependsPhonesPageSetting as $dependsPhonePageSetting) {?>
                                                            <a class="ml-1 <?php echo $logoColorText?>" href="phoneSetting.php?id=<?php echo $dependsPhonePageSetting['id']?>"><?php echo "".$dependsPhonePageSetting['number']?></a>
                                                        <?php }
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-text <?php echo $colorTextContant?>">
                                <div class="row">
                                    <div class="col-12 col-lg-8">
                                        <form class="pl-5 pr-5 pb-2" action="phoneSetting.php?id=<?php echo $idPhonePage?>" method="POST">
                                            <?php if(!empty($message)) { ?>
                                                <div class="alert <?php echo $color ?> alert-dismissible fade show" role="alert">
                                                    <?php echo $message; ?>
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            <?php } ?>
                                            <p class="h5 mb-4 text-center <?php echo $colorTextContant?>">Параметры телефона</p>

                                            <label for="ipRegister">IP телефона</label>
                                            <input class="form-control mb-4 <?php echo $bgColorCard?> <?php echo $colorTextContant?>" name="ip" id="ipRegister" type="text" placeholder="Введите ip" value="<?php echo $ipPhonePage ?>" required>

                                            <label for="macRegister">MAC телефона</label>
                                            <input class="form-control mb-4 <?php echo $bgColorCard?> <?php echo $colorTextContant?>" name="mac" id="macRegister" type="text" placeholder="Введите MAC" value="<?php echo $macPhonePage ?>" required disabled>

                                            <label for="portRegister">Порт на PatchPanel телефона</label>
                                            <input class="form-control mb-4 <?php echo $bgColorCard?> <?php echo $colorTextContant?>" name="portPatchPanel" id="portRegister" type="text" placeholder="Введите порт на patch panel" value="<?php echo $portPatchPhonePage ?>" required>
                                            
                                            <label for="nameRegister">Место размещения телефона</label>
                                            <input class="form-control mb-4 <?php echo $bgColorCard?> <?php echo $colorTextContant?>" name="namePhone" id="nameRegister" type="text" placeholder="Введите место расположения телефона" value="<?php echo $namePhonePage?>" required>
                                            
                                            <label for="nameRegister">Этаж</label>
                                            <input class="form-control mb-4 <?php echo $bgColorCard?> <?php echo $colorTextContant?>" name="floorPhone" id="floorRegister" type="text" placeholder="Введите этаж расположения телефона" value="<?php echo $floorPhonePage?>" required>
                                            
                                            <label for="nameRegister">Корпус</label>
                                            <input class="form-control mb-4 <?php echo $bgColorCard?> <?php echo $colorTextContant?>" name="blockPhone" id="blockRegister" type="text" placeholder="Введите корпус расположения телефона" value="<?php echo $blockPhonePage?>" required>
                                            
                                            <input class="form-control mb-4 none <?php echo $bgColorCard?> <?php echo $colorTextContant?>" name="number" id="numberRegister2" type="text" placeholder="Введите номер телефона" value="<?php echo $numberPhonePage ?>" required>
                                            <input  class="form-control mt-4 mb-4 none <?php echo $bgColorCard?> <?php echo $colorTextContant?>" name="user" type="text" value="<?php echo $login?>">
                                            <input  class="form-control mt-4 mb-4 none <?php echo $bgColorCard?> <?php echo $colorTextContant?>" name="accessUser" type="text" value="<?php echo $typeUser?>">
                                            <button class="btn <?php echo $btnColor?> btn-block my-4 " type="submit" name="phoneUpdateButton">Изменить параметры телефона</button>
                                        </form>
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <p class="h5 mb-4 text-center <?php echo $colorTextContant?>">Управление телефоном</p>
                                        <div class="d-flex flex-column justify-content-center m-lg-5">
                                            <button type="button" class="btn btn-success mt-2" id="call"  data-toggle="modal" data-target="#callPhone" value="1">Звонок на телефон</button>
                                            <button type="button" class="btn btn-success mt-2" id="volup" onclick="getData('0','VOLUME_UP')" value="0">Увеличить громкость</button>
                                            <button type="button" class="btn btn-success mt-2" id="dndoff" onclick="getData('0','DNDOff')" value="0">Выключить режим «Не беспокоить»</button>
                                            <button type="button" class="btn btn-danger mt-5" id="reboot" onclick="getData('0','Reboot')" value="0">Перезагрузка телефона</button>
                                            <button type="button" class="btn btn-danger mt-2" data-toggle="modal" data-target="#deletePhone">удалить телефон</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php }?>
                    </div>
                </div>
                <?php require $_SERVER['DOCUMENT_ROOT'].'/generate/generatePieChartAndErrorPhone.php'?>
            </div>
            <?php require $_SERVER['DOCUMENT_ROOT'].'/generate/floor.php'?>
        </div>
    </main>
    <div class="modal fade" id="deletePhone" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content p-2 <?php echo $bgColorCard?>">
                <div class="modal-header text-center <?php echo $logoColorText?>">
                    <h4 class="modal-title w-100 font-weight-bold">Удаление телефона</h4>
                    <button type="button" class="close <?php echo $colorTextContant?>" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="phoneSetting.php?id=<?php echo $idPhonePage?>" method="POST">
                    <p class = "text-center <?php echo $colorTextContant?> pt-1">Вы уверены, что хотите удалить запись в базе данных о телефоне <?php echo $numberPhonePage?> ?</p>
                    <input class="form-control mb-4 none <?php echo $bgColorCard?> <?php echo $colorTextContant?>" name="idPhoneDelete" type="text" value="<?php echo $idPhonePage ?>">
                    <input  class="form-control mt-4 mb-4 none <?php echo $bgColorCard?> <?php echo $colorTextContant?>" name="user" type="text" value="<?php echo $login?>">
                    <input  class="form-control mt-4 mb-4 none <?php echo $bgColorCard?> <?php echo $colorTextContant?>" name="accessUser" type="text" value="<?php echo $typeUser?>">
                    <input class="form-control mb-4 none <?php echo $bgColorCard?> <?php echo $colorTextContant?>" name="number" id="numberRegister1" type="text" placeholder="Введите номер телефона" value="<?php echo $numberPhonePage ?>" required>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal">Нет</button>
                        <button class="btn btn-danger" type="submit" name="phoneDeleteButton">Да</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="callPhone" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content p-2 <?php echo $bgColorCard?>">
                <div class="modal-header text-center <?php echo $logoColorText?>">
                    <h4 class="modal-title w-100 font-weight-bold">Выбор линии и номера для звонка на телефон</h4>
                    <button type="button" class="close <?php echo $colorTextContant?>" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="m-3">
                    <p class = "text-left <?php echo $colorTextContant?> pt-1">Введите линию для звонка с номера  <?php echo $numberPhonePage?></p>
                    <input class="form-control mb-4 <?php echo $bgColorCard?> <?php echo $colorTextContant?>" name="lineCall" type="text" id="lineCall" value="1" require>
                    <p class = "text-left <?php echo $colorTextContant?> pt-1">Введите номер для звонка с номера  <?php echo $numberPhonePage?></p>
                    <input class="form-control mb-4 <?php echo $bgColorCard?> <?php echo $colorTextContant?>" name="numberCall" type="text" value="" placeholder="Например 401" id="nunberCall" require>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn <?php echo $btnColor?>" data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-success" data-dismiss="modal" onclick="getData('1','F_HANDFREE')">Позвонить</button>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="/resources/js/array.js" defer></script>
    <script type="text/javascript" src="/resources/js/processing.js" defer></script>
<?php require $_SERVER['DOCUMENT_ROOT'].'/generate/footer.php';?>
<?php require $_SERVER['DOCUMENT_ROOT'].'/generate/modal.php' ?>
</body>

</html>