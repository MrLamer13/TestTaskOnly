<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Вход</title>
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
    </style>
</head>
<body>
<div class="container">
    <?php if ($name === null) : ?>
        <h1>Добро пожаловать!</h1>
        <form class="form" action="/">
            <button class="input" type="submit" name="controller" value="login">Войти</button>
            <button class="input" type="submit" name="controller" value="register">Зарегистрироваться</button>
        </form>
    <?php else: ?>
        <h1>Добро пожаловать, <?= $name ?>!</h1>
        <form class="form" action="/">
            <button class="input" type="submit" name="controller" value="profile">Личный кабинет</button>
        </form>
        <form class="form" action="/">
            <button class="input" type="submit" name="controller" value="logout">Выйти</button>
        </form>
    <?php endif; ?>
</div>
</body>
</html>