<?php require_once 'db.php'; ?>
<!DOCTYPE html>
<html lang="ru">
    <head> 
        <meta charset="utf-8">
        <title>Регистрация</title>
        <link rel="stylesheet" href="css/signinup.css">
    </head>

    <body> 
        <h2>Регистрация личного кабинета абитуриента</h2>
        <div class="card">
            <form action="reg.php" method="post">
                <div class="fields">
                    <label for="login">Логин</label>
                    <input type="text" name="login" id="login" placeholder='Login'><br>
                    <label for="pwd">Пароль</label>
                    <input type="password" name="pwd" id="pwd" placeholder='Password'><br>
                </div>
                <div class="points">
                    <input type="radio" name="role" id="role1" value="applicant" checked>
                    <label for="role1">абитуриент</label>
                    <input type="radio" name="role" id="role2" value="worker">
                    <label for="role2">работник</label>
                </div>
                <br>
                <button type="submit" class="button">Зарегистрироваться</button>
            </form>
            <br>
            <a href="signin.php">Страница авторизации </a>
        </div>
        <br>
        <?php if(isset($_SESSION['err_write'])) { 
            echo $_SESSION['err_write'];
            unset($_SESSION['err_write']);
        } ?>
    </body>
</html>

