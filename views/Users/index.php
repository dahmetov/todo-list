<h1>Авторизация</h1>
<div class="errors">
    <?php
        echo flash()->display();
    ?>
</div>
<div class="col-sm-6 offset-sm-3">
    <form method='post' action='/users/login/'>
        <div class="form-group">
            <label for="login">Логин</label>
            <input type="text" class="form-control" id="login" placeholder="Введите логин" name="login" value ="<?php if (isset($user["login"])) echo $user["login"];?>">
        </div>

        <div class="form-group">
            <label for="password">Пароль</label>
            <input type="password" class="form-control" id="password" placeholder="Введите пароль" name="password">
        </div>
        <button type="submit" class="btn btn-primary">Войти</button>
    </form>
</div>