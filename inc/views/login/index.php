

<div class="cleaner h20"></div>

<div id="templatemo_main_top"></div>
<div id="templatemo_main">


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
                <legend>Регистрация</legend>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="regName">Имя*:</label>
                    <div class="col-md-5">
                        <input id="regName" name="regName" type="text" placeholder="" class="form-control input-md">

                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="regEmail">Электронная почта*:</label>
                    <div class="col-md-5">
                        <input id="regEmail" name="regEmail" type="text" placeholder="" class="form-control input-md">

                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="regAddress">Адрес:</label>
                    <div class="col-md-5">
                        <input id="regAddress" name="regAddress" type="text" placeholder="" class="form-control input-md">

                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="regPhone">Телефон <br>(вид: + 12345 123-45-67)*:</label>
                    <div class="col-md-5">
                        <input id="regPhone" name="regPhone" type="text" placeholder="" class="form-control input-md">

                    </div>
                </div>

                <!-- Password input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="passwordinput">Пароль*:</label>
                    <div class="col-md-5">
                        <input id="passwordinput" name="passwordinput" type="password" placeholder="" class="form-control input-md">

                    </div>
                </div>

                <!-- Password input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="confRegPaswd">Повторите пароль*:</label>
                    <div class="col-md-5">
                        <input id="confRegPaswd" name="confRegPaswd" type="password" placeholder="" class="form-control input-md">

                    </div>
                </div>

                <p align="center">* поля обязательного ввода:</p><br />

                <hr />
                <?php
                if(isset($errors)){
                    foreach($errors as $itemErrors)
                        echo "* " . $itemErrors . "<br />";
                }
                ?>

                <!-- Button -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="addUser"></label>
                    <div class="col-md-4">
                        <button id="addUser" name="addUser" class="btn btn-primary">Зарегистрироваться</button>
                    </div>
                </div>

            </fieldset>
        </form>










    </div>
    <div class="cleaner"></div>
</div> <!-- END of main -->

