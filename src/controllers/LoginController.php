<?php

use src\models\UserProvider;

$pdo = require_once 'db.php';

session_start();

$error = null;

$token = $_POST['smart-token'] ?? null;
if (check_captcha($token)) {

    if (isset($_POST['login'], $_POST['password'])) {
        [
            'login' => $login,
            'password' => $password
        ] = $_POST;

        $userProvider = new UserProvider($pdo);

        if (str_contains($login, '@')) {
            $user = $userProvider->getByEmailAndPassword($login, $password);
        } else {
            $user = $userProvider->getByPhoneAndPassword($login, $password);
        }

        if ($user === null) {
            $error = 'Пользователь с указанными учетными данными не найден';
        } else {
            $_SESSION['user'] = $user;
            header('Location: /?controller=profile');
            die();
        }
    }

} else {
    $error = 'Вы не прошли капчу';
}

if (isset($_GET['controller']) && $_GET['controller'] === 'logout') {
    unset($_SESSION['user']);
    session_destroy();
    header('Location:/');
    die();
}

require_once 'src/views/login.php';



function check_captcha($token): bool
{
    define("SMARTCAPTCHA_SERVER_KEY", 'ysc2_3ddkUb0FisdFfW5aDSzakdckaprJfKYiECzwE5dzd341012e');
    $ch = curl_init();
    $args = http_build_query([
        "secret" => SMARTCAPTCHA_SERVER_KEY,
        "token" => $token,
        "ip" => $_SERVER['REMOTE_ADDR'],
    ]);
    curl_setopt($ch, CURLOPT_URL, "https://smartcaptcha.yandexcloud.net/validate?$args");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 1);

    $server_output = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpcode !== 200) {
        echo "Allow access due to an error: code=$httpcode; message=$server_output\n";
        return true;
    }
    $resp = json_decode($server_output);
    return $resp->status === "ok";
}

