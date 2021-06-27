<?php
    session_start();
    require $_SERVER['DOCUMENT_ROOT'].'/manager/generate/connect.php';

    if (!isset($_POST['username'], $_POST['password'])) {
        exit('Пожалуйста, заполните поля для имени пользователя и пароля!');
    };
    if ($stmt = $dbProd->prepare('SELECT id, password FROM accounts WHERE username = ?')) {
        $stmt->bind_param('s', $_POST['username']);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $password);
            $stmt->fetch();
            if (password_verify($_POST['password'], $password)) {
                $_SESSION['loggedin'] = TRUE;
                $_SESSION['name'] = $_POST['username'];
                $_SESSION['id'] = $id;
                header('Location: /manager/homePage.php');
            } else {
                // Incorrect password
                //echo '<div style="color:red;">'."Пароль введен не верный".'</div><hr>';
                $errorName = "пароль";
            }
        } else {
            // Incorrect username
            //echo '<div style="color:red;">'."Логин введен не верный".'</div><hr>';
            $errorName = "логин";
        }
        $stmt->close();
    };
?>

<!DOCTYPE html>
<html lang="en">
    <?php 
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    ?>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <!--<meta http-equiv="refresh" content="20">-->
        <title>IP Phone Control</title>
        <!-- icon -->
        <link rel="icon" href="resources/images/icon.ico" type="image/x-icon">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="libs/css/use.fontawesome.com.css">
        <!-- Google Fonts Roboto -->
        <link rel="stylesheet" href="libs/css/fonts.googleapis.com.css">
        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="libs/css/bootstrap.min.css">
        <!-- Material Design Bootstrap -->
        <link rel="stylesheet" href="libs/css/mdb.min.css">

        <!-- jQuery -->
        <script type="text/javascript" src="libs/js/jquery.min.js"></script>
        <!-- Bootstrap tooltips -->
        <script type="text/javascript" src="libs/js/popper.min.js" defer></script>
        <!-- Bootstrap core JavaScript -->
        <script type="text/javascript" src="libs/js/bootstrap.min.js" defer></script>
        <!-- MDB core JavaScript -->
        <script type="text/javascript" src="libs/js/mdb.min.js" defer></script>

        <script type="text/javascript" src="libs/js/sweetAlert.min.js" defer></script>

        <script type="text/javascript" src="libs/src/js/vendor/free/chart.js"></script>
        <style>
            .fa-exclamation-triangle{

                text-align: center;
                font-size: 7em;
                color: red;
            }
            .btn{
                border-radius: 5px;
            }
        </style>
    </head>
    <body class="grey lighten-3">
        <div class="container border rounded shadow-sm text-center p-3 mt-5 white">
            <i class="fas fa-exclamation-triangle pb-2"></i>
            <h3 class="text-center text-muted text-uppercase ">Ошибка авторизации</h3>
            <h4>Вы ввели неверный <?php echo $errorName ?>.</h4>
            <div class="container-fluid">
                <h6><a href="/index.php" class="btn btn-danger">Вернуться на страницу авторизации</a></h6>
            </div>
            
        </div>
        <script type="text/javascript">
            setTimeout(function(){
                window.location.href = '/index.php';
            }, 2000);
        </script>
    </body>
</html>