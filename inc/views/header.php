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
        <div id="site_title"><a href='<?php echo APP_BASE_URL ?>main/index' style="text-decoration: none"> <h1>@SY-shop</h1></a></div>

        <div id="header_right">


            <?php

            if(isset($_POST['enterLogin']) && $_SESSION["user"]["name"] == APP_BASE_USER){
                $link = "Неправильный пользователь, или пароль. Зарегистрируйтесь";
            }else{
                $link = "Зарегистрироваться";
            }

            if($_SESSION["user"]["name"] == APP_BASE_USER){
                $html = " <form class='form-inline' role='form'  method='post' action='".APP_BASE_URL."main/enter'>
                <div class='form-group'>
                    <label class='sr-only' for='exampleInputEmail2'>Email</label>
                    <input type='text' class='form-control'  name='loginName' placeholder='Введите имя пользователя'>
                </div>
                <div class='form-group'>
                    <label class='sr-only' for='exampleInputPassword2'>Password</label>
                    <input type='password' class='form-control' id='exampleInputPassword2' name='loginPaswd' placeholder='Пароль'>
                </div>
                <input type='submit' class='btn btn-default' name='enterLogin' value='Войти'>
                <a href='".APP_BASE_URL."login/index' class='btn btn-default' role='button' >".$link."</a>
            </form>";
            }else{
                $html = "<a href='".APP_BASE_URL."user/index' class='btn btn-default' role='button' ><h3>" . $_SESSION["user"]["name"] . "</h3></a>";
                $html .= "<a href='".APP_BASE_URL."main/exit' class='btn btn-default' role='button' ><h6>Выйти</h6></a>";
            }
            echo $html;

            //var_dump($_SESSION);

            ?>


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
            <?php

            if(isset($_SESSION["user"]["admin"]) && $_SESSION["user"]["admin"] == "1"){
                $admin = "<li><a href='".APP_BASE_URL."admin/index'>Настройки магазина</a></li>";
                echo $admin;
            }


            ?>
        </ul>
        <br style="clear: left" />
    </div> <!-- end of templatemo_menu -->