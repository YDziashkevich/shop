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
            <li><a href="index.html">Главная</a></li>
            <li><a href="products.html">Каталог</a>
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
            <li><a href="about.html">О компании</a></li>
            <!--<li><a href="faqs.html">FAQs</a></li>-->
            <li><a href="checkout.html">Сделать заказ</a></li>
            <li><a href="contact.html" class="selected">Контакты</a></li>
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
            <h2>Контактная информация</h2>

            <div class="col col_13">
                <p>Для связи с нами, заполните следующую форму.</p>
                <div id="contact_form">
                    <form method="post" name="contact" action="#">

                        <label for="author">Имя:</label> <input type="text" id="author" name="author" class="required input_field" />
                        <div class="cleaner h10"></div>

                        <label for="email">Email:</label> <input type="text" id="email" name="email" class="validate-email required input_field" />
                        <div class="cleaner h10"></div>

                        <label for="subject">Тема:</label> <input type="text" name="subject" id="subject" class="input_field" />
                        <div class="cleaner h10"></div>

                        <label for="text">Сообщение:</label> <textarea id="text" name="text" rows="0" cols="0" class="required"></textarea>
                        <div class="cleaner h10"></div>

                        <input type="submit" value="Отправить" id="submit" name="submit" class="submit_btn float_l" />
                        <input type="reset" value="Очистить" id="reset" name="reset" class="submit_btn float_r" />

                    </form>
                </div>
            </div>
            <div class="col col_13">
                <h5>Контактные данные:</h5>
                <strong>Адрес:</strong> Минск, пр-кт Машерова, 19<br />
                <strong>Телефон:</strong> 8029 123-45-67<br />
                <strong>Email:</strong> <a href="#">shop@shop.by</a> <br />
                <div class="cleaner divider"></div>
            </div>

            <div class="cleaner h30"></div>

            <iframe width="660" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=new+york+central+park&amp;aq=&amp;sll=37.0625,-95.677068&amp;sspn=60.158465,135.263672&amp;vpsrc=6&amp;ie=UTF8&amp;hq=&amp;hnear=Central+Park,+New+York&amp;t=m&amp;ll=40.769606,-73.973372&amp;spn=0.014284,0.033023&amp;z=14&amp;output=embed"></iframe>

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