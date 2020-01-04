<?php

class tasksController extends Controller
{

    public $per_page = 3;

    function index($page = 1, $sort_by = 'created_at', $sort_order = 'desc')
    {
        require(ROOT . 'models/Task.php');
        $tasks = new Task();
        $d['tasks'] = $tasks->showAllTasks($this->per_page, $this->per_page * ($page - 1), $sort_by, $sort_order);
        $d['count'] = $tasks->countAllTasks();
        $d['per_page'] = $this->per_page;
        $d['current_page'] = $page;
        $d['sort_by'] = $sort_by;
        $d['sort_order'] = $sort_order;
        $this->set($d);
        $this->render("index");
    }

    function create()
    {

        if (isset($_POST["user_name"]))
        {
            $errors = tasksController::validateForUser($_POST["user_name"], $_POST["user_email"], $_POST["body"]);

            if(count($errors)) {
                flash()->error($errors);
                $this->render("create");
                exit();
            }
            require(ROOT . 'models/Task.php');
            $task = new Task();
            if ($task->create($this->noHTML($_POST["user_name"]), $this->noHTML($_POST["user_email"]), $this->noHTML($_POST["body"])))
            {
                flash()->success("Задача успешно добавлена");
                header("Location: " . PUBLIC_FOLDER . "tasks/index");
                exit();
            }
        }
        $this->render("create");
    }

    function edit($id)
    {
        require(ROOT . 'models/Task.php');
        $task = new Task();
        $d["task"] = $task->showTask($id);
        if (isset($_POST["submit"]))
        {
            if($_SESSION['user_id']) {
                $errors = tasksController::validateForAdmin($_POST["body"]);

                if(count($errors)) {
                    flash()->error($errors);
                    $this->render("edit");
                    exit();
                }
                if($d['task']['body'] !== $_POST['body']) {
                    $updated_by_admin_at = date('Y-m-d H:i:s');
                } else {
                    $updated_by_admin_at = null;
                }
                if ($task->edit($id, $this->noHTML($_POST["body"]), isset($_POST["done"]) ? 1 : 0, $updated_by_admin_at))
                {
                    flash()->success("Задача успешно отредактирована");
                    header("Location: " . PUBLIC_FOLDER . "tasks/index");
                    exit();
                }
            } else {
                flash()->error("Чтобы отредактировать, войдите в систему");
                header("Location: " . PUBLIC_FOLDER . "tasks/index");
                exit();
            }
        }
        $this->set($d);
        $this->render("edit");
    }

    public static function validateForUser($user_name, $user_email, $body) {
        $errors = [];
        if(!$user_name) {
            array_push($errors, 'Пожалуйста введите Ваше имя');
        }
        if(!$user_email) {
            array_push($errors, 'Пожалуйста введите Ваше email');
        }
        if(!$body) {
            array_push($errors, 'Пожалуйста введите текст задачи');
        }
        if($user_email && !filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, 'Пожалуйста введите корректный email');
        }
        return $errors;
    }

    public static function validateForAdmin($body) {
        $errors = [];
        if(!$body) {
            array_push($errors, 'Пожалуйста введите текст задачи');
        }
        return $errors;
    }

    function noHTML($input, $encoding = 'UTF-8')
    {
        return htmlentities($input, ENT_QUOTES | ENT_HTML5, $encoding);
    }
}