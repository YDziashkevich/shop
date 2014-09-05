<?php include 'header.php' ?>
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <ul class="nav navbar-nav">
                <li><a href="<?php echo APP_BASE_URL;?>admin/index">Главная</a></li>
                <li class="active"><a href="<?php echo APP_BASE_URL;?>admin/catalog">Работа с каталогом</a></li>
                <li><a href="<?php echo APP_BASE_URL;?>admin/items">Работа с товарами</a></li>
                <li><a href="<?php echo APP_BASE_URL;?>admin/properties">Редактирование характеристик товаров</a></li>
            </ul>
            <a href="<?php echo APP_BASE_URL."admin/logout"; ?>" class="btn btn-default" role="button" style="margin: 10px 0 10px 100px;">Выйти</a>
        </div>
    </nav>
    <form method="get">
        <div class="panel panel-default">
            <div class="panel-heading">Список всех каталогов:</div>
            <div class="panel-body">
                <ul>
                    <?php foreach($this->catalog as $name){ ?>
                        <li><?php echo $name['name'] ?></li>
                    <?php }?>
                </ul><br>
                <label for="cats">Выберите категорию для редактирования: </label>
                <select class="form-control" name="cats" id="cats">
                    <?php foreach($this->catalog as $name){ ?>
                        <option value="<?php echo $name['id'] ?>"><?php echo $name['name'] ?></option>
                    <?php }?>
                </select>
            </div>
        </div>
        <input type="submit" name="edit" id="edit" value="Редактировать" class="btn btn-default">
    </form>
<?php include 'footer.php' ?>