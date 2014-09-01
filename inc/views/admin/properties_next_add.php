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

    Добавление нового свойства

<?php include 'footer.php' ?>