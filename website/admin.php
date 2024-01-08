<?php require_once 'db.php' ?>
<!DOCTYPE html>
<html lang="ru">
    <head> 
        <meta charset="utf-8">
        <title>Админ панель</title>
        <link rel="stylesheet" href="css/styleadmin.css">
    </head>

    <body> 
        <?php if (isset($_SESSION['check_auth'])) {
            if ($_SESSION['check_auth'] == 'applicant') {
                $_SESSION['err_write'] = 'Нет доступа!';
                header('Location: signin.php');
                die();
            }

            $stmt = $pdo->prepare('SELECT * FROM blanks WHERE user_id = :user_id');
            $stmt->execute([':user_id' => $_SESSION['user_id']]);
            $user = $stmt->fetch(PDO::FETCH_OBJ);
         
            echo '<header>';
                echo '<h1>' . $user->surname . ' ' . $user->name . ' ' . $user->patronymic .' - Админ</h1>'; 
                echo '<a href="logout.php"><img src="images/exit.png" width="60" height="50" alt="Выход"></a>';
            echo '</header>';
            echo '<h2>Список абитуриентов</h2>';
            echo '<section>';

            $users = $pdo->query('SELECT blanks.* FROM blanks JOIN users ON user_id = id AND role = "applicant"');
            while ($row = $users->fetch(PDO::FETCH_ASSOC)) {
                echo '<details>';
                    echo '<summary>'. $row['surname'] . ' ' . $row['name'] . ' ' . $row['patronymic'] . '</summary>';
                    echo '<p>';
                        echo 'email: ' . $row['email'] . '<br>';
                        echo 'Пол: ' . $row['gender'] . '<br>';
                        echo 'День рождения: ' . $row['birthdate'] . '<br>';
                        echo 'Родной город: ' . $row['hometown'] . '<br><br>';
                        echo '[ЕГЭ]<br>';
                        $stmt_scores = $pdo->prepare('SELECT name, scores FROM blanks_disciplines JOIN disciplines
                        ON discipline_id = id WHERE blank_id = :blank_id;');
                        $stmt_scores->execute([':blank_id' => $row['user_id']]);

                        $res = 0;
                        while($discipline = $stmt_scores->fetch(PDO::FETCH_ASSOC)) {
                            echo $discipline['name'] . ': ' . $discipline['scores'] . '<br>';
                            $res += $discipline['scores'];
                        }
                    echo '<br>Иотог: ' . $res;
                    echo '</p>';
                echo '</details>';
            }
            echo '</section>';
        } else {
            $_SESSION['err_write'] = 'Нет доступа!';
            header('Location: signin.php');
        } ?>
    </body>
</html>

<?php

