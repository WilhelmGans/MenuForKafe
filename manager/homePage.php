<?php require $_SERVER['DOCUMENT_ROOT'].'/manager/generate/header.php';
$data = $_POST;
    if (isset($data['update_menu'])) {
        if (isset($data['checkVisible'])) {
            $checkVisible = "yes";
        }else{
            $checkVisible = "no";
        }

        if ($stmt = $dbProd->prepare('UPDATE `menu` SET `id_cat` = ?, `name` = ?, `mass` = ?, `price` = ?, `visible` = ? WHERE `menu`.`id` = ?')) {
            $stmt->bind_param('ssssss', $data['catNamePos'],$data['namePos'],$data['massPos'], $data['pricePos'], $checkVisible, $data['update_menu']);
            $stmt->execute();
            $message = 'Блюдо '.$data['namePos'].' добавлено!';
            $color = 'alert-success';
            $data = "";
        } else {
            $message = 'Ошибка отправки формы';
            $color = 'alert-danger';
        }
    }
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
            <div class="card mb-4 <?php echo $bgColorCard?>">
                <div class="card-body">
                    <div class="card-title text-center h5 <?php echo $colorTextContant?>">
                        Доступные действия
                    </div>
                </div>
            </div>
            <div class="card mb-3 <?php echo $bgColorCard?>">
                <div class="card-body">
                    <div class="card-title <?php echo $colorTextContant?>">
                    </div>
                    <div class="card-text">
                        <div class="row">
                            <a href="/manager/page/adminSpecification.php?id=1" class="text-muted col-12 col-lg-4 pr-2 pl-2">
                                <div class="container-fluid mb-1 p-3 border border-light rounded waves-effect <?php echo $colorTextContant?>">
                                    <div class="row">
                                        <div class="col-12">
                                            <i class="fas fa-cog"> Добавить категорию</i><br>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a href="/manager/page/adminSpecification.php?id=2" class="text-muted col-12 col-lg-4 pr-2 pl-2"    >
                                <div class="container-fluid mb-1 p-3 border border-light rounded waves-effect <?php echo $colorTextContant?>">
                                    <div class="row">
                                        <div class="col-12">
                                            <i class="fas fa-cog"> Добавить новое блюдо</i><br>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a href="/manager/page/conf.php" class="text-muted col-12 col-lg-4 pr-2 pl-2">
                                <div class="container-fluid mb-1 p-3 border border-light rounded waves-effect <?php echo $colorTextContant?>">
                                    <div class="row">
                                        <div class="col-12">
                                            <i class="fas fa-cog">  Конфигурирование экранов</i><br>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
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
                    <div class="card mb-3 <?php echo $bgColorCard?>" id="cat<?php echo $idCatDelCart?>">
                        <div class="card-body">
                            <div class="card-title text-center text-danger <?php echo $bgColorCard?>">
                            <h5>Категория <?php echo $nameCatDelCart?></h5>
                            </div>
                            <div class="row">
                                <?php
                                $foreachProdForm = getFullOptionsProd($idCatDelCart);
                                foreach ($foreachProdForm as $foreachProdForm){
                                    $idFormDeleteProd = $foreachProdForm['id'];
                                    $nameDeleteProd = $foreachProdForm['name'];
                                    if ($foreachProdForm['visible'] == "yes") {
                                        $checkBoxchecked = "checked";
                                    }else{
                                        $checkBoxchecked = "";
                                    }
                                    ?>
                                        <div class="col-12 col-lg-6 text-muted p-2" id="prod<?php echo $foreachProdForm['id'] ?>" >
                                            <div class="container-fluid mb-1 border border-light rounded">
                                                <div class="align-middle">
                                                    <form action="homePage.php#prod<?php echo $foreachProdForm['id'] ?>" class="row" method="POST">
                                                        <div class="col-12 col-xl-6 pt-4 text-left <?php echo $colorTextContant?>">
                                                            <label class="<?php echo $bgColorCard?> <?php echo $colorTextContant?>" for="namePos<?php echo $idFormDeleteProd?>">Название блюда</label>
                                                            <input class="form-control mb-4 <?php echo $bgColorCard?> <?php echo $colorTextContant?>" name="namePos" id="namePos<?php echo $idFormDeleteProd?>" type="text" placeholder="Название блюда" value="<?php echo htmlspecialchars($nameDeleteProd)?>" required>
                                                            <label class="<?php echo $bgColorCard?> <?php echo $colorTextContant?>" for="inputGroupSelect01">Категория продукта</label>
                                                            <select name="catNamePos" class="browser-default custom-select <?php echo $bgColorCard?> <?php echo htmlspecialchars($colorTextContant)?>" id="inputGroupSelect01">
                                                                <option value="<?php echo $idCatDelCart?>"><?php echo $nameCatDelCart ?></option>
                                                                <?php
                                                                $namesCatID = $dbProd->query("SELECT `name_cat`,`id` FROM `categories` WHERE id != $idCatDelCart");
                                                                foreach ($namesCatID as $nameCatID){?>
                                                                    <option value="<?php echo $nameCatID['id']?>"><?php echo $nameCatID['name_cat'] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" name="checkVisible" id="defaultUnchecked<?php echo $idFormDeleteProd?>" <?php echo $checkBoxchecked?>>
                                                                <label class="custom-control-label" for="defaultUnchecked<?php echo $idFormDeleteProd?>">Показывать</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-xl-6 pt-4 text-left <?php echo $colorTextContant?>">
                                                            <label class="<?php echo $bgColorCard?> <?php echo $colorTextContant?>" for="pricePos<?php echo $idFormDeleteProd?>">Цена</label>
                                                            <input class="form-control mb-4 <?php echo $bgColorCard?> <?php echo $colorTextContant?>" name="pricePos" id="pricePos<?php echo $idFormDeleteProd?>" type="text" placeholder="цена " value="<?php echo htmlspecialchars($foreachProdForm['price'])?>" pattern="^[0-9\s]+$" title="только цифры">
                                                            <label class="<?php echo $bgColorCard?> <?php echo $colorTextContant?>" for="massPos<?php echo $idFormDeleteProd?>">Вес</label>
                                                            <input class="form-control mb-4 <?php echo $bgColorCard?> <?php echo $colorTextContant?>" name="massPos" id="massPos<?php echo $idFormDeleteProd?>" type="text" placeholder="вес" value="<?php echo htmlspecialchars($foreachProdForm['mass'])?>">
                                                            <button class="btn btn-success z-depth-1 m-0 waves-effect btn-sm mb-3 col-12" type="submit" value="<?php echo $idFormDeleteProd?>" name="update_menu">Обновить</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                <?php }; ?>
                            </div>
                        </div>
                    </div>
            <?php } } }; ?>
        </div>
    </div>
</div>
</main>
<!-- Footer -->

</body>
</html>