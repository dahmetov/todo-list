<h1>Задачи</h1>
<div class="errors">
    <?php
        echo flash()->display();
    ?>
</div>
<div class="row col-md-12 centered">
    <table class="table table-striped custab">
        <thead>
        <a href="/tasks/create/" class="btn btn-primary btn-xs pull-right"><b>+</b> Добавить задачу</a>
        <tr>
            <th><a href="/tasks/index?page=<?php echo $current_page ?>&sort_by=user_name&sort_order=<?php echo $sort_by === 'user_name' ? $sort_order === 'desc' ? 'asc' : 'desc' : 'asc' ?>">Имя пользователя</a></th>
            <th><a href="/tasks/index?page=<?php echo $current_page ?>&sort_by=user_email&sort_order=<?php echo $sort_by === 'user_email' ? $sort_order === 'desc' ? 'asc' : 'desc' : 'asc' ?>">Email</th>
            <th>Текст задачи</th>
            <th class="text-center"><a href="/tasks/index?page=<?php echo $current_page ?>&sort_by=done&sort_order=<?php echo $sort_by === 'done' ? $sort_order === 'desc' ? 'asc' : 'desc' : 'asc' ?>">Статус</th>
            <?php if(isset($_SESSION['user_id']) && $_SESSION['user_id']):?>
            <th></th>
            <?php endif; ?>
        </tr>
        </thead>
        <?php
        foreach ($tasks as $task)
        {
            $edited = $task['updated_by_admin_at'] ? '(Отредактировано администратором)' : '';
            $status = $task['done'] ? 'Выполнено '.$edited : 'Не выполнено '.$edited ;
            $id = $task['id'];

            echo '<tr>';
            echo "<td>" . $task['user_name'] . "</td>";
            echo "<td>" . $task['user_email'] . "</td>";
            echo "<td>" . $task['body'] . "</td>";
            echo "<td>" . $status . "</td>";

            if (isset($_SESSION['user_id']) && $_SESSION['user_id']) {
                echo "<td><a href='/tasks/edit?id=$id' class='btn btn-primary'>Редактировать</a></td>";
            }


            echo "</tr>";
        }
        ?>
    </table>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <?php
                for ($i = 1; $i <= ceil($count[0] / $per_page); $i++) {
                    echo '<li class="page-item"><a class="page-link" href="/tasks/index?page='.$i.'&sort_by='.$sort_by.'&sort_order='.$sort_order.'">' . $i . '</a></li>';
                }
            ?>
        </ul>
    </nav>
</div>