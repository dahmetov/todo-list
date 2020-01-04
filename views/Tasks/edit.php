<h1>Редактировать задачу</h1>
<div class="errors">
    <?php
        echo flash()->display();
    ?>
</div>
<form method='post' action='/tasks/edit?id=<?php echo $task['id']?>'>
    <div class="form-group">
        <label for="">Текст задачи</label>
        <input type="text" class="form-control" id="body" placeholder="Введите текст задачи" name="body" value ="<?php if (isset($task["body"])) echo $task["body"];?>">
    </div>

    <div class="form-group">
        <label for="">Выполнено</label>
        <input type="checkbox" class="form-control" id="done" name="done" value="1" <?php echo (isset($task["done"]) && $task["done"]) ?  'checked' : '' ?>>
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Редактировать</button>
</form>