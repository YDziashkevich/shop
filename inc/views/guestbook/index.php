<?php require 'inc/views/header.php'; ?>
<?php
    if((isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
        var_dump($_REQUEST);
    }

?>
<form class="form-horizontal well" method="post">
    <fieldset>

        <!-- Form Name -->
        <legend>Заполните информацию о себе</legend>

        <!-- Text input-->
        <div class="control-group">
            <label class="control-label" for="userName">Введите имя:</label>
            <div class="controls">
                <input id="userName" name="userName" type="text" placeholder="Представьтесь" class="input-xlarge" value="<? echo @$this->name; ?>" >
            </div>
        </div>

        <!-- Text input-->
        <div class="control-group">
            <label class="control-label" for="userEmail">Введите email:</label>
            <div class="controls">
                <input id="userEmail" name="userEmail" type="text" placeholder="Введите адрес почты" class="input-xlarge" value="<? echo @$this->email; ?>">
            </div>
        </div>

        <!-- Textarea -->
        <div class="control-group">
            <label class="control-label" for="userMsg">Введите текст сообщения:</label>
            <div class="controls">
                <textarea id="userMsg" name="userMsg" placeholder="Оставьте сообщение" value="" ><? echo @$this->message; ?></textarea>
                <p class="help-block" data-name="userMsg"></p>
            </div>
        </div>

        <!-- Prepended text-->
        <div class="control-group">
            <label class="control-label" for="captcha">Введите капчу:</label>
            <div class="controls">
                <div class="input-prepend">
                    <span class="add-on" style="padding: 0;"><img src="<?php echo APP_BASE_URL.'captcha/index'; ?>" ></span>
                    <input id="captcha" name="captcha" class="input-large" placeholder="Введите капчу" type="text">
                </div>
            </div>
        </div>

        <!-- Button -->
        <div class="control-group">
            <label class="control-label" for="submit"></label>
            <div class="controls">
                <button type="reset" id="reset" name="reset" class="btn btn-default">Сброс</button>
                <button type="submit" id="submit" name="submit" class="btn btn-default">Отправить</button>
            </div>
        </div>

    </fieldset>
</form>
<div class="text-center">
    <?php if(!empty($this->msg)){ ?>
       <div class="alert alert-warning" role="alert" style="width: 550px; margin: 0 auto;">
            <?php echo @$this->msg; ?>
       </div><br />
    <?php } ?>

<!-- Форма для сообщений -->
    <?php foreach($this->messages as $message){ ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <?php echo $message['name']; ?>&nbsp;&nbsp;&nbsp;<?php echo $message['time']; ?>
        </div>
        <div class="panel-body"><?php echo $message['message']; ?></div>
    </div><br />
    <?php } ?>
</div>
    <?php echo $this->pagination; ?>

<script>
    $(function(){
        $(document).on('submit', 'form', function(ev){
            var $form = $(this);

            $.ajax({
                url: window.location.href,
                data: $form.serializeArray(),
                type: 'POST',
                success: function(data){
                    if(data.indexOf('alert-warning')>=0){
                        $(data).prependTo($form.parent());
                        $form.remove();
                    } else {
                        window.location.reload();
                    }
                }

            });

            ev.preventDefault();
        });
    });
</script>

<?php require 'inc/views/footer.php'; ?>


