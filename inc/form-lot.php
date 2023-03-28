<?php
session_start();
require_once('../inc/functions.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    unset($_SESSION['errors']);
    unset($_SESSION['new-lot']);
    $keys = ['lot-name', 'category', 'message', 'lot-rate', 'lot-step', 'lot-date'];
    $errors = [];

    $lot_name = hsc($_POST['lot-name']);
    $category = hsc($_POST['category']);
    $message = hsc($_POST['message']);
    $lot_rate = hsc($_POST['lot-rate']);
    $lot_step = hsc($_POST['lot-step']);
    $lot_date = hsc($_POST['lot-date']);
    
    // Нужно будет переделать данные под эти ключи
    foreach ($keys as $key) {
        $_SESSION['new-lot'][$key] = hsc($_POST[$key]);
    }

    // Пока используем эти
    $_SESSION['new-lot']['name'] = hsc($_POST['lot-name']);
    $_SESSION['new-lot']['category'] = hsc($_POST['category']);
    $_SESSION['new-lot']['description'] = hsc($_POST['message']);
    $_SESSION['new-lot']['price'] = hsc($_POST['lot-rate']);
    $_SESSION['new-lot']['lot-step'] = hsc($_POST['lot-step']);
    $_SESSION['new-lot']['date'] = hsc($_POST['lot-date']);
    $_SESSION['new-lot']['bets'] = 0;


    if ($lot_name == '') $errors['lot-name'] = 'Введите наименование лота';
    else if (strlen($lot_name) < 4) $errors['lot-name'] = 'Минимум 4 символа';
    if ($category == 'Выберите категорию') $errors['category'] = 'Выберете категорию';
    if ($message == '') $errors['message'] = 'Добавьте описание';
    else if (strlen($message) < 20) $errors['lot-name'] = 'Минимум 20 символов';
    if ($lot_rate == '') $errors['lot-rate'] = 'Введите начальную цену';
    else if (!is_numeric($lot_rate)) $errors['lot-rate'] = 'Недопустимый формат';
    else if ($lot_rate > 1000000) $errors['lot-rate'] = 'Максимальная цена 1 000 000';
    if ($lot_step == '') $errors['lot-step'] = 'Введите шаг ставки';
    else if (!is_numeric($lot_step)) $errors['lot-step'] = 'Недопустимый формат';
    else if ($lot_step > 100000) $errors['lot-step'] = 'Максимальный шаг 100 000';
    if ($lot_date == '') $errors['lot-date'] = 'Выберете дату';

    if (!empty($_FILES['lot_img']['tmp_name'])) {
        $uploadImage = $_FILES['lot_img'];           
        $uploadImageName = trim(strip_tags($uploadImage['name']));
        $uploadImageTmpName = trim(strip_tags($uploadImage['tmp_name']));
        $types = array('image/gif', 'image/png', 'image/jpeg', 'image/pjpeg');
        if (!in_array($uploadImage['type'], $types)){
            $errors['file'] = 'Недопустимый тип файла. Допустимо загружать только изображения.';
        }
        $extension = pathinfo($uploadImageName, PATHINFO_EXTENSION);
        $path = '../uploads/lot-' . 7 . '.' . $extension;
        move_uploaded_file($uploadImageTmpName, $path);
        $_SESSION['new-lot']['path'] = $path;
    } else $errors['file'] = 'Загрузите изображение';

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header('Location: '.$_SERVER['HTTP_REFERER']);
        exit();
    } else {
        header('Location: ../index.php?page=lot');
        exit();
    }

    // echo 'lot-name - '.$lot_name.'<br>';
    // echo 'category - '.$category.'<br>';
    // echo 'message - '.$message.'<br>';
    // echo 'lot-rate - '.$lot_rate.'<br>';
    // echo 'lot-step - '.$lot_step.'<br>';
    // echo 'lot-date - '.$lot_date.'<br>';
    // echo '<pre>';
    // print_r($_FILES);
    // echo '</pre>';


}