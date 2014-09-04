

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
        <form method="post">
            <h2>Регистрация</h2>

            <div class="col col_13 checkout">
                имя*:
                <input type="text" name="regName"  style="width:300px;"  />
                электронная почта*:
                <input type="text" name="regEmail" style="width:300px;"  />
                адрес:
                <input type="text" name="regAddress" style="width:300px;"  />
                телефон (вид: + 12345 123-45-67)*:
                <input type="text" name="regPhone" style="width:300px;"  />
                пароль*:
                <input type="password" name="regPaswd"  style="width:300px;"  />
                повторите пароль*:
                <input type="password" name="confRegPaswd"  style="width:300px;"  />
                * поля обязательного ввода:<br />


                <hr />
                <?php
                if(isset($errors)){
                    foreach($errors as $itemErrors)
                    echo "* " . $itemErrors . "<br />";
                }

                ?>

            </div>


            <div class="cleaner h20"></div>
            <input type="submit" name="addUser" value="зарегистрироваться"/>


        </form>

    </div>
    <div class="cleaner"></div>
</div> <!-- END of main -->

