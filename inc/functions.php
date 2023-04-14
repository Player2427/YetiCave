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
    $h = sprintf("%02d", floor($diff / 3600));
    $min = sprintf("%02d", floor(($diff % 3600) / 60));
    $s = sprintf("%02d", $diff % 60);
    if ($diff <= 0) $res = "00:00:00";
    else $res = "$h:$min:$s";
    return $res;
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
// 
function timer_finishing($date, $diff_user = 3600) {
    $date = strtotime($date);
    $diff = $date - time();
    if ($diff < $diff_user) $res = true;
    else $res = false;
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
function get_bets_user($bd, $user_id) {
    $select = "SELECT BetID, BetPrice, BetTime, LotName, LotDate, LotPath, CategoryName, user_first.UserMessage, lot.LotID FROM bet
    JOIN user ON bet.UserID=user.UserID
    JOIN lot ON bet.LotID=lot.LotID
    JOIN user AS user_first ON lot.UserID=user_first.UserID
    JOIN category ON lot.CategoryID=category.CategoryID
    WHERE bet.UserID='$user_id'
    ORDER BY BetTime DESC";
    return my_query($bd, $select);
}
function last_bet($id) {
    global $bd;
    $select = "SELECT bet.BetID FROM bet, (SELECT MAX(BetPrice) AS BetPrice, LotID FROM bet WHERE LotID=(SELECT lotID FROM bet WHERE BetID=$id) GROUP BY LotID) AS max
    WHERE bet.LotID=MAX.LotID AND bet.BetPrice=MAX.BetPrice;";
    $win_bet = my_query($bd, $select);
    if ($id == $win_bet[0]['BetID']) $res = true;
    else $res = false;
    return $res;
}
function get_lot($lotid) {
    global $bd;
    $select = "SELECT
    Lot.LotId as id,
    LotName as 'lot-name',
    LotPath as path,
    Lot.LotStep as 'lot-step',
    Lot.LotDate as 'lot-date',
    Lot.LotTime as time,
    Lot.LotMessage as message,
    CategoryName as category,
    IFNULL(LotBet, 0) AS bets,
    IFNULL(BetPrice, LotPrice) AS 'lot-rate'
    FROM (SELECT COUNT(BetID) AS LotBet, MAX(BetID) AS BetID, MAX(BetPrice) AS BetPrice, LotID FROM Bet GROUP by LotID) AS Lastbet
    right JOIN Lot ON Lot.LotID=Lastbet.LotID
    JOIN Category ON Lot.CategoryID=Category.CategoryID
    WHERE Lot.LotID=$lotid
    ORDER BY Lot.LotTime DESC";
    $lots = my_query($bd, $select);
    return $lots[0];
}
function check_lot($id) {
    global $bd;
    $select = "SELECT LotID FROM lot WHERE LotID=$id";
    if (empty(my_query($bd, $select))) $res = false;
    else $res = true;
    return $res;
}
?>