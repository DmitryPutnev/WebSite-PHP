<?php require_once 'db.php'; ?>
<!DOCTYPE html>
<html lang="ru">
    <head> 
        <meta charset="utf-8">
        <title>Анкета</title>
        <link rel="stylesheet" href="css/styleform.css">
    </head>

    <body> 
        <h2>Заполнение анкеты</h2>
            <form action="form.php" method="post">
                <label for="name">Имя</label>
                <input type="text" name="name" id="name"><br>
                <label for="surname">Фамилия</label>
                <input type="text" name="surname" id="surname"><br>
                <label for="patronymic">Отчество</label>
                <input type="text" name="patronymic" id="patronymic"><br><br>
                <div class="points">
                    <input type="radio" name="gender" id="male" value="male">
                    <label for="male">Мужчина</label>
                    <input type="radio" name="gender" id="female" value="female">
                    <label for="female">Женщина</label>
                </div>
                <label for="email">eMail</label>
                <input type="email" name="email" id="email"><br>
                <label for="birthdate">Дата рождения</label>
                <input type="date" name="birthdate" id="birthdate"><br>
                <label for="hometown">Родной город</label>
                <input type="text" name="hometown" id="hometown"><br><br>
                <div class="discipline">
                    <select name="first_discipline">
                    <?php
                    $result = $pdo->query('SELECT id, name FROM disciplines');
                    while ($row = $result->fetch(PDO::FETCH_ASSOC))
                        echo '<option value="' . $row['id'] . '">' . $row['name'] . "</option>";
                    ?>
                    </select><pre>      </pre>
                    <input type="number" class="number" name="first_discipline_score">
                </div>
                <div class="discipline">
                    <select name="second_discipline">
                    <?php
                    $result = $pdo->query('SELECT id, name FROM disciplines');
                    while ($row = $result->fetch(PDO::FETCH_ASSOC))
                        echo '<option value="' . $row['id'] . '">' . $row['name'] . "</option>";
                    ?>
                    </select><pre>      </pre>
                    <input type="number" class="number" name="second_discipline_score">
                </div>
                <div class="discipline">
                    <select name="third_discipline">
                    <?php
                    $result = $pdo->query('SELECT id, name FROM disciplines');
                    while ($row = $result->fetch(PDO::FETCH_ASSOC))
                        echo '<option value="' . $row['id'] . '">' . $row['name'] . "</option>";
                    ?>
                    </select><pre>      </pre>
                    <input type="number" class="number" name="third_discipline_score">
                </div><br>
                <button type="submit" class="button">Сохранить</button>
            </form>
        <br>
        <?php if(isset($_SESSION['err_write'])) { 
            echo $_SESSION['err_write'];
            unset($_SESSION['err_write']);
        } ?>
    </body>
</html>