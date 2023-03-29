<?php
function format_price($price) {
    $price = ceil($price);
    if ($price / 1000 >= 1) {
        $price = number_format($price, 0, ',', ' ');
    }
    return $price.' ₽';
}
function time_diff($two) {
    $tomorrow = strtotime($two);
    $diff = $tomorrow - time();
    if ($diff <= 0) return "00:00:00";
    $h = sprintf("%02d", floor($diff / 3600));
    $min = sprintf("%02d", floor(($diff % 3600) / 60));
    $s = sprintf("%02d", $diff % 60);
    return "$h:$min:$s";
}

function hsc($input) {
    return htmlspecialchars(trim($input));
}
function searchUserByEmail($email, $users) {
    $result = null;
    foreach ($users as $user) {
        if ($user['email'] == $email) {
            $result = $user;
            break;
        }
    }
    return $result;
}
?>