<?php
require_once 'db.php';

$name = trim($_POST['name']);
$surname = trim($_POST['surname']);
$patronymic = trim($_POST['patronymic']);
$email = trim($_POST['email']);
$gender = trim($_POST['gender']);
$birthdate = trim($_POST['birthdate']);
$hometown = trim($_POST['hometown']);


if (!empty($name) && !empty($surname) && !empty($patronymic) && !empty($email) && !empty($gender) && !empty($birthdate) && !empty($hometown)) {
    
        $sql = 'INSERT INTO blanks (user_id, name, surname, patronymic, email, gender, birthdate, hometown)
                VALUES (:user_id, :name, :surname, :patronymic, :email, :gender, :birthdate, :hometown)';
        $params = [':user_id' => $_SESSION['user_id'], ':name' => $name, ':surname' => $surname, ':patronymic' => $patronymic, ':email' => $email,
                    ':gender' => $gender, ':birthdate' => $birthdate, ':hometown' => $hometown];
    
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        
        $_SESSION['check_auth'] = 'worker';
        header('Location: index.php');
        die();
} else {
    $_SESSION['err_write'] = 'Пожалуйста, заполните все поля!';
    header('Location: blankworker.php');
    die();
}