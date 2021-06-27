<?php require  $_SERVER['DOCUMENT_ROOT'].'/manager/generate/header.php';
    $data = $_POST;
    $actionLogin= $data['login'];
    if( isset($data['do_signup']) ){
        $errors = array();
        if( trim($data['login']) == ''){
            $errors[]= 'Введите логин!';
        }
        if( trim($data['username']) == ''){
            $errors[]= 'Введите имя и фамилию!';
        }
        if( $data['password'] == '' || strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5){
            $errors[]= 'Проверьте пароль!';
        }
        if( $data['password_2'] != $data['password']){
            $errors[]= 'Пароли не совпадают!';
        }
        if (empty($errors)) {
            if ($stmt = $dbProd->prepare('SELECT id, password FROM accounts WHERE username = ?')) {
                $stmt->bind_param('s', $data['login']);
                $stmt->execute();
                $stmt->store_result();
                if ($stmt->num_rows > 0) {
                    $message = 'Пользователь с таким логином уже существует';
                    $color = 'alert-danger';
                } else {
                    if ($stmt = $dbProd->prepare('INSERT INTO accounts (`username`, `name`, `password`, `type_user`) VALUES (?, ?, ?, ?)')) {
                        $colorInterfaceRegister = 'white';
                        $urlImgRegister = '/resources/images/icon-admin.png';
                        $password = password_hash($data['password'], PASSWORD_DEFAULT);
                        $stmt->bind_param('ssss', $data['login'], $data['username'], $password, $data['accessUser']);
                        $stmt->execute();
                        $message = 'Пользователь '.$data['login'].' создан!';
                        $color = 'alert-success';
                        $data = "";
                    } else {
                        $message = 'Ошибка отправки формы';
                        $color = 'alert-danger';
                    }
                }
                //$stmt->close();
            } else {
                $message = 'Ошибка отправки формы';
                $color = 'alert-danger';
            }

        }else {
            $message = array_shift($errors);
            $color = 'alert-danger';
        }
    };
?>
        <div class="container-fluid pt-5">
            <div class="row">
                <div class="col-lg-12 mb-4">
                    <div class="card wow slideInLeft <?php echo $bgColorCard?>">
                        <?php
                            if ($typeUser === "user") {?>
                                <div class="card-body <?php echo $bgColorCard?>">
                                    <h3 class="text-center text-danger">У вас недостаточно прав</h3>
                                </div>
                                <?php } else{
                        ?>
                        <div class="card-body">
                            <form class="p-5" action="register.php" method="POST" class="<?php echo $colorTextContant?>">
                                <?php if(!empty($message)) { ?>
                                    <div class="alert <?php echo $color ?> alert-dismissible fade show" role="alert">
                                        <?php echo $message; ?>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                <?php } ?>
                                <p class="h4 mb-4 text-center <?php echo $colorTextContant?>">Новый пользователь</p>
                                <input class="form-control mb-4 <?php echo $bgColorCard?> <?php echo $colorTextContant?>" name="login" id="loginRegister" type="text" placeholder="Логин" value="<?php echo @$data['login']?>" required>
                                <input class="form-control mb-4 <?php echo $bgColorCard?> <?php echo $colorTextContant?>" name="username" id="usernameRegister" type="text" placeholder="Имя и фамилия" value="<?php echo @$data['username']?>" required>
                                <input class="form-control mb-4 <?php echo $bgColorCard?> <?php echo $colorTextContant?>" name="password" id="passworRegister" type="password" placeholder="Пароль не менее 5 символов и не более 20" value="<?php echo @$data['password']?>" required>
                                <input class="form-control mb-4 <?php echo $bgColorCard?> <?php echo $colorTextContant?>" name="password_2" id="password_2Register" type="password" placeholder="Пароль ещё раз" value="<?php echo @$data['password_2']?>" required>
                                <div class="d-flex justify-content-start">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" id="accessUser1" name="accessUser" value="0" checked>
                                        <label class="custom-control-label <?php echo $colorTextContant?>" for="accessUser1">Пользователь</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" id="accessUser2" name="accessUser" value="1">
                                        <label class="custom-control-label <?php echo $colorTextContant?>" for="accessUser2">Администратор</label>
                                    </div>
                                </div>
                                <button class="btn <?php echo $btnColor?> btn-block my-4" type="submit" name="do_signup">Создать</button>
                            </form>
                        </div>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php require $_SERVER['DOCUMENT_ROOT'].'/manager/generate/footer.php'?>
</body>

</html>