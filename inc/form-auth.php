<?php
session_start();
require_once('../inc/functions.php');
require_once('../inc/userdata.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    unset($_SESSION['errors']);
    $errors = [];

    $email = hsc($_POST['email']);
    $password = hsc($_POST['password']);
    $_SESSION['new-auch']['email'] = $email;
    $_SESSION['new-auch']['password'] = $password;
    $user = searchUserByEmail($email, $users);

    if ($email == '') $errors['email'] = 'Введите e-mail';
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors['email'] = 'Некорректный формат';
    elseif (!$user) $errors['email'] = 'Незарегистрированный e-mail';
    if ($password == '') $errors['password'] = 'Введите пароль';
    else if (!password_verify($password, $user['password'])) $errors['password'] = 'Неверный пароль';
    // Добавить валидацию

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header('Location: '.$_SERVER['HTTP_REFERER']);
        exit();
    } else {
        $_SESSION['username'] = $user['username'];
        header('Location: ../index.php?page=index');
        exit();
    }
    
    
}