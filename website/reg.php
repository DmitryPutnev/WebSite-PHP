<?php
require_once 'db.php';

$login = trim($_POST['login']);
$pwd = trim($_POST['pwd']);
$role = trim($_POST['role']);

// Проверка на ввод всех полей
if(!empty($login) && !empty($pwd)) {
    // Проверка на существование пользователя
    $sql_check = 'SELECT EXISTS(SELECT login FROM users WHERE login = :login)';
    $stmt_check = $pdo->prepare($sql_check);
    $stmt_check->execute([':login' => $login]);

    if ($stmt_check->fetchColumn()) {
        $_SESSION['err_write'] ='Пользователь с таким логином уже существует!';
        header('Location: signup.php');
        die();
    }

    // Регистрация пользователя
    $pws = password_hash($pwd, PASSWORD_DEFAULT); // Шифрование пароля

    $sql = 'INSERT INTO users (login, password, role) VALUES (:login, :pws, :role)';
    $params = [':login' => $login, ':pws' => $pws, ':role' => $role];

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);

    $_SESSION['err_write'] = 'Вы успешно зарегистрировались!';
    header('Location: signin.php');
    die();

} else {
    $_SESSION['err_write'] ='Пожалуйста, заполните все поля!';
    header('Location: signup.php');
    die();
}

