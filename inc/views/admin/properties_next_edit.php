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
    <form method="get">
        <div class="panel panel-default">
            <div class="panel-heading">Список всех свойств для выбранной категории:</div>
            <div class="panel-body">
                <ul>
                    <?php foreach($this->properties as $property){ ?>
                        <li>&nbsp;<input type="radio" name="id" id="id" value="<?php echo $property['id'] ?>">&nbsp;&nbsp;<?php echo $property['property'] ?></li>
                    <?php }?>
                </ul>
                <input type="hidden" name="cats" id="cats" value="<?php echo $this->catId; ?>">
            </div>
        </div>
        <input type="submit" name="edit" id="edit" value="Редактировать свойтво" class="btn btn-default">
    </form>
<?php include 'footer.php' ?>