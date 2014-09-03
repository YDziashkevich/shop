<?php include 'header.php' ?>
<div class="container">
    <div class="col-md-4">
        <div class="login-panel panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Вход для администратора</h3>
            </div>
            <div class="panel-body">
                <form role="form" method="post">
                    <fieldset>
                        <div class="form-group">
                            <input class="form-control" placeholder="Логин" name="login" type="text" autofocus="">
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Пароль" name="password" type="password" value="">
                        </div>
                        <input type="submit" name="submit" id="submit" value="Войти">
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>

    <!-- Вывод сообщений об ошибках -->
<?php if(!empty($this->msg)){ ?>
    <div class="alert alert-warning" role="alert" style="width: 550px; margin: 0 auto;">
        <?php echo @$this->msg ?>
    </div><br />
<?php } ?>
<?php include 'footer.php' ?>