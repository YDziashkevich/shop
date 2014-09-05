<?php include 'header.php' ?>
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <ul class="nav navbar-nav">
                <li><a href="<?php echo APP_BASE_URL;?>admin/index">Главная</a></li>
                <li><a href="<?php echo APP_BASE_URL;?>admin/catalog">Работа с каталогом</a></li>
                <li class="active"><a href="<?php echo APP_BASE_URL;?>admin/items">Работа с товарами</a></li>
                <li><a href="<?php echo APP_BASE_URL;?>admin/properties">Редактирование характеристик товаров</a></li>
            </ul>
            <a href="<?php echo APP_BASE_URL; ?>" class="btn btn-default" role="button" style="margin: 10px 0 10px 100px;">Магазин</a>
            <a href="<?php echo APP_BASE_URL."admin/logout"; ?>" class="btn btn-default" role="button" style="margin: 10px 0 10px 100px;">Выйти</a>
        </div>
    </nav>
    <form class="form-horizontal" method="post" enctype="multipart/form-data">
        <fieldset>

            <!-- Form Name -->
            <legend>Редактирование товара</legend>
            <input id="id" name="id" type="hidden" value="<?php echo @$this->id; ?>">
            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="name">Название</label>
                <div class="col-md-4">
                    <input id="name" name="name" type="text" placeholder="" class="form-control input-md" value="<?php echo @$this->name; ?>">

                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="description">Описание</label>
                <div class="col-md-4">
                    <input id="description" name="description" type="text" placeholder="" class="form-control input-md" value="<?php echo @$this->description; ?>">

                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="price">Цена</label>
                <div class="col-md-4">
                    <input id="price" name="price" type="text" placeholder="" class="form-control input-md" value="<?php echo @$this->price; ?>">

                </div>
            </div>

            <?php foreach($this->valueProperties as $one){ ?>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="<?php echo $one['for_input']; ?>"><?php echo $one['property']; ?></label>
                    <div class="col-md-4">
                        <input id="<?php echo $one['for_input']; ?>" name="<?php echo $one['for_input']; ?>" type="text" placeholder="" class="form-control input-md" value="<?php echo @$one['value']; ?>">

                    </div>
                </div>
            <?php } ?>

            <!-- File Button -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="img">Выберите картинку</label>
                <div class="col-md-4">
                    <input type='hidden' name='MAX_FILE_SIZE' value='2000000' />
                    <input id="img" name="img" class="input-file" type="file" accept="image/gif, image/jpeg, image/pjpeg, image/png" value="">
                </div>
            </div>

            <!-- Button (Double) -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="reset"></label>
                <div class="col-md-8">
                    <button type="submit" id="submit" name="submit" class="btn btn-success">Редактировать</button>
                </div>
            </div>

        </fieldset>
    </form>



    <!-- Вывод сообщений об ошибках -->
<?php if(!empty($this->msg)){ ?>
    <div class="alert alert-warning" role="alert" style="width: 550px; margin: 0 auto;">
        <?php
        foreach($this->msg as $msg){
            echo $msg."<br>";
        }
        ?>
    </div><br />
<?php } ?>

<?php include 'footer.php' ?>