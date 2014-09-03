<?php include 'header.php' ?>
<div class="container" style="margin: 25%">
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
                        <a href="" class="btn btn-sm btn-success">Войти</a>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php' ?>