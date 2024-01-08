<?php
require_once 'db.php';

$name = trim($_POST['name']);
$surname = trim($_POST['surname']);
$patronymic = trim($_POST['patronymic']);
$email = trim($_POST['email']);
$gender = trim($_POST['gender']);
$birthdate = trim($_POST['birthdate']);
$hometown = trim($_POST['hometown']);

$first_discipline = trim($_POST['first_discipline']);
$first_discipline_score = trim($_POST['first_discipline_score']);
$second_discipline = trim($_POST['second_discipline']);
$second_discipline_score = trim($_POST['second_discipline_score']);
$third_discipline = trim($_POST['third_discipline']);
$third_discipline_score = trim($_POST['third_discipline_score']);

if (!empty($name) && !empty($surname) && !empty($patronymic) && !empty($email) && !empty($gender) &&
    !empty($birthdate) && !empty($hometown) && !empty($first_discipline) && !empty($first_discipline_score) &&
    !empty($second_discipline) && !empty($second_discipline_score) && !empty($third_discipline) && !empty($third_discipline_score)) {
    
        $sql = 'INSERT INTO blanks (user_id, name, surname, patronymic, email, gender, birthdate, hometown)
                VALUES (:user_id, :name, :surname, :patronymic, :email, :gender, :birthdate, :hometown)';
        $params = [':user_id' => $_SESSION['user_id'], ':name' => $name, ':surname' => $surname, ':patronymic' => $patronymic, ':email' => $email,
                    ':gender' => $gender, ':birthdate' => $birthdate, ':hometown' => $hometown];
    
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);

        $sql = 'INSERT INTO blanks_disciplines (blank_id, discipline_id, scores) VALUES (:blank_id, :discipline_id, :scores)';
        $params = [':blank_id' => $_SESSION['user_id'], ':discipline_id' => $first_discipline, ':scores' => $first_discipline_score];
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);

        $params = [':blank_id' => $_SESSION['user_id'], ':discipline_id' => $second_discipline, ':scores' => $second_discipline_score];
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);

        $params = [':blank_id' => $_SESSION['user_id'], ':discipline_id' => $third_discipline, ':scores' => $third_discipline_score];
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        
        $_SESSION['check_auth'] = 'applicant';
        header('Location: index.php');
        die();
} else {
    $_SESSION['err_write'] = 'Пожалуйста, заполните все поля!';
    header('Location: blank.php');
    die();
}