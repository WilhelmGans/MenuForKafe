<?php
    require $_SERVER['DOCUMENT_ROOT'].'/manager/generate/connect.php';
    require $_SERVER['DOCUMENT_ROOT'].'/manager/generate/dbphonesFunctions.php';
    session_start();
    if (!isset($_SESSION['loggedin'])) {
        header('Location: /manager/index.php');
        exit;
    };
    require $_SERVER['DOCUMENT_ROOT'].'/manager/generate/array.php';
    require $_SERVER['DOCUMENT_ROOT'].'/manager/generate/head.php';
    $stmt = $dbProd->prepare('SELECT `id`,`type_user`, `name`, `username`,`colorinterface`, `img_url` FROM accounts WHERE `id` = ?');
    $stmt->bind_param('i', $_SESSION['id']);
    $stmt->execute();
    $stmt->bind_result($id, $typeUser, $name, $login, $colorinterface, $urlImg);
    $stmt->fetch();
    $stmt->close();
    $today = date("F j, Y, g:i a");

    if ($typeUser === "1") {
        $user = "Администратор";
        $typeUser = "admin";
    }elseif ($typeUser === "0") {
        $user = "Пользователь";
        $typeUser = "user";
    };
    $linkNavigate = $_SERVER['REQUEST_URI'];
    $linkNavigate = explode('.', $linkNavigate);
    $linkNavigate = $linkNavigate[0];
    if ($colorinterface == "dark") {
        $bgColor = "unique-color-dark";
        $bgColorNavBar = "navbar-dark mdb-color darken-3";
        $bgColorCard = "mdb-color darken-3";//#2e3951
        $foterColor = "mdb-color darken-3";
        $orangColor = "orange darken-3";
        $orangColorBorder = 'style="border-color: #ef6c00 !important"';
        $btnColor ="btn-deep-orange";
        $logoColorText = "orange-text";
        $colorTextContant = "text-light";
        $leftNavBarColor = 'style="background-color: #1c2a48 !important"';
        $btnOutlineColor = "btn-outline-orange";
        $ColorPieChart = "white";
    }elseif ($colorinterface == "white") {
        $bgColor = "grey";
        $bgColorNavBar = "navbar-light";
        $logoColorText = "indigo-text";
        $orangColorBorder = '';
        $btnColor ="btn-indigo";
        $btnOutlineColor = "btn-outline-indigo";
        $colorTextContant = "text-muted";
        $foterColor = "indigo";
        $orangColor = "indigo";
        $ColorPieChart = "black";
    }
?>

    <body class="<?php echo $bgColor?> lighten-3">
        <header>
            <nav class="navbar fixed-top navbar-expand-lg <?php echo $bgColorNavBar?> scrolling-navbar">
                <div class="container-fluid">
                    <a href="/manager/homePage.php" class="navbar-brand waves-effect <?php echo $logoColorText?>"><strong>Kafe</strong></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse" id="navbarContent">
                        <ul class="navbar-nav mr-auto fo">
                            <?php
                            for ($nav=0; $nav < count($navbar); $nav++) {
                                if ($typeUser === "user") {
                                    if ($typeUser === $navbarAccess[$nav]) {?>
                                    <li class="nav-item <active>">
                                        <a href="/manager/<?php echo $navbarLink[$nav]?>" class="nav-link waves-effect">
                                            <?php echo $navbar[$nav]?>
                                        </a>
                                    </li>
                                    <?php }
                                }elseif($typeUser === "admin"){?>
                                    <li class="nav-item <active>">
                                        <a href="/manager/<?php echo $navbarLink[$nav]?>" class="nav-link waves-effect">
                                            <?php echo $navbar[$nav]?>
                                        </a>
                                    </li>
                                    <?php };
                            };
                            $menuURL = getScreenSetting();
                            $stop = 1;
                            foreach ($menuURL as $menu) {
                                if ($menu['fast_access'] == "1" && $stop <= 6) {
                                    $stop+=1;
                                    ?>
                                    <li class="nav-item <active>">
                                        <a href="/index.php?typePage=menu&screenNumber=<?php echo $menu['id']?>" class="nav-link waves-effect" target="_blank">
                                            <?php echo "Экран ".$menu['number']. " " . $menu['name']?>
                                        </a>
                                    </li>
                                <?php  }
                            }
                            ?>
                            
                        </ul>
                        <ul class="navbar-nav nav-flex-icons">
                            <li class="nav-item mr-2 dropdown">
                                <a href="#" class="nav-link border-light dropdown-toggle rounded waves-effect" id="navbarDropdownMenuLinkAccount" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <i class="fa fa-user"></i>
                                    <span class="clearfix d-none d-sm-inline-block"><?php echo $name?></span>
                                </a>
                                <div class="dropdown-menu <?php echo $bgColorCard?>" aria-labelledby="navbarDropdownMenuLinkAccount">
                                    <a href="/manager/profile.php" class="dropdown-item waves-effect waves-light <?php echo $colorTextContant?>">Настройки</a>
                                </div>
                            </li>
                            <li class="nav-item mr-2">
                                <a href="/manager/logout.php" class="nav-link border-light rounded waves-effect">
                                    <i class="fas fa-sign-out-alt"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="sidebar-fixed position-fixed <?php echo $logoColorText?> " <?php echo $leftNavBarColor?> >
                <div class="sidenav-header d-flex align-items-center justify-content-center mt-4">
                    <!-- User Info-->
                    <div class="sidenav-header-inner text-center <?php echo $logoColorText?>" >
                        <div class="rounded-img mb-3">
                            <img src="/manager<?php echo $urlImg?>" alt="person" class="img-fluid rounded-circle">
                        </div>
                        <div class="h5">
                            <?php echo $name?>
                        </div><span><?php echo $user?></span>
                    </div>
                </div>
                <?php //echo $_SESSION['message']  // отладка загрузки файла?>
            </div>

        </header>
        <main class="pt-5 max-lg-5">