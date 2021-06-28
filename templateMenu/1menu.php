<?php if ($parametrsScreen['screen_active'] == 0||1) {?>
        <body class="mdb-color darken-3 text-white bkgr">
        </body>
    <?php }else{?>
        <body class="<?php echo $parametrsScreen['bg_color']." ". $bgColor?>" style="<?php echo $style0?>">
            <div class="container-fluid ">
                <div class="row">
                    <div class="col-3">
                        <?php
                            $idCats = getIDCatByIDAndPosition($_GET['screenNumber'],1);
                            foreach ($idCats as $idCat){
                                $paramCat = getFullCatByID($idCat['id_categories']);?>
                                <div class="cart mt-2">
                                    <div class="cart-body ml-1 col-12">
                                        <div class="cart-title">
                                            <div class="cart-text text-center <?php echo $parametrsScreen['text_title_color']?>">
                                                <h1><?php echo $paramCat['name_cat'] ?></h1>
                                            </div>
                                            <div class="border-bottom border-light waves-effect pt-2 pr-4 pb-0 pl-4">
                                                <div class="row d-flex ">
                                                    <div class="col-12 col-sm-8 p-0 <?php echo $parametrsScreen['text_color']?> d-flex justify-content-start">
                                                        <h4>название</h4>
                                                    </div>
                                                    <div class="col-12 col-sm-4 p-0 <?php echo $parametrsScreen['text_color']?> d-flex justify-content-end">
                                                        <h4>цена</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="prod<?php echo $paramCat['id'] ?>" class="fs-col-1">
                                            <?php
                                            $foreachProdForm = getFullOptionsProd($paramCat['id']);
                                            foreach ($foreachProdForm as $foreachProd){
                                                $idprodfr = $foreachProd['id'];
                                                $nameProdfr = $foreachProd['name'];
                                                $massProdfr = $foreachProd['mass'];
                                                $priceProdfr = $foreachProd['price'];
                                                if ($foreachProd['visible'] != "yes") {
                                                }else{
                                                ?>
                                                <div class="card-text">
                                                    <div class=" waves-effect pt-1 pr-4 pb-0 pl-4">
                                                        <div class="row">
                                                            <div class="col-12 col-sm-10 p-0 d-flex justify-content-start colum">
                                                                <h3 class="m-0 p-0 <?php echo $parametrsScreen['text_color']?> fs"> <?php echo $nameProdfr?></h3>
                                                                <h6 class="massFont m-0 p-0 <?php echo $parametrsScreen['text_color']?> mb-1"><?php echo $massProdfr; if($massProdfr != ""){echo " г";}?></h6>
                                                            </div>
                                                            <div class="col-12 col-sm-2 p-0 <?php echo $parametrsScreen['text_color']?> d-flex justify-content-end">
                                                                <h3><?php echo $priceProdfr ?> ₽</h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } }; ?>
                                        </div>
                                    </div>
                                </div>
                        <?php  }; ?>
                    </div>
                    <div class="col-9">
                        <div class="row">
                            <?php
                                $idCats = getIDCatByIDAndPosition($_GET['screenNumber'],2);
                                foreach ($idCats as $idCat){
                                    $paramCat = getFullCatByID($idCat['id_categories']);?>
                                    <div class="col-4">
                                        <div class="cart mt-2">
                                            <div class="cart-body mr-3">
                                                <div class="cart-title">
                                                    <div class="cart-text text-center <?php echo $parametrsScreen['text_title_color']?>">
                                                        <h1><?php echo $paramCat['name_cat'] ?></h1>
                                                    </div>
                                                    <div class=" border-bottom border-light waves-effect pt-2 pr-4 pb-0 pl-4">
                                                        <div class="row d-flex ">
                                                            <div class="col-12 col-sm-8 p-0 <?php echo $parametrsScreen['text_color']?> d-flex justify-content-start">
                                                                <h4>название</h4>
                                                            </div>
                                                            <div class="col-12 col-sm-4 p-0 <?php echo $parametrsScreen['text_color']?> d-flex justify-content-end">
                                                                <h4>цена</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="prod<?php echo $paramCat['id'] ?>">
                                                    <?php
                                                    $foreachProdForm = getFullOptionsProd($paramCat['id']);
                                                    foreach ($foreachProdForm as $foreachProd){
                                                        $idprodfr = $foreachProd['id'];
                                                        $nameProdfr = $foreachProd['name'];
                                                        $massProdfr = $foreachProd['mass'];
                                                        $priceProdfr = $foreachProd['price'];
                                                        if ($foreachProd['visible'] != "yes") {
                                                        }else{
                                                        ?>
                                                        <div class="card-text">
                                                            <div class="waves-effect pt-1 pr-4 pb-0 pl-4">
                                                                <div class="row">
                                                                    <div class="col-12 col-sm-10 p-0 d-flex justify-content-start colum">
                                                                        <h3 class="m-0 p-0 mb-0 <?php echo $parametrsScreen['text_color']?> fs"> <?php echo $nameProdfr?></h3>
                                                                        <h6 class="massFont m-0 p-0 <?php echo $parametrsScreen['text_color']?> mb-1"> <?php echo $massProdfr; if($massProdfr != ""){echo " г";}?></h6>
                                                                    </div>
                                                                    <div class="col-12 col-sm-2 p-0 <?php echo $parametrsScreen['text_color']?> d-flex justify-content-end">
                                                                        <h3><?php echo $priceProdfr ?> ₽</h3>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php } }; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            <?php }; ?>
                        </div>
                    </div>
                </div>
            </div>
            <? require $_SERVER['DOCUMENT_ROOT'].'/manager/generate/footer.php'?>
        </body>
    <?php }
