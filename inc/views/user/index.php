


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

        if(!empty($orders)){
            foreach($orders as $keyOrder => $valueOrder){
                $head ="";
                $head .= "<h3>Номер заказа: " . $keyOrder . ". Дата заказа: ".$valueOrder["date"]." </h3>";
                unset($valueOrder["date"]);
                $head .= "<table width='700px' cellspacing='0' cellpadding='5'>";
                $head .= "<tr bgcolor='#CCCCCC'>
                        <th width='220' align='left'></th>
                        <th width='180' align='left'>Наименование</th>
                        <th width='100' align='center'>Количество </th>
                        <th width='60' align='right'>Цена </th>
                        <th width='60' align='right'>Стоимость </th>
                        <th width='90'> </th>
                    </tr>";
                $sum = 0;
                foreach($valueOrder as $valueItem){
                    $head .= "<tr>";
                    $head .= "<td width='220' align='left'></td>";
                    $head .= "<td>$valueItem[nameProduct]</td>";
                    $head .= "<td align='center'>$valueItem[numProduct]</td>";
                    $head .= "<td align='right'>$valueItem[price]</td>";
                    $num = (int)$valueItem["price"] * (int)$valueItem["numProduct"];
                    $head .= "<td align='right'>" . $num . "</td>";
                    $head .= " </tr>";
                    $sum += $num;
                }
                $head .= "<tr>
                    <td colspan='3' align='right'  height='40px'></td>
                    <td align='right' style='background:#ccc; font-weight:bold'> Всего </td>
                    <td align='right' style='background:#ccc; font-weight:bold'> $sum </td>
                    <td style='background:#ccc; font-weight:bold'> </td>
                    </tr>
                    </table>
                    <div class='cleaner h20'></div>";
                $html .=$head;
            }
        }else{
            $html .= "<h3>У вас не было заказов</h3>";
        }

        echo $html;

        ?>
        <div style='float:right; width: 215px; margin-top: 20px;'></div>

    </div>
    <div class="cleaner"></div>
</div> <!-- END of main -->

