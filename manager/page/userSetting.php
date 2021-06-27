<?php
    require  $_SERVER['DOCUMENT_ROOT'].'/manager/generate/header.php';
    if( isset($_POST['delete_user']) ){
        $loginButton = $_POST['delete_user'];
        $dbProd->query("DELETE FROM `accounts` WHERE `username` = '$loginButton'");
    };?>
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
                        <a href="register.php" class="<?php echo $logoColorText?>">
                            <div class="container-fluid mb-4 border-bottom border-light waves-effect">
                                <div class="row">
                                    <div class="col-md-12 col-lg-8 p-2 text-left">
                                        <i class="fas fa-user-plus"> Создать пользователя</i><br>
                                    </div>
                                    <div class="col-md-12 col-lg-4 p-2 text-left ">
                                    </div>
                                </div>
                            </div>
                        </a>
                        <?php
                        $accounts = getUser();
                        foreach ($accounts as $account){
                            $foreachIdForUserSetting = $account['id'];
                            $foreachLoginForUserSetting = $account['username'];
                            $foreachNameForLoginForUserSetting = $account['name'];
                            $foreachTypeUserForUserSetting = $account['type_user'];
                            if ($foreachTypeUserForUserSetting === "1") {
                                $foreachTypeUserForUserSetting = "Администратор";
                            }elseif ($foreachTypeUserForUserSetting === "0") {
                                $foreachTypeUserForUserSetting = "Пользователь";
                            };
                            ?>
                            <a href="user.php?id=<?php echo $foreachIdForUserSetting?>" class="<?php echo $colorTextContant?>">
                                <div class="container-fluid mb-1 border border-light rounded waves-effect">
                                    <div class="row">
                                        <div class="col-12 col-md-3 p-2 pl-5 text-left">
                                            <i class="fas fa-users-cog"> <?php echo $foreachNameForLoginForUserSetting ?></i><br>
                                        </div>
                                        <div class="col-12 col-md-6 p-2 pl-5 text-left "> Права:
                                            <?php echo $foreachTypeUserForUserSetting ?>
                                        </div>
                                        <div class="col-12 col-md-3 p-2 pl-5 d-flex justify-content-md-end ">
                                            <?php
                                            if ($foreachTypeUserForUserSetting === "Пользователь" || $id != $foreachIdForUserSetting) {?>
                                                <form action="userSetting.php" method="POST">
                                                    <button class="btn btn-danger z-depth-1 m-0 waves-effect btn-sm" type="submit" value="<?php echo $foreachLoginForUserSetting ?>" name="delete_user">удалить</button>
                                                </form>
                                            <?php }; ?>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <?php }; ?>
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