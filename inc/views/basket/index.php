

    <div class="cleaner h20"></div>

    <div id="templatemo_main_top"></div>
    <div id="templatemo_main">
        <div id="product_slider">
            <div id="SlideItMoo_outer">
                <div id="SlideItMoo_inner">
                    <div id="SlideItMoo_items">
                        <<?php
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

            <!-- корзина -->
            <?php
            /**
             * вывод корзины с элементами
             */
            if(isset($element) && $element[0] != null && $element[0] != "empty"){
                $head = "<table width='700px' cellspacing='0' cellpadding='5'>";
                    $head .= "<tr bgcolor='#CCCCCC'>
                        <th width='220' align='left'>Изображение </th>
                        <th width='180' align='left'>Наименование</th>
                        <th width='100' align='center'>Количество </th>
                        <th width='60' align='right'>Цена </th>
                        <th width='60' align='right'>Стоимость </th>
                        <th width='90'> </th>
                    </tr>";
                echo $head;

                $html = "";
                $summ = 0;
                foreach($element as $val){
                    $html .= "<tr>";
                    $html .= "<td><img src='". APP_BASE_URL . "images/product/$val[img]'/></td>";
                    $html .= "<td>$val[productName]</td>";
                    $html .= "<td align='center'>" . $val["numProduct"] . "</td>";
                    $html .= "<td align='right'>$val[price]</td>";
                    $num = (int)$val["price"] * (int)$val["numProduct"];
                    $html .= "<td align='right'>" . $num . "</td>";
                    //$html .= "<td align='center'> <a href=" . APP_BASE_URL . "basket/index/!$val[id]><img src='" . APP_BASE_URL . "images/remove_x.gif' alt='remove' /><br />Remove</a> </td>";
                    /*-----------------------------------------------------------------------------------*/
                    $html .= "<td align='center'>";
                    $html .= "<form method='post'>";
                    $html .= "<input type='hidden' name='idProduct' value='".$val["id"]."' />";
                    $html .= "<input type='submit' name='removeBasket' value='Удалить'/>";
                    $html .="</form>";
                    $html .= "</td>";
                    /*-----------------------------------------------------------------------------------*/
                    $html .= " </tr>";
                    $summ = $summ + $num;
                }

                $_SESSION["summ"] = $summ;

                $html .= "<tr>
                    <td colspan='3' align='right'  height='40px'></td>
                    <td align='right' style='background:#ccc; font-weight:bold'> Всего </td>
                    <td align='right' style='background:#ccc; font-weight:bold'> $summ </td>
                    <td style='background:#ccc; font-weight:bold'> </td>
                    </tr>
                    </table>
                    <div style='float:right; width: 215px; margin-top: 20px;'>
                    <div class='checkout'><a href=" . APP_BASE_URL . "basket/index/empty class='more'>Очистить корзину</a></div>
                    <div class='cleaner h20'></div>";
                /*-----------------------------------------------------------------------------------------------------------*/
                if($_SESSION["user"]["name"] == "Гость"){
                    $html .= "<div class='checkout'><a href=" . APP_BASE_URL . "order/index/ class='more'>Оформить заказ</a></div>";
                }else{

                }
                /*-----------------------------------------------------------------------------------------------------------*/
                $html .= " <div class='cleaner h20'></div>
                    <div class='continueshopping'><a href=" . APP_BASE_URL . "catalog/index/  class='more'>Продолжить покупки</a></div>";

                echo $html;
            }else{
                echo "<h2>Ваша корзина пуста</h2>";
            }
            ?>

        </div>
        <div class="cleaner"></div>
    </div> <!-- END of main -->

