<?php
// функции обработки строк
function format_price($price, $currency = '₽') {
    $price = ceil($price);
    if ($price / 1000 >= 1) {
        $price = number_format($price, 0, ',', ' ');
    }
    return $price.' '.$currency;
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
function format_datetime($date) {
    $origin = strtotime($date);
    $target = time();
    $interval = $target - $origin;
    $min = intdiv($interval, 60)%60;
    $hours = intdiv($interval, 3600);
    if ($interval < 55) $res = (intdiv($interval, 5) + 1) * 5 . " секунд назад";
    else if ($interval < 3600) {
        if ($min == 1) $res = 'Минуту назад';
        else $res = $min . " " . get_noun_plural_form($min, 'минуту', 'минуты', 'минут') . " назад";}
    else if ($interval < 86400) {
        if ($hours == 1) $res = 'Час назад';
        else $res = $hours . " " . get_noun_plural_form($hours, 'час', 'часа', 'часов') . " назад";}
    else $res = date('d.m.y в H:i', $origin);
    return $res;
}
// функции поиска в масиве
function searchUserByEmail($email, $users) {
    $result = false;
    foreach ($users as $user) {
        if ($user['email'] == $email) {
            $result = $user;
            break;
        }
    }
    return $result;
}
function search_category($name, $category) {
    $result = false;
    foreach ($category as $item) {
        if ($item['name'] == $name) {
            $result = $item;
            break;
        }
    }
    return $result;
}
// функции запроса в бд
function my_query($bd, $query) {
    $res_query = mysqli_query($bd, $query);
    $arr = mysqli_fetch_all($res_query, MYSQLI_ASSOC);
    return $arr;
}
function get_category($bd) {
    $query = "SELECT CategoryName as name, CategoryClass as style, CategoryID as id FROM category";
    return my_query($bd, $query);
}
function get_users($bd) {
    $select = "SELECT UserID as id, UserEmail as email, UserName as name, UserPassword as password FROM user";
    return my_query($bd, $select);
}
function get_last_lot_id($bd) {
    $select = "SELECT LotID as id FROM lot ORDER BY LotID DESC LIMIT 1";
    $lots = my_query($bd, $select);
    return $lots[0]['id'];
}
function get_bets($bd, $lotid) {
    $select = "SELECT BetTime AS time, BetPrice AS price, user.UserName AS name FROM bet
    JOIN user ON bet.UserID=user.UserID
    JOIN lot ON bet.LotID=lot.LotID
    WHERE lot.LotID = '$lotid'
    ORDER BY price DESC";
    return my_query($bd, $select);
} 
?>