<?php include 'header.php' ?>
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <ul class="nav navbar-nav">
                <li class="active"><a href="<?php echo APP_BASE_URL;?>admin/index">Главная</a></li>
                <li><a href="<?php echo APP_BASE_URL;?>admin/catalog">Работа с каталогом</a></li>
                <li><a href="<?php echo APP_BASE_URL;?>admin/items">Работа с товарами</a></li>
                <li><a href="<?php echo APP_BASE_URL;?>admin/properties">Редактирование характеристик товаров</a></li>
            </ul>
            <a href="<?php echo APP_BASE_URL."admin/logout"; ?>" class="btn btn-default" role="button" style="margin: 10px 0 10px 100px;">Выйти</a>
        </div>
    </nav>
    <div >
        <p>Добро пожаловать на главную страницу!</p>
        <br>
        <p>Вы можете:</p>
        <ul>
            <li>Добавлять, удалять, редактировать категории</li>
            <li>Добавлять, удалять, редактировать товары</li>
            <li>Добавлять, удалять, редактировать характеристики товаров</li>
        </ul>
    </div>
<?php include 'footer.php' ?>

