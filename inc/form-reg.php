<?php
session_start();
require_once('../inc/mysql_connect.php');
require_once('../inc/functions.php');
require_once('../inc/helpers.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Переменные
    unset($_SESSION['errors_reg']);
    $errors = [];

    $email = hsc($_POST['email']);
    $password = hsc($_POST['password']);
    $name = hsc($_POST['name']);
    $message = hsc($_POST['message']);
    $_SESSION['reg']['email'] = $email;
    $_SESSION['reg']['password'] = $password;
    $_SESSION['reg']['name'] = $name;
    $_SESSION['reg']['message'] = $message;

    $users = get_users($bd);
    $user = searchUserByEmail($email, $users);
    // Валидация
    if ($email == '') $errors['email'] = 'Введите e-mail';
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors['email'] = 'Некорректный формат';
    elseif ($user) $errors['email'] = 'Пользователь с таким e-mail уже существует';
    
    if ($password == '') $errors['password'] = 'Введите пароль';
    
    if ($name == '') $errors['name'] = 'Введите имя';
    elseif (strlen($name) < 4)  $errors['name'] = 'Слишком короткое имя';
    
    if ($message == '') $errors['message'] = 'Введите как с вами связаться';
    elseif (strlen($message) < 15)  $errors['message'] = 'Минимальная длина 15 символов';
    // Действия после валидации
    if (!empty($errors)) {
        $_SESSION['errors_reg'] = $errors;
        header('Location: '.$_SERVER['HTTP_REFERER']);
        exit();
    } else {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $insert_user = "INSERT INTO user (UserName, UserEmail, UserPassword, UserMessage) 
            VALUE ('$name', '$email', '$password', '$message')";
        $date = [$name, $email, $password, $message];
        $stmt = db_get_prepare_stmt($bd, $insert_user, $date);
        // $res_insert = mysqli_query($bd, $insert_user);
        mysqli_stmt_execute($stmt);
        unset($_SESSION['reg']);
        header('Location: ../index.php?page=login');
        exit();
    }
    
    
}