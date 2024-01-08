<?php require_once 'db.php' ?>
<!DOCTYPE html>
<html lang="ru">
    <head> 
        <meta charset="utf-8">
        <title>Главная</title>
        <link rel="stylesheet" href="css/styleindex.css">
    </head>

    <body> 
        <?php if(isset($_SESSION['check_auth'])) {
            if ($_SESSION['check_auth'] == 'worker') {
                header('Location: admin.php');
                die();
            }
            $stmt = $pdo->prepare('SELECT * FROM blanks WHERE user_id = :user_id');
            $stmt->execute([':user_id' => $_SESSION['user_id']]);
            $user = $stmt->fetch(PDO::FETCH_OBJ);
         
            echo '<header>';
                echo '<h1>Приветственная страница</h1>'; 
                echo '<a href="logout.php"><img src="images/exit.png" width="60" height="50" alt="Выход"></a>';
            echo '</header>';
            echo '<h2>Здравствуйте, ' . $user->surname . ' ' . $user->name . ' ' . $user->patronymic .'!</h2>';
            echo '<div class="card">';
                echo 'Имя: ' . $user->name . '<br>';
                echo 'Фамилия: ' . $user->surname . '<br>';
                echo 'Отчество: ' . $user->patronymic . '<br>';
                echo 'Email: ' . $user->email . '<br>';
                echo 'Пол: ' . $user->gender . '<br>';
                echo 'День рождения: ' . $user->birthdate . '<br>';
                echo 'Родной город: ' . $user->hometown . '<br><br>';
                echo '[ЕГЭ]<br>';
                $stmt_scores = $pdo->prepare('SELECT name, scores FROM blanks_disciplines JOIN disciplines
                                            ON discipline_id = id WHERE blank_id = :blank_id;');
                $stmt_scores->execute([':blank_id' => $_SESSION['user_id']]);

                $res = 0;
                while($discipline = $stmt_scores->fetch(PDO::FETCH_ASSOC)) {
                    echo $discipline['name'] . ': ' . $discipline['scores'] . '<br>';
                    $res += $discipline['scores'];
                }
                echo '<br>Иотог: ' . $res;
            echo '</div>';
        } else {
            header('Location: signin.php');
        } ?>
    </body>
</html>

<?php

