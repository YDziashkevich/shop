<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Web Store Theme - Free CSS Templates</title>
    <meta name="keywords" content="web store, free templates, website templates, CSS, HTML" />
    <meta name="description" content="Web Store Theme - free CSS template provided by templatemo.com" />
    <link href="<?php echo APP_BASE_URL; ?>css/templatemo_style.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" type="text/css" href="<?php echo APP_BASE_URL; ?>css/ddsmoothmenu.css" />

    <script type="text/javascript" src="<?php echo APP_BASE_URL;?>js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo APP_BASE_URL; ?>js/ddsmoothmenu.js">

        /***********************************************
         * Smooth Navigational Menu- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
         * This notice MUST stay intact for legal use
         * Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
         ***********************************************/

    </script>

    <script type="text/javascript">

        ddsmoothmenu.init({
            mainmenuid: "templatemo_menu", //menu DIV id
            orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
            classname: 'ddsmoothmenu', //class added to menu's outer DIV
            //customtheme: ["#1c5a80", "#18374a"],
            contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
        })

    </script>

    <link rel="stylesheet" type="text/css" href="<?php echo APP_BASE_URL; ?>css/styles.css" />
    <script language="javascript" type="text/javascript" src="<?php echo APP_BASE_URL; ?>scripts/mootools-1.2.1-core.js"></script>
    <script language="javascript" type="text/javascript" src="<?php echo APP_BASE_URL; ?>scripts/mootools-1.2-more.js"></script>
    <script language="javascript" type="text/javascript" src="<?php echo APP_BASE_URL; ?>scripts/slideitmoo-1.1.js"></script>
    <script language="javascript" type="text/javascript">
        window.addEvents({
            'domready': function(){
                /* thumbnails example , div containers */
                new SlideItMoo({
                    overallContainer: 'SlideItMoo_outer',
                    elementScrolled: 'SlideItMoo_inner',
                    thumbsContainer: 'SlideItMoo_items',
                    itemsVisible: 5,
                    elemsSlide: 2,
                    duration: 200,
                    itemsSelector: '.SlideItMoo_element',
                    itemWidth: 171,
                    showControls:1});
            },

        });

        function clearText(field)
        {
            if (field.defaultValue == field.value) field.value = '';
            else if (field.value == '') field.value = field.defaultValue;
        }
    </script>

</head>

<body id="home">

<div id="templatemo_wrapper">
<div id="templatemo_header">
    <div id="site_title"><h1><a href="index.html">Free CSS Templates</a></h1></div>

    <div id="header_right">
        <div id="templatemo_search">
            <form action="#" method="get">
                <input type="text" value="Поиск" name="keyword" id="keyword" title="keyword" onfocus="clearText(this)" onblur="clearText(this)" class="txt_field" />
                <input type="submit" name="Search" value="" alt="Search" id="searchbutton" title="Search" class="sub_btn"  />
            </form>
        </div>
    </div> <!-- END -->
</div> <!-- END of header -->

<div id="templatemo_menu" class="ddsmoothmenu">
    <ul>
        <li><a href="<?php echo APP_BASE_URL;?>main/index">Главная</a></li>
        <li><a href="<?php echo APP_BASE_URL;?>catalog/index">Каталог</a>
            <ul>

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
        </li>
        <li><a href="<?php echo APP_BASE_URL;?>about/index"  class="selected">О компании</a></li>
        <li><a href="<?php echo APP_BASE_URL;?>basket/index">Сделать заказ</a></li>
        <li><a href="<?php echo APP_BASE_URL;?>contact/index">Контакты</a></li>
    </ul>
    <br style="clear: left" />
</div> <!-- end of templatemo_menu -->


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
                $html .= "<a href=" . APP_BASE_URL . "catalog/product/$itemProduct[id]><img src='". APP_BASE_URL . "images/product/" . $itemProduct["img"] . "'/></a>";
                $html .= "<h3>" . $itemProduct["name"] . "</h3>";
                $html .= "<p class='product_price'>$" . $itemProduct["price"] . "</p>";
                $html .= "<a href=" . APP_BASE_URL . "basket/index/$itemProduct[id] class='add_to_cart'>Добавить в корзину</a>";
                $html .= "</div>";
            }
            $html .= "<a href= " . APP_BASE_URL . "catalog/category/$item[id]  class='more float_r'>Посмотреть все товары</a>";
            $html .= "<div class='cleaner h50'></div>";
        }
        echo $html;
        ?>

    </div> <!-- END of content -->
    <div class="cleaner"></div>
</div> <!-- END of main -->

<div id="templatemo_footer">
    <div class="cleaner h10"></div>
    <p align="center">
        Copyright © 2014 | Sergey Aristov & Yury Dziashkevich
    </p>
</div> <!-- END of footer -->

</div>

</body>
</html>