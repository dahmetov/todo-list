<?php
class usersController extends Controller
{
    public function login() {
        if (isset($_POST["login"]))
        {
            $errors = usersController::validateUser($_POST["login"], $_POST["password"]);

            if(count($errors)) {
                flash()->error($errors);
                $this->render("index");
                exit();
            }
            require(ROOT . 'models/User.php');
            $user = new User();
            if ($user = $user->getByLogin($_POST["login"]))
            {
                if(password_verify($_POST['password'], $user['password'])) {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['login'] = $user['login'];
                    flash()->success("Вы успешно вошли как администратор");
                    header("Location: " . PUBLIC_FOLDER . "tasks/index");
                    exit();
                } else {
                    flash()->error("Логин или пароль введены неверно");
                    $this->render("index");
                    exit();
                }

            } else {
                flash()->error("Логин или пароль введены неверно");
                $this->render("index");
                exit();
            }
        }
        $this->render("index");
    }

    public function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['login']);
        flash()->success("Вы успешно вышли из системы");
        header("Location: " . PUBLIC_FOLDER . "tasks/index");
        exit();
    }


    public static function validateUser($login, $password) {
        $errors = [];
        if(!$login) {
            array_push($errors, 'Пожалуйста введите Ваш логин');
        }
        if(!$password) {
            array_push($errors, 'Пожалуйста введите Ваш пароль');
        }
        return $errors;
    }
}