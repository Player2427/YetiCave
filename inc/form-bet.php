<?php
session_start();
require_once('../inc/mysql_connect.php');
require_once('../inc/functions.php');
require_once('../inc/helpers.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    unset($_SESSION['errors']);
    $errors = [];

    $cost = hsc($_POST['cost']);
    if ($cost == '') $errors['cost'] = 'Введите вашу ставку';
    else if (!is_numeric($cost)) $errors['cost'] = 'Недопустимый формат';
    else if ($cost < $_SESSION['min-bet-price']) $errors['cost'] = "Минимальное значение {$_SESSION['min-bet-price']}";
    else if ($cost > 999999999) $errors['cost'] = 'Максимальная ставка 999 999 999';

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header('Location: '.$_SERVER['HTTP_REFERER']);
        exit();
    } else {
        $lot_id = $_SESSION['lotid'];
        $user_id = $_SESSION['userid'];
        $insert_user = "INSERT INTO bet (BetPrice, UserID, LotID) 
            VALUES ('$cost', '$user_id', '$lot_id')";
        $date = [$cost, $user_id, $lot_id];
        $stmt = db_get_prepare_stmt($bd, $insert_user, $date);
        mysqli_stmt_execute($stmt);
        header('Location: ../index.php?page=lot');
        exit();
    }

}