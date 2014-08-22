<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Админка</title>
    <meta name="keywords" content="web store, free templates, website templates, CSS, HTML" />
    <meta name="description" content="Web Store Theme - free CSS template provided by templatemo.com" />
    <link href="<?php echo APP_BASE_URL; ?>css/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo APP_BASE_URL; ?>css/admin.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="<?php echo APP_BASE_URL;?>js/jquery.min.js"></script>
</head>
<body style="padding-top: 70px;">
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
<div class="panel panel-default">
    <div class="panel-heading">Список всех каталогов:</div>
    <div class="panel-body">
        <ul>
            <?php foreach($this->catalog as $name){ ?>
                <li><?php echo $name['name'] ?></li>
            <?php }?>
        </ul>
    </div>
</div>
<div>
    <a href="<?php echo APP_BASE_URL; ?>admin/catalog_add">Добавить</a>
    <a href="#">Удалить</a>
    <a href="">Редактирование</a>
</div>
</body>
</html>
