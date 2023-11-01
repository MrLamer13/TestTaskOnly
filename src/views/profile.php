<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Личный кабинет</title>
    <style>
        body {
            background-color: grey;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .form {
            width: 400px;
            display: flex;
            flex-direction: column;

        }

        .input {
            margin-bottom: 10px;
        }

        .alert {
            background-color: red;
        }
    </style>
</head>
<body>
<div class="container">
    <form method="post" class="form">
        <h2>Личный кабинет</h2>
        <div class="alert <?= $error === null ? 'visually-hidden' : '' ?>">
            <?= $error ?>
        </div>
        <label for="name">Имя пользователя</label>
        <input class="input" type="text" id="name" name="name""
        value="<?= $user->getName() ?>" required>
        <label for="phone">Номер телефона</label>
        <input class="input" type="text" id="phone" name="phone""
        value="<?= $user->getPhone() ?>" required>
        <label for="email">Адрес электронной почты</label>
        <input class="input" type="text" id="email" name="email"
               value="<?= $user->getEmail() ?>" required>
        <label for="password">Введите старый пароль</label>
        <input class="input" type="password" id="old_password" name="old_password" placeholder="Введите старый пароль"
               value="<?= $_POST['old_password'] ?? '' ?>" required>
        <label for="password_verify">Введите новый пароль</label>
        <input class="input" type="password" id="new_password" name="new_password"
               placeholder="Введите новый пароль"
               value="<?= $_POST['new_password'] ?? '' ?>" required>
        <button class="input" type="submit">Сохранить</button>
    </form>
    <form class="form" action="/">
        <button class="input" type="submit" name="controller" value="index">Главная страница</button>
    </form>
    <form class="form" action="/">
        <button class="input" type="submit" name="controller" value="logout">Выйти</button>
    </form>
</div>
</body>
</html>