<?php require $_SERVER['DOCUMENT_ROOT'].'/manager/generate/head.php';
require $_SERVER['DOCUMENT_ROOT'].'/manager/generate/connect.php';
require $_SERVER['DOCUMENT_ROOT'].'/manager/generate/dbphonesFunctions.php'; ?>
<?php if(!empty($message)) { ?>
    <div style="color:red;"><?php echo $message; ?></div><hr>
<?php } ?>

<body class="grey lighten-3">
    <div class="container wow fadeInUp">
        <form class="p-5 mt-5" action="/manager/authenticate.php" method="POST">
            <p class="h4 mb-4 text-center">Вход</p>
            <input class="form-control mb-4" name="username" id="username" type="text" placeholder="Логин" required>
            <input class="form-control mb-4" name="password" id="password" type="password" placeholder="Пароль" required>
            <div class="d-flex justify-content-between">
            </div>
            <button class="btn btn-indigo btn-block my-4" type="submit">Войти</button>
            <div class="text-center">
                <small>
                    <div class="py-3">© 2021-<?php echo date("Y")?> FOR LLC VECTOR</div>
                </small>
            </div>
        </form>
        <div class="container-fluid p-0">
            <div class=" p-5 row">
            <?php
                $typeUser = "user";
                $menuURL = getScreenSetting();
                foreach ($menuURL as $menu) {?>
                        <a href="/index.php?typePage=menu&screenNumber=<?php echo $menu['id']?>" class="text-muted col-12 col-lg-4 pr-2 pl-2" target="_blank">
                            <div class="container-fluid mb-1 p-3 border border-light rounded waves-effect <?php echo $colorTextContant?>">
                                <div class="row">
                                    <div class="col-12">
                                        <i class="fas fa-cog"> <?php echo "Экран ".$menu['number']. " " . $menu['name']?></i><br>
                                    </div>
                                </div>
                            </div>
                        </a>
                    <?php 
                };
                $dbProd->close();
                ?>
            </div>
        </div>
    </div>
</body>
</html>
