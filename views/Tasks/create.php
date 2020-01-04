<h1>Create task</h1>
<div class="errors">
    <?php
        echo flash()->display();
    ?>
</div>
<form method='post' action='/tasks/create/'>
    <div class="form-group">
        <label for="title">Имя</label>
        <input type="text" class="form-control" id="title" placeholder="Введите Ваше имя" name="user_name" value="<?php echo isset($_POST['user_name']) ? $_POST['user_name'] : '' ?>">
    </div>
    <div class="form-group">
        <label for="title">Email адрес</label>
        <input type="text" class="form-control" id="title" placeholder="Введите Ваш Email" name="user_email" value="<?php echo isset($_POST['user_email']) ? $_POST['user_email'] : '' ?>">
    </div>
    <div class="form-group">
        <label for="description">Описание задачи</label>
        <input type="text" class="form-control" id="description" placeholder="Введите описание задачи" name="body" value="<?php echo isset($_POST['body']) ? $_POST['body'] : '' ?>">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>