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
<form class="form-horizontal" method="post" enctype="multipart/form-data">
    <fieldset>

        <!-- Form Name -->
        <legend>Добавление категории</legend>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="name">Название</label>
            <div class="col-md-4">
                <input id="name" name="name" type="text" placeholder="" class="form-control input-md" value="<?php echo $this->name; ?>">

            </div>
        </div>

        <!-- Textarea -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="description">Описание</label>
            <div class="col-md-4">
                <textarea class="form-control" id="description" name="description"><?php echo $this->description; ?></textarea>
            </div>
        </div>

        <!-- File Button -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="img">Выберите картинку</label>
            <div class="col-md-4">
                <input id="img" name="img" class="input-file" type="file">
            </div>
        </div>

        <!-- Button (Double) -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="reset"></label>
            <div class="col-md-8">
                <button type="reset" id="reset" name="reset" class="btn btn-warning">Очистить</button>
                <button type="submit" id="submit" name="submit" class="btn btn-success">Добавить</button>
            </div>
        </div>

    </fieldset>
</form>
<?php if(!empty($this->msg)){ ?>
    <div class="alert alert-warning" role="alert" style="width: 550px; margin: 0 auto;">
        <?php echo @$this->msg; ?>
    </div><br />
<?php } ?>
<?php include 'footer.php' ?>
