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

        <form class="form-horizontal" method="post">
            <fieldset>

                <!-- Form Name -->
                <legend>Оставить сообщение в гостевой книге</legend>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="userName">Введите имя:</label>
                    <div class="col-md-5">
                        <input id="userName" name="userName" type="text" placeholder="Представьтесь" class="form-control input-md" value="<? echo @$this->name; ?>">
                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="userEmail">Введите email:</label>
                    <div class="col-md-5">
                        <input id="userEmail" name="userEmail" type="text" placeholder="Введите адрес почты" class="form-control input-md" value="<? echo @$this->email; ?>">
                    </div>
                </div>

                <!-- Textarea -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="userMsg">Введите текст сообщения:</label>
                    <div class="col-md-4">
                        <textarea class="form-control" id="userMsg" name="userMsg"><? echo @$this->message; ?></textarea>
                    </div>
                </div>

                <!-- Prepended text-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="captcha">Введите капчу:</label>
                    <div class="col-md-5">
                        <div class="input-group">
                            <span class="input-group-addon" style="padding: 0;"><img src="<?php echo APP_BASE_URL.'captcha/index'; ?>" ></span>
                            <input id="captcha" name="captcha" class="form-control" placeholder="Введите капчу" type="text">
                        </div>
                    </div>
                </div>

                <!-- Button (Double) -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="reset"></label>
                    <div class="col-md-8">
                        <button type="reset" id="reset" name="reset" class="btn btn-default">Сброс</button>
                        <button type="submit" id="submit" name="submit" class="btn btn-default">Отправить</button>
                    </div>
                </div>

            </fieldset>
        </form>

<div class="text-center">
    <?php if(!empty($this->msg)){ ?>
       <div class="alert alert-warning" role="alert" style="width: 550px; margin: 0 auto;">
            <?php echo @$this->msg; ?>
       </div><br />
    <?php } ?>

<!-- Форма для сообщений -->
    <?php foreach($this->messages as $message){ ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <?php echo $message['name']; ?>&nbsp;&nbsp;&nbsp;<?php echo $message['time']; ?>
        </div>
        <div class="panel-body"><?php echo $message['message']; ?></div>
    </div><br />
    <?php } ?>
</div>
    <?php echo $this->pagination; ?>

    </div> <!-- END of content -->
    <div class="cleaner"></div>
</div> <!-- END of main -->


