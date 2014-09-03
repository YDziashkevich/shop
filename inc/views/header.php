<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>E-Shop</title>
    <link href="<?php echo APP_BASE_URL; ?>css/templatemo_style.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo APP_BASE_URL; ?>css/bootstrap.css" rel="stylesheet" type="text/css" />

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
        <div id="site_title"><h1><a href="<?php echo APP_BASE_URL;?>main/index">E-Shop</a></h1></div>

        <div id="header_right">
            <form class="form-inline" role="form">
                <div class="form-group">
                    <label class="sr-only" for="exampleInputEmail2">Email</label>
                    <input type="email" class="form-control" id="exampleInputEmail2" placeholder="Введите email">
                </div>
                <div class="form-group">
                    <label class="sr-only" for="exampleInputPassword2">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Пароль">
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox"> Запомнить
                    </label>
                </div>
                <button type="submit" class="btn btn-default">Войти</button>
            </form>
        </div> <!-- END -->
    </div> <!-- END of header -->

    <div id="templatemo_menu" class="ddsmoothmenu">
        <ul>
            <li><a href="<?php echo APP_BASE_URL;?>main/index">Главная</a></li>
            <li><a href="<?php echo APP_BASE_URL;?>catalog/index">Каталог</a>
                <ul>
                    <!-- вывод списка категорий -->
                    <?php
                    foreach(self::$category as $value){
                        echo "<li> <a href=" . APP_BASE_URL . "catalog/category/$value[id]> $value[name] </a> </li>";
                    }
                    ?>
                </ul>
            </li>
            <li><a href="<?php echo APP_BASE_URL;?>about/index"  class="selected">О компании</a></li>
            <?php
            if(isset($_SESSION["basket"]) && !empty($_SESSION["basket"])){
                echo "<li><a href='".APP_BASE_URL."basket/index'>Корзина !</a></li>";
            }else{
                echo "<li><a href='".APP_BASE_URL."basket/index'>Корзина</a></li>";
            }
            ?>
            <li><a href="<?php echo APP_BASE_URL;?>guestbook/index">Гостевая книга</a></li>
            <li><a href="<?php echo APP_BASE_URL;?>contact/index">Контакты</a></li>
        </ul>
        <br style="clear: left" />
    </div> <!-- end of templatemo_menu -->