


    <div class="cleaner h20"></div>

    <div id="templatemo_main_top"></div>
    <div id="templatemo_main">
        <div id="product_slider">
            <div id="SlideItMoo_outer">
                <div id="SlideItMoo_inner">
                    <div id="SlideItMoo_items">
                        <?php
                        $slide = "";

                        /**
                         * вывод категорий в левой части контента
                         */
                        foreach(self::$category as $value){
                            $slide .= "
                            <div class='SlideItMoo_element'>
                            <a href=" . APP_BASE_URL . "catalog/category/$value[id]>
                            <img src='". APP_BASE_URL . "images/product/" . $value["img"] . "'/></a>
                            </div>
                        ";
                        }
                        echo $slide;
                        ?>
                    </div>
                </div>
            </div>
            <div class="cleaner"></div>
        </div>

        <div id="sidebar">
            <h3>Каталог</h3>
            <ul class="sidebar_menu">
                <!-- вывод списка категорий -->
                <?php
                /**
                 * вывод списка категорий в меню
                 */
                foreach(self::$category as $value){
                    echo "<li> <a href=" . APP_BASE_URL . "catalog/category/$value[id]> $value[name] </a> </li>";
                }
                ?>
            </ul>
        </div> <!-- END of sidebar -->

        <div id="content">
            <form action="<?php echo APP_BASE_URL ?>order/index" method="post">
            <h2>Оформить заказ</h2>
            <h5><strong>Для заказа заполните контактную информацию</strong></h5>
            <div class="col col_13 checkout">
                Имя*:
                <input type="text" name="name"  style="width:300px;"  />
                Адрес:
                <input type="text" name="address" style="width:300px;"  />
                Телефон (+ 12345 123-45-67)*:
                <input type="text" name="phone"  style="width:300px;"  />
                * поля обязательного ввода:<br />
                <hr />
                <?php
                if(isset($nameError)){
                    echo "* " . $nameError . "<br />";
                }
                if(isset($phoneError)){
                    echo "* " . $phoneError . "<br />";
                }

                ?>

            </div>

            <div class="cleaner h20"></div>
            <h4>Сумма заказа: <strong>$<?php echo $_SESSION["summ"] ?></strong></h4>
                <div class="cleaner h20"></div>
                <input type="submit" name="ok" value="OK"/>


            </form>

        </div>
        <div class="cleaner"></div>
    </div> <!-- END of main -->

