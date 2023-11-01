<?php

use src\models\User;
use src\models\UserProvider;

$pdo = require_once 'db.php';

session_start();

$error = null;

if (isset($_POST['name'], $_POST['phone'], $_POST['email'], $_POST['password'], $_POST['password_verify'])) {
    [
        'name' => $name,
        'phone' => $phone,
        'email' => $email,
        'password' => $password,
        'password_verify' => $passwordVerify,
    ] = $_POST;

    $userProvider = new UserProvider($pdo);

    if ($password === $passwordVerify) {

        if ($userProvider->checkedUser('name', $name)) {
            $error = 'Пользователь с таким именем уже существует.';
        } elseif ($userProvider->checkedUser('phone', $phone)) {
            $error = 'Пользователь с таким номером телефона уже существует.';
        } elseif ($userProvider->checkedUser('email', $email)) {
            $error = 'Пользователь с таким адресом электронной почты уже существует.';
        } else {

            $user = new User();

            $user->setName($name)
                ->setEmail($email)
                ->setPhone($phone)
                ->setPassword($password);

            if ($userProvider->registerUser($user)) {
                $user = $userProvider->getByEmailAndPassword($email, $password);
                $_SESSION['user'] = $user;
                header('Location: /?controller=profile');
                die();
            } else {
                $error = 'Ошибка сохранения пользователя';
            }
        }

    } else {
        $error = 'Пароли не совпадают';
    }

}

require_once 'src/views/register.php';