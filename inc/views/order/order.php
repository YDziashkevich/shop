


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
            <div class='cleaner h20'></div>
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
            <div class='cleaner h20'></div>

            <!-- корзина -->
            <?php
            /**
             * вывод корзины с элементами
             */
            $html = "";
            if(!empty($products)){
                $head = "<h3>Номер заказа: " . $idOrder . " </h3>";
                $head .= "<table width='700px' cellspacing='0' cellpadding='5'>";
                    $head .= "<tr bgcolor='#CCCCCC'>
                        <th width='220' align='left'></th>
                        <th width='180' align='left'>Наименование</th>
                        <th width='100' align='center'>Количество </th>
                        <th width='60' align='right'>Цена </th>
                        <th width='60' align='right'>Стоимость </th>
                        <th width='90'> </th>
                    </tr>";
                echo $head;



                foreach($products as $val){
                    $html .= "<tr>";
                    $html .= "<td width='220' align='left'></td>";
                    $html .= "<td>$val[productName]</td>";
                    $html .= "<td align='center'>" . $val["num"] . "</td>";
                    $html .= "<td align='right'>$val[price]</td>";
                    $num = (int)$val["price"] * (int)$val["num"];
                    $html .= "<td align='right'>" . $num . "</td>";
                    $html .= " </tr>";

                }


                $html .= "<tr>
                    <td colspan='3' align='right'  height='40px'></td>
                    <td align='right' style='background:#ccc; font-weight:bold'> Всего </td>
                    <td align='right' style='background:#ccc; font-weight:bold'> $summ </td>
                    <td style='background:#ccc; font-weight:bold'> </td>
                    </tr>
                    </table>
                    <div style='float:right; width: 215px; margin-top: 20px;'>";
            }

                echo $html;

            ?>

        </div>
        <div class="cleaner"></div>
    </div> <!-- END of main -->

