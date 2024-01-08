<?php
require_once 'db.php';

$login = trim($_POST['login']);
$pwd = trim($_POST['pwd']);

if(!empty($login) && !empty($pwd)) {

   $sql = 'SELECT * FROM users WHERE login = :login';
   $params = [':login' => $login];

   $stmt = $pdo->prepare($sql);
   $stmt->execute($params);
   
   $user = $stmt->fetch(PDO::FETCH_OBJ);

   if($user) {
    if(password_verify($pwd, $user->password)) {
        $_SESSION['user_id'] = $user->id;

        if ($user->role == 'applicant') {
            $sql_check = 'SELECT EXISTS(SELECT * FROM blanks WHERE user_id = :user_id)';
            $stmt_check = $pdo->prepare($sql_check);
            $stmt_check->execute([':user_id' => $user->id]);

            if ($stmt_check->fetchColumn()) {
                $_SESSION['check_auth'] = 'applicant';
                header('Location: index.php');
                die();
            } else {
                header('Location: blank.php');
                die();
            }
            header('Location: index.php');
            die();
        } else {
            $sql_check = 'SELECT EXISTS(SELECT * FROM blanks WHERE user_id = :user_id)';
            $stmt_check = $pdo->prepare($sql_check);
            $stmt_check->execute([':user_id' => $user->id]);

            if ($stmt_check->fetchColumn()) {
                $_SESSION['check_auth'] = 'worker';
                header('Location: admin.php');
                die();
            } else {
                header('Location: blankworker.php');
                die();
            }
            header('Location: index.php');
            die();
        }
    } else {
        $_SESSION['err_write'] = 'Неверный логин или пароль!';
        header('Location: signin.php');
        die();
    }
   } else {
    $_SESSION['err_write'] = 'Неверный логин или пароль!';
    header('Location: signin.php');
    die();
   }
} else {
    $_SESSION['err_write'] = 'Пожалуйста, заполните все поля!';
        header('Location: signin.php');
        die();
}