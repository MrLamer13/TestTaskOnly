<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://smartcaptcha.yandexcloud.net/captcha.js" defer></script>
    <title>Авторизация</title>
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
        <h2>Авторизация</h2>
        <div class="alert <?= $error === null ? 'visually-hidden' : '' ?>">
            <?= $error ?>
        </div>
        <label for="login">Введите номер телефона или адрес электронной почты</label>
        <input class="input" type="text" id="login" name="login"
               placeholder="Введите номер телефона или адрес электронной почты" value="<?= $_POST['login'] ?? ''?>" required>
        <label for="password">Введите пароль</label>
        <input class="input" type="password" id="password" name="password" placeholder="Введите пароль" value="<?= $_POST['password'] ?? ''?>" required>
        <button class="input" type="submit">Войти</button>
        <div
                id="captcha-container"
                class="smart-captcha"
                data-sitekey="ysc1_3ddkUb0FisdFfW5aDSzab86DSChRLID7sK6b4Biofc602b22"
        ></div>
    </form>
    <form class="form" action="/">
        <button class="input" type="submit" name="controller" value="index">Назад</button>
    </form>

</div>
</body>
</html>