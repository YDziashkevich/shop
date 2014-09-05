
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

            $html = "";
            $html .= "<h2>" . $productName . "</h2>";
            $html .= "<div class='col col_13'>";
            $html .= "<img src='" . APP_BASE_URL . $img . "'/></div>";
            $html .= "<div class='col col_13 no_margin_right'><table>";
            $html .= "<tr><td height='30' width='160'>Price:</td><td> $price$ </td></tr>";
            foreach($property as $key=>$item){
                $html .= "<tr><td height='30'>" . $key . ":</td><td>" . $item . "</td></tr>";
            }
            $html .= "</table>";
            $html .= "<div class='cleaner h20'></div>";
            //$html .= "<a href=" . APP_BASE_URL . "basket/index/$id class='add_to_cart'>Добавить в корзину</a>";
            /*-----------------------------------------------------------------------------------*/
            $html .= "<form method='post'>";
            $html .= "<input type='hidden' name='idProduct' value='$id'/>";
            $html .= "<input type='submit' name='addBasket' class='btn btn-default' value='Добавить в корзину'/>";
            $html .="</form>";
            /*-----------------------------------------------------------------------------------*/
            $html .= "<div class='cleaner h30'></div>";
            $html .= "<h5><strong>Описание товара</strong></h5>";
            $html .= "<p>" . $description . "</p>";
            $html .= "<div class='cleaner h50'></div><div class='cleaner'></div>";
            echo $html;

            ?>

        </div> <!-- END of content -->



        <div class="cleaner"></div>
    </div> <!-- END of main -->

