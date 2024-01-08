<?php require_once 'db.php'; ?>
<!DOCTYPE html>
<html lang="ru">
    <head> 
        <meta charset="utf-8">
        <title>Авторизироваться</title>
        <link rel="stylesheet" href="css/signinup.css">
    </head>

    <body> 
        <h2>Вход в личный кабинет абитуриента</h2>
        <div class="card">
            <form action="auth.php" method="post">
                <div class="fields">
                    <label for="login">Логин</label>
                    <input type="text" name="login" id="login" placeholder='Login'><br>
                    <label for="pwd">Пароль</label>
                    <input type="password" name="pwd" id="pwd" placeholder='Password'>
                </div>
                <br>
                <button type="submit" class="button">Авторизироваться</button>
            </form>
            <br>
            <a href="signup.php">Страница регистрации</a>
        </div>
        <br>
        <?php if(isset($_SESSION['err_write'])) { 
            echo $_SESSION['err_write'];
            unset($_SESSION['err_write']);
        } ?>
    </body>
</html>