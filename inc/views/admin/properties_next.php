<?php include 'header.php' ?>
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <ul class="nav navbar-nav">
                <li><a href="<?php echo APP_BASE_URL;?>admin/index">Главная</a></li>
                <li><a href="<?php echo APP_BASE_URL;?>admin/catalog">Работа с каталогом</a></li>
                <li><a href="<?php echo APP_BASE_URL;?>admin/items">Работа с товарами</a></li>
                <li class="active"><a href="<?php echo APP_BASE_URL;?>admin/properties">Редактирование характеристик товаров</a></li>
            </ul>
            <a href="<?php echo APP_BASE_URL; ?>" class="btn btn-default" role="button" style="margin: 10px 0 10px 100px;">Магазин</a>
            <a href="<?php echo APP_BASE_URL."admin/logout"; ?>" class="btn btn-default" role="button" style="margin: 10px 0 10px 100px;">Выйти</a>
        </div>
    </nav>
    <form method="post">
        <div class="panel panel-default">
            <div class="panel-heading">Список всех свойств для выбранной категории:</div>
            <div class="panel-body">
                <ul>
                    <?php foreach($this->properties as $property){ ?>
                        <li><?php echo $property['property'] ?></li>
                    <?php }?>
                </ul>
            </div>
        </div>
    </form>
    <div>
        <a href="<?php echo APP_BASE_URL; ?>admin/properties_next_add?cats=<? echo $this->idCat; ?>" class="btn btn-default" role="button">Добавить свойство</a>
        <a href="<?php echo APP_BASE_URL; ?>admin/properties_next_delete?cats=<? echo $this->idCat; ?>" class="btn btn-default" role="button">Удалить свойство</a>
        <a href="<?php echo APP_BASE_URL; ?>admin/properties_next_edit?cats=<? echo $this->idCat; ?>" class="btn btn-default" role="button">Редактировать свойтво</a>
    </div>
<?php include 'footer.php' ?>