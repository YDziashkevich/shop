<?php include 'header.php' ?>
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <ul class="nav navbar-nav">
            <li><a href="<?php echo APP_BASE_URL;?>admin/index">Главная</a></li>
            <li class="active"><a href="<?php echo APP_BASE_URL;?>admin/catalog">Работа с каталогом</a></li>
            <li><a href="<?php echo APP_BASE_URL;?>admin/items">Работа с товарами</a></li>
            <li><a href="<?php echo APP_BASE_URL;?>admin/security">Добавление админов</a></li>
            <li><a href="<?php echo APP_BASE_URL;?>admin/properties">Редактирование характеристик товаров</a></li>
        </ul>
    </div>
</nav>
<form>
    <div class="panel panel-default">
        <div class="panel-heading">Список всех каталогов:</div>
            <div class="panel-body">
                <ul>
                    <?php foreach($this->catalog as $name){ ?>
                        <li><?php echo $name['name'] ?>&nbsp;&nbsp;<input type="checkbox" name="<?php echo $name['id']; ?>" id="<?php echo $name['id']; ?>" ></li>
                    <?php }?>
                </ul>
            </div>
    </div>
    <input type="submit" name="delete" id="delete" value="Удалить" class="btn btn-default">
</form>

<?php include 'footer.php' ?>