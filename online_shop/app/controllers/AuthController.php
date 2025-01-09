<?php
require_once "app/models/User.php";
require_once "BaseController.php";

class AuthController extends BaseController
{
    public function __construct()
    {
        if($_SESSION['email']){
            header("Location: /online_shop/users/index");
        }
        parent::__construct();
    }

    public static function login_view()
    {
        require_once "app/views/auth/login.php";
    }

    public static function register_view()
    {
        require_once "app/views/auth/register.php";
    }

    public static function login_post()
    {
        $post = self::xss($_POST);
        $email = $post['email'] ?? '';
        $password = $post['Password'] ?? '';

        $captcha_response = $_POST['g-recaptcha-response'];

        $user = User::findUser($email);
        ##su backend ucin goolge cpace egerde front entde cykarmadyk yagdayyndada baza gitmez yaly
        $captcha_handle = self::get_captcha_response($captcha_response);
        if($captcha_handle && isset($captcha_response->success) && !$captcha_response->success){
            $_SESSION["error"] = "invalid captcha handle!";
            header("Location: /online_shop/login");
            exit();
        }
        if ($user && password_verify($password, $user['password'])) {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role_id'] = $user['role_id'];
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['last_name'] = $user['last_name'];
            $_SESSION['email'] = $user['email'];
            unset($_SESSION['error']);
            header("Location: /online_shop/products/index");
            // require_once "app/views/dashboard.php";
            // Start a session, set session variables, etc. // Ensure the session is started

        } else {
            $_SESSION["error"] = "Invalid login";
            var_dump($_SESSION);
            header("Location: /online_shop/login");
            exit();
        }
    }

    public static function register()
    {
        $post = self::xss($_POST);
        $first_name = $post['first_name_input'];
        $last_name = $post['last_name_input'];
        $email = $post['email'];
        $password = $post['password'];
        $retype_password = $post['retype_password'];
        $captcha_response = $_POST['g-recaptcha-response'];

        $captcha_handle = self::get_captcha_response($captcha_response);

        if($captcha_handle && isset($captcha_response->success) && !$captcha_response->success){
            $_SESSION["error"] = "invalid captcha handle!";
            header("Location: /online_shop/register");
            exit();
        }
        #egrde birni yazmadyk yagadaynda error berse beyleki yazanlary yiteop gitmez yaly saklamak
        $_SESSION['form_data'] = [
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
        ];


        if ($password !== $retype_password) {
            $_SESSION["error"] = "Passwords do not match!";
            header("Location: /online_shop/register");
            exit;
        }

        //if email exists in db redirect with errors
        $user_find_by_email = User::findUser($email);
        if ($user_find_by_email) {
            // Redirect back with an error message
            $_SESSION["error"] = "User already exists with this email!";
            header("Location: /online_shop/register");
            exit;
        }

        $user = User::create($first_name, $last_name, $email, password_hash($password, PASSWORD_DEFAULT), 2);

        unset($_SESSION['form_data']);
        unset($_SESSION['error']);

        $_SESSION["success"] = "you can now login with the registered email!";
        header("Location: /online_shop/login");
    }
    #eger jogap succes bolsa gecyan
    public static function get_captcha_response($captcha)
    {
        $secret_key = '6LcZ-Z8qAAAAAF7wqBP0338WhA71miK1X-OVbmqG';
        $url = 'https://www.google.com/recaptcha/api/siteverify?secret='
            . $secret_key . '&response=' . $captcha;
        $response = file_get_contents($url);
        return $response;

    }

    public static function logout()
    {
        session_unset();

        // Destroy the session
        session_destroy();

        // Redirect to the login page or homepage
        header("Location: /online_shop/login");
        exit();
    }

    public static function show()
    {
        $user_id = $_GET['id'];
        $user = User::getUser($user_id);

        if ($user) {
            require_once "app/views/users/show.php";
        } else {
            $_SESSION['error'] = "User not found";
            require_once "app/views/404.php";
        }
    }

    public static function test()
    {
        echo 'test';
    }
}
