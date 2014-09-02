<?php include 'header.php' ?>
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <ul class="nav navbar-nav">
                <li><a href="<?php echo APP_BASE_URL;?>admin/index">Главная</a></li>
                <li><a href="<?php echo APP_BASE_URL;?>admin/catalog">Работа с каталогом</a></li>
                <li><a href="<?php echo APP_BASE_URL;?>admin/items">Работа с товарами</a></li>
                <li><a href="<?php echo APP_BASE_URL;?>admin/security">Добавление админов</a></li>
                <li class="active"><a href="<?php echo APP_BASE_URL;?>admin/properties">Редактирование характеристик товаров</a></li>
            </ul>
        </div>
    </nav>
    <form class="form-horizontal" method="post">
        <fieldset>

            <!-- Form Name -->
            <legend>Редактирование свойства</legend>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="property">Название свойства</label>
                <div class="col-md-4">
                    <input id="property" name="property" type="text" placeholder="" class="form-control input-md" value="<?php echo @$this->property; ?>">
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="for_input">Название свойства для input (на англ. без пробелов)</label>
                <div class="col-md-4">
                    <input id="for_input" name="for_input" type="text" placeholder="" class="form-control input-md" value="<?php echo @$this->for_input; ?>">
                </div>
            </div>

            <!-- Button -->
            <div class="form-group">
                <div class="col-md-8">
                    <input type="submit" id="submit" name="submit" class="btn btn-success" value="Редактировать свойство">
                </div>
            </div>

        </fieldset>
    </form>

    <!-- Вывод сообщений об ошибках -->
<?php if(!empty($this->msg)){ ?>
    <div class="alert alert-warning" role="alert" style="width: 550px; margin: 0 auto;">
        <?php echo @$this->msg; ?>
    </div><br />
<?php } ?>
<?php include 'footer.php' ?>