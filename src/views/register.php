<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Регистрация</title>
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
        <h2>Регистрация</h2>
        <div class="alert <?= $error === null ? 'visually-hidden' : '' ?>">
            <?= $error ?>
        </div>
        <label for="name">Введите имя пользователя</label>
        <input class="input" type="text" id="name" name="name" placeholder="Введите имя пользователя"
               value="<?= $_POST['name'] ?? '' ?>" required>
        <label for="phone">Введите номер телефона</label>
        <input class="input" type="text" id="phone" name="phone" placeholder="Введите номер телефона"
               value="<?= $_POST['phone'] ?? '' ?>" required>
        <label for="email">Введите адрес электронной почты</label>
        <input class="input" type="text" id="email" name="email" placeholder="Введите адрес электронной почты"
               value="<?= $_POST['email'] ?? '' ?>" required>
        <label for="password">Введите пароль</label>
        <input class="input" type="password" id="password" name="password" placeholder="Введите пароль"
               value="<?= $_POST['password'] ?? '' ?>" required>
        <label for="password_verify">Повторите пароль</label>
        <input class="input" type="password" id="password_verify" name="password_verify" placeholder="Повторите пароль"
               value="<?= $_POST['password_verify'] ?? '' ?>" required>
        <button class="input" type="submit">Зарегистрироваться</button>
    </form>
    <form class="form" action="/">
        <button class="input" type="submit" name="controller" value="index">Назад</button>
    </form>
</div>
</body>
</html>