    <script type="text/javascript" defer>
    let nameMass;
    function checkDatabase() {
            //alert("Страница будет сейчас обновлена!!! ")
            //location.href = '<?php //echo $linkNavigate?>.php';
            $.ajax({
                    url: '/manager/generate/phonesStatusAjax.php', // путь к ajax-обработчику
                    method: 'POST',
                    data: {
                        screenID:'<?php echo $_GET['screenNumber']?>'
                    }
                }).done(function(data) {
                    data = jQuery.parseJSON(data); // данные в json
                    //alert("Страница будет сейчас обновлена!!! ");
                    if (data.length > 0) {
                        // добавляем записи в блок в виде html
                        <?php
                            $foreachCatsDelCart = getFullCat();
                            foreach ($foreachCatsDelCart as $foreachCatDelCart){
                                $idCatDelCart = $foreachCatDelCart['id'];
                                $nameCatDelCart = $foreachCatDelCart['name_cat'];?>
                                $("#prod<?php echo $idCatDelCart?>").empty();
                                $.each(data, function(index, data) {
                                    //alert(data.check_ping);
                                    //alert(<?php echo $quantityBlockRaundArray?>);
                                    if (data.id_cat == <?php echo $idCatDelCart?>) {
                                        if(data.mass === ''){nameMass = ""}else{nameMass = " г"};
                                        $("#prod<?php echo $idCatDelCart?>").append(`
                                            <div class="card-text">
                                                <div class=" waves-effect pt-1 pr-4 pb-0 pl-4">
                                                    <div class="row">
                                                        <div class="col-12 col-sm-10 p-0 d-flex justify-content-start colum">
                                                            <h3 class="m-0 p-0 ${data.text_color} fs"> ${data.name}</h3>
                                                            <h6 class="massFont m-0 p-0 ${data.text_color} mb-1">${data.mass}${nameMass}</h6>
                                                        </div>
                                                        <div class="col-12 col-sm-2 p-0 ${data.text_color} d-flex justify-content-end">
                                                            <h3>${data.price} ₽</h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        `);
                                    }
                                });

                        <?php }; ?>

                    }
                });
    }
    setInterval(function() {
        checkDatabase();
    }, 10000);//45000
    </script>
    <!-- Footer -->
