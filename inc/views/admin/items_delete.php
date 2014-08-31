<?php include 'header.php' ?>
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <ul class="nav navbar-nav">
                <li><a href="<?php echo APP_BASE_URL;?>admin/index">Главная</a></li>
                <li><a href="<?php echo APP_BASE_URL;?>admin/catalog">Работа с каталогом</a></li>
                <li class="active"><a href="<?php echo APP_BASE_URL;?>admin/items">Работа с товарами</a></li>
                <li><a href="<?php echo APP_BASE_URL;?>admin/security">Добавление админов</a></li>
                <li><a href="<?php echo APP_BASE_URL;?>admin/properties">Редактирование характеристик товаров</a></li>
            </ul>
        </div>
    </nav>
    <form method="post">
        <div class="panel panel-default">
            <div class="panel-heading">Список все товаров:</div>
            <div class="panel-body">
                <ul>
                    <?php foreach($this->products as $product){ ?>
                        <li><?php echo $product['name'] ?>&nbsp;&nbsp;||&nbsp;&nbsp;<?php echo $product['description'] ?>&nbsp;&nbsp;||&nbsp;&nbsp;<?php echo $product['price'] ?>$&nbsp;&nbsp;<input type="checkbox" name="id[]" value="<?php echo $product['id']; ?>"></li>
                    <?php }?>
                </ul>
            </div>
        </div>
        <input type="submit" name="delete" id="delete" value="Удалить" class="btn btn-default">
    </form>


    <!-- Вывод сообщений об ошибках -->
<?php if(!empty($this->msg)){ ?>
    <div class="alert alert-warning" role="alert" style="width: 550px; margin: 0 auto;">
        <?php echo @$this->msg; ?>
    </div><br />
<?php } ?>

<?php include 'footer.php' ?>