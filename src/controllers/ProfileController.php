<?php

use src\models\UserProvider;

$pdo = require_once 'db.php';

session_start();

$error = null;

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
} else {
    header('Location: /');
}

if (isset($_POST['name'], $_POST['phone'], $_POST['email'], $_POST['old_password'], $_POST['new_password'])) {
    [
        'name' => $name,
        'phone' => $phone,
        'email' => $email,
        'old_password' => $oldPassword,
        'new_password' => $newPassword,
    ] = $_POST;

    $userProvider = new UserProvider($pdo);

    if ($user->getPassword() === $oldPassword) {

        $user->setName($name)
            ->setEmail($email)
            ->setPhone($phone)
            ->setPassword($newPassword);

        if ($userProvider->updateUser($user)) {
            $_SESSION['user'] = $user;
        } else {
            $error = 'Ошибка сохранения пользователя';
        }

    } else {
        $error = 'Вы ввели неверный пароль';
    }

}

require_once 'src/views/profile.php';