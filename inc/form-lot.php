<?php
session_start();
require_once('../inc/mysql_connect.php');
require_once('../inc/functions.php');
require_once('../inc/helpers.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // переменные
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
    
    foreach ($keys as $key) {
        $_SESSION['new-lot'][$key] = hsc($_POST[$key]);
    }
    $new_lot_id = get_last_lot_id($bd) + 1;
    // Валидация
    if ($lot_name == '') $errors['lot-name'] = 'Введите наименование лота';
    else if (strlen($lot_name) < 4) $errors['lot-name'] = 'Минимум 4 символа';
    if (!search_category($category, get_category($bd))) $errors['category'] = 'Выберете категорию';
    if ($message == '') $errors['message'] = 'Добавьте описание';
    else if (strlen($message) < 20) $errors['message'] = 'Минимум 20 символов';
    if ($lot_rate == '') $errors['lot-rate'] = 'Введите начальную цену';
    else if (!is_numeric($lot_rate)) $errors['lot-rate'] = 'Недопустимый формат';
    else if ($lot_rate < 1) $errors['lot-rate'] = 'Минимальное значение 1';
    else if ($lot_rate > 1000000) $errors['lot-rate'] = 'Максимальная цена 1 000 000';
    if ($lot_step == '') $errors['lot-step'] = 'Введите шаг ставки';
    else if (!is_numeric($lot_step)) $errors['lot-step'] = 'Недопустимый формат';
    else if ($lot_step < 1) $errors['lot-step'] = 'Минимальное значение 1';
    else if ($lot_step > 100000) $errors['lot-step'] = 'Максимальный шаг 100 000';
    if ($lot_date == '') $errors['lot-date'] = 'Выберете дату';

    if (!empty($_FILES['lot_img']['tmp_name'])) {
        $uploadImage = $_FILES['lot_img'];           
        $uploadImageName = trim(strip_tags($uploadImage['name']));
        $uploadImageTmpName = trim(strip_tags($uploadImage['tmp_name']));
        $types = array('image/gif', 'image/png', 'image/jpeg', 'image/pjpeg');
        if (!in_array(mime_content_type($uploadImageTmpName), $types)){
            $errors['file'] = 'Недопустимый тип файла. Допустимо загружать только изображения.';
        }
        $extension = pathinfo($uploadImageName, PATHINFO_EXTENSION);
        $path = '../uploads/lot-' . $new_lot_id . '.' . $extension;
        move_uploaded_file($uploadImageTmpName, $path);
        $_SESSION['new-lot']['path'] = $path;
    } else $errors['file'] = 'Загрузите изображение';
    // Действия по результату валидации
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header('Location: '.$_SERVER['HTTP_REFERER']);
        exit();
    } else {
        $category_id = search_category($category, get_category($bd));
        $category_id = $category_id['id'];
        $user_id = $_SESSION['userid'];
        $insert_user = "INSERT INTO lot (LotName, LotPath, LotPrice, LotStep, LotDate, LotMessage, CategoryID, UserID) 
            VALUES ('$lot_name', '$path', '$lot_rate', '$lot_step', '$lot_date', '$message', '$category_id', '$user_id')";
        $date = [$lot_name, $path, $lot_rate, $lot_step, $lot_date, $message, $category_id, $user_id];
        $stmt = db_get_prepare_stmt($bd, $insert_user, $date);
        mysqli_stmt_execute($stmt);
        header('Location: ../index.php?page=lot');
        exit();
    }

}