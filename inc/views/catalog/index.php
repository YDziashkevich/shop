

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
             * вывод категорий в левой части контента
             */
            foreach(self::$category as $value){
                echo "<li> <a href=" . APP_BASE_URL . "catalog/category/$value[id]> $value[name] </a> </li>";
            }
            ?>

        </ul>
    </div> <!-- END of sidebar -->

    <div id="content">

        <?php
        /**
         * вывод каталога категорий с товарами
         */
        $html = "";
        foreach(self::$category as $item){
            $productsCategory = CatalogController::getProducts($item["id"]);
            $html .= "<h2>$item[name]</h2>";
            foreach($productsCategory as $itemProduct){
                $html .= "<div class='col col_14 product_gallery no_margin_right'>";
                $html .= "<a href=" . APP_BASE_URL . "catalog/product/$itemProduct[id]><img src='". APP_BASE_URL . $itemProduct["img"] . "'/></a>";
                $html .= "<h3>" . $itemProduct["name"] . "</h3>";
                $html .= "<p class='product_price'>$" . $itemProduct["price"] . "</p>";
                //$html .= "<a href=" . APP_BASE_URL . "basket/index/$itemProduct[id] class='add_to_cart'>Добавить в корзину</a>";
                /*-----------------------------------------------------------------------------------*/
                $html .= "<form method='post'>";
                $html .= "<input type='hidden' name='idProduct' value='$itemProduct[id]'/>";
                $html .= "<input type='submit' name='addBasket'  class='btn btn-default' value='Добавить в корзину'/>";
                $html .="</form>";
                /*-----------------------------------------------------------------------------------*/
                $html .= "</div>";
            }
            $html .= "<a href= " . APP_BASE_URL . "catalog/category/$item[id]  class='float_r btn btn-success' style='margin-top: -30px; margin-right: 20px; color: white;'>Посмотреть все товары >>></a>";
            $html .= "<div class='cleaner h10'></div>";
        }
        echo $html;
        ?>

    </div> <!-- END of content -->
    <div class="cleaner"></div>
</div> <!-- END of main -->

