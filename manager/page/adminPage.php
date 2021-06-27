<?php require $_SERVER['DOCUMENT_ROOT'].'/manager/generate/header.php'?>
<div class="container-fluid pt-5">
    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card wow slideInLeft <?php echo $bgColorCard?>">
                <?php
                if ($typeUser === "user") {?>
                    <div class="card-body">
                        <h3 class="text-center text-danger">У вас недостаточно прав</h3>
                    </div>
                    <?php } else{
                ?>
                    <div class="card-body">
                        <div class="card-title p-3">
                            <div class="row">
                                <div class="col-12 text-center <?php echo $colorTextContant?>">Функции администрирования</div>
                            </div>
                        </div>
                        <div class="card-text">
                            <a href="adminSpecification.php?id=1" class="text-muted">
                                <div class="container-fluid mb-1 p-3 border border-light rounded waves-effect <?php echo $colorTextContant?>">
                                    <div class="row">
                                        <div class="col-12">
                                            <i class="fas fa-cog"> Добавить категорию</i><br>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a href="adminSpecification.php?id=2" class="text-muted">
                                <div class="container-fluid mb-1 p-3 border border-light rounded waves-effect <?php echo $colorTextContant?>">
                                    <div class="row">
                                        <div class="col-12">
                                            <i class="fas fa-cog"> Добавить новое блюдо</i><br>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a href="conf.php" class="text-muted">
                                <div class="container-fluid mb-1 p-3 border border-light rounded waves-effect <?php echo $colorTextContant?>">
                                    <div class="row">
                                        <div class="col-12">
                                            <i class="fas fa-cog"> Конфигурирование экранов</i><br>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a href="/manager/page/userSetting.php" class="text-muted">
                                <div class="container-fluid mb-1 p-3 border border-light rounded waves-effect <?php echo $colorTextContant?>">
                                    <div class="row">
                                        <div class="col-12">
                                            <i class="fas fa-cog"> Пользователи</i><br>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a href="adminSpecification.php?id=6" class="text-muted">
                                <div class="container-fluid mb-1 p-3 border border-light rounded waves-effect <?php echo $colorTextContant?>">
                                    <div class="row">
                                        <div class="col-12">
                                            <i class="fas fa-cog"> Изменить имя категории</i><br>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a href="adminSpecification.php?id=3" class="text-muted">
                                <div class="container-fluid mb-1 p-3 border border-light rounded waves-effect <?php echo $colorTextContant?>">
                                    <div class="row">
                                        <div class="col-12">
                                            <i class="fas fa-cog"> Удалить категории или блюда</i><br>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a href="adminSpecification.php?id=4" class="text-muted">
                                <div class="container-fluid mb-1 p-3 border border-light rounded waves-effect <?php echo $colorTextContant?>">
                                    <div class="row">
                                        <div class="col-12">
                                            <i class="fas fa-cog"> Работа с базой данных</i><br>
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
<!-- Footer -->
<?php require $_SERVER['DOCUMENT_ROOT'].'/manager/generate/footer.php'?>
</body>

</html>