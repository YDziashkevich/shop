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
                    <li><a href="#">Процессоры</a></li>
                    <li><a href="#">Видеокарты</a></li>
                    <li><a href="#">Жесткие диски</a></li>
                    <li><a href="#">Системы охлаждения</a></li>
                    <li><a href="#">Материнские платы</a></li>
                    <li><a href="#">Оперативная память</a></li>
                    <li><a href="#">Корпуса</a></li>
                    <li><a href="#">Блоки питания</a></li>
                    <li><a href="#">Звуковые карты</a></li>
                    <li><a href="#">Тв-тюнеры</a></li>
                    <li><a href="#">Оптические накопители</a></li>
                    <li><a href="#">Мониторы</a></li>
                    <li><a href="#">Колонки</a></li>
                    <li><a href="#">Мыши</a></li>
                    <li><a href="#">Клавиатуры</a></li>
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
                        <div class="SlideItMoo_element">
                            <a href="#" target="_parent">
                                <img src="<?php echo APP_BASE_URL; ?>images/gallery/01.jpg" alt="product 1" /></a>
                        </div>
                        <div class="SlideItMoo_element">
                            <a href="#" target="_parent">
                                <img src="<?php echo APP_BASE_URL; ?>images/gallery/03.jpg" alt="product 2" /></a>
                        </div>
                        <div class="SlideItMoo_element">
                            <a href="#" target="_parent">
                                <img src="<?php echo APP_BASE_URL; ?>images/gallery/03.jpg" alt="product 3" /></a>
                        </div>
                        <div class="SlideItMoo_element">
                            <a href="#" target="_parent">
                                <img src="<?php echo APP_BASE_URL; ?>images/gallery/04.jpg" alt="product 4" /></a>
                        </div>
                        <div class="SlideItMoo_element">
                            <a href="#" target="_parent">
                                <img src="<?php echo APP_BASE_URL; ?>images/gallery/05.jpg" alt="product 5" /></a>
                        </div>
                        <div class="SlideItMoo_element">
                            <a href="#" target="_parent">
                                <img src="<?php echo APP_BASE_URL; ?>images/gallery/06.jpg" alt="product 6" /></a>
                        </div>
                        <div class="SlideItMoo_element">
                            <a href="#" target="_parent">
                                <img src="<?php echo APP_BASE_URL; ?>images/gallery/07.jpg" alt="product 7" /></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cleaner"></div>
        </div>

        <div id="sidebar">
            <h3>Каталог</h3>
            <ul class="sidebar_menu">
                <li><a href="#">Процессоры</a></li>
                <li><a href="#">Видеокарты</a></li>
                <li><a href="#">Жесткие диски</a></li>
                <li><a href="#">Системы охлаждения</a></li>
                <li><a href="#">Материнские платы</a></li>
                <li><a href="#">Оперативная память</a></li>
                <li><a href="#">Корпуса</a></li>
                <li><a href="#">Блоки питания</a></li>
                <li><a href="#">Звуковые карты</a></li>
                <li><a href="#">Тв-тюнеры</a></li>
                <li><a href="#">Оптические накопители</a></li>
                <li><a href="#">Мониторы</a></li>
                <li><a href="#">Колонки</a></li>
                <li><a href="#">Мыши</a></li>
                <li><a href="#">Клавиатуры</a></li>
            </ul>
        </div> <!-- END of sidebar -->

        <div id="content">

            <table width="700px" cellspacing="0" cellpadding="5">
                <tr bgcolor="#CCCCCC">
                    <th width="220" align="left">Изображение </th>
                    <th width="180" align="left">Описание </th>
                    <th width="100" align="center">Количество </th>
                    <th width="60" align="right">Цена </th>
                    <th width="60" align="right">Стоимость </th>
                    <th width="90"> </th>

                </tr>
                <tr>
                    <td><img src="<?php echo APP_BASE_URL; ?>images/product/01.jpg" alt="image 01" /></td>
                    <td>Etiam in tellus</td>
                    <td align="center"><input type="text" value="1" style="width: 20px; text-align: right" /> </td>
                    <td align="right">$100 </td>
                    <td align="right">$100 </td>
                    <td align="center"> <a href="#"><img src="<?php echo APP_BASE_URL; ?>images/remove_x.gif" alt="remove" /><br />Remove</a> </td>
                </tr>
                <tr>
                    <td><img src="<?php echo APP_BASE_URL; ?>images/product/02.jpg" alt="image 02" /> </td>
                    <td>Hendrerit justo</td>
                    <td align="center"><input type="text" value="1" style="width: 20px; text-align: right" />  </td>
                    <td align="right">$40  </td>
                    <td align="right">$40 </td>
                    <td align="center"> <a href="#"><img src="<?php echo APP_BASE_URL; ?>images/remove_x.gif" alt="remove" /><br />Remove</a>  </td>
                </tr>
                <tr>
                    <td colspan="3" align="right"  height="40px"></td>
                    <td align="right" style="background:#ccc; font-weight:bold"> Всего </td>
                    <td align="right" style="background:#ccc; font-weight:bold">$140 </td>
                    <td style="background:#ccc; font-weight:bold"> </td>
                </tr>
            </table>
            <div style="float:right; width: 215px; margin-top: 20px;">

                <div class="checkout"><a href="checkout.html" class="more">Оформить заказ</a></div>
                <div class="cleaner h20"></div>
                <div class="continueshopping"><a href="javascript:history.back()" class="more">Продолжить покупки</a></div>

            </div>

        </div>
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