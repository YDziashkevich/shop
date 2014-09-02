

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

            <div class="col ">
                <div id="">
                    <form class="form-horizontal" method="post">
                        <fieldset>

                            <!-- Form Name -->
                            <legend>Контактная информация</legend>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="name">Имя:</label>
                                <div class="col-md-4">
                                    <input id="name" name="name" type="text" placeholder="" class="form-control input-md" value="<?php echo $this->name; ?>">

                                </div>
                            </div>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="email">email</label>
                                <div class="col-md-4">
                                    <input id="email" name="email" type="email" placeholder="" class="form-control input-md" value="<?php echo $this->email; ?>">

                                </div>
                            </div>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="topic">Тема</label>
                                <div class="col-md-4">
                                    <input id="topic" name="topic" type="text" placeholder="" class="form-control input-md" value="<?php echo $this->topic; ?>">

                                </div>
                            </div>

                            <!-- Prepended text-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="captcha">Защита от ботов</label>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <span class="input-group-addon" style="padding: 0;""><img src="<?php echo APP_BASE_URL.'captcha/index'; ?>" ></span>
                                        <input id="captcha" name="captcha" class="form-control" placeholder="" type="text">
                                    </div>

                                </div>
                            </div>

                            <!-- Textarea -->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="message">Сообщение</label>
                                <div class="col-md-4">
                                    <textarea class="form-control" id="message" name="message"><?php echo $this->message; ?></textarea>
                                </div>
                            </div>

                            <!-- Button (Double) -->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="reset"></label>
                                <div class="col-md-8">
                                    <button type="reset" id="reset" name="reset" class="btn btn-default">Очистить</button>
                                    <button type="submit" id="submit" name="submit" class="btn btn-success">Отправить</button>
                                </div>
                            </div>

                        </fieldset>
                    </form>
                    <?php if(!empty($this->msg)){ ?>
                        <div class="alert alert-warning" role="alert" style="width: 550px; margin: 0 auto;">
                            <?php echo @$this->msg; ?>
                        </div><br />
                    <?php } ?>
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

            <iframe width="660" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=просп.+Машерова+19,+Минск,+Беларусь&amp;aq=&amp;sll=53.9162977,27.5625608&amp;sspn=53.9162977,27.5625608&amp;vpsrc=6&amp;ie=UTF8&amp;hq=&amp;hnear=просп.+Машерова+19,+Минск,+Беларусь&amp;t=m&amp;ll=53.9162977,27.5625608&amp;spn=53.9162977,27.5625608&amp;z=14&amp;output=embed"></iframe>

        </div> <!-- END of content -->
        <div class="cleaner"></div>
    </div> <!-- END of main -->

   