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
function pagination_url($i) {
    $request_url = explode("?", $_SERVER['REQUEST_URI']);
    return $request_url[0].'?pagination='.$i;
}
function pagination_lots($lots) {
    $count = count($lots);
    if (isset($_GET['pagination']) and $_GET['pagination'] <= count_pages($lots, 9)) $page = $_GET['pagination'];
    else $page = 1;
    $lots = array_slice($lots, ($page-1)*9, $page*9);
    return $lots;
}
function count_pages($lots, $num = '9') {
    $count_lots = count($lots);
    if ($count_lots % $num == 0) $count_pages = $count_lots / $num;
    else $count_pages = (intdiv($count_lots, $num) + 1);
    return $count_pages;
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
function my_query($query) {
    global $bd;
    $res_query = mysqli_query($bd, $query);
    $arr = mysqli_fetch_all($res_query, MYSQLI_ASSOC);
    return $arr;
}
function get_category() {
    $query = "SELECT CategoryName as name, CategoryClass as style, CategoryID as id FROM category";
    return my_query($query);
}
function get_users() {
    $select = "SELECT UserID as id, UserEmail as email, UserName as name, UserPassword as password FROM user";
    return my_query($select);
}
function get_last_lot_id() {
    $select = "SELECT LotID as id FROM lot ORDER BY LotID DESC LIMIT 1";
    $lots = my_query($select);
    return $lots[0]['id'];
}
function get_bets($lotid) {
    $select = "SELECT BetTime AS time, BetPrice AS price, user.UserName AS name FROM bet
    JOIN user ON bet.UserID=user.UserID
    JOIN lot ON bet.LotID=lot.LotID
    WHERE lot.LotID = '$lotid'
    ORDER BY price DESC";
    return my_query($select);
} 
function get_bets_user($user_id) {
    $select = "SELECT BetID, BetPrice, BetTime, LotName, LotDate, LotPath, CategoryName, user_first.UserMessage, lot.LotID FROM bet
    JOIN user ON bet.UserID=user.UserID
    JOIN lot ON bet.LotID=lot.LotID
    JOIN user AS user_first ON lot.UserID=user_first.UserID
    JOIN category ON lot.CategoryID=category.CategoryID
    WHERE bet.UserID='$user_id'
    ORDER BY BetTime DESC";
    return my_query($select);
}
function last_bet($id) {
    $select = "SELECT bet.BetID FROM bet, (SELECT MAX(BetPrice) AS BetPrice, LotID FROM bet WHERE LotID=(SELECT lotID FROM bet WHERE BetID=$id) GROUP BY LotID) AS max
    WHERE bet.LotID=MAX.LotID AND bet.BetPrice=MAX.BetPrice;";
    $win_bet = my_query($select);
    if ($id == $win_bet[0]['BetID']) $res = true;
    else $res = false;
    return $res;
}
function get_lot($lotid) {
    $select = "SELECT
    lot.LotId as id,
    LotName as 'lot-name',
    LotPath as path,
    lot.LotStep as 'lot-step',
    lot.LotDate as 'lot-date',
    lot.LotTime as time,
    lot.LotMessage as message,
    CategoryName as category,
    IFNULL(LotBet, 0) AS bets,
    IFNULL(BetPrice, LotPrice) AS 'lot-rate'
    FROM (SELECT COUNT(BetID) AS LotBet, MAX(BetID) AS BetID, MAX(BetPrice) AS BetPrice, LotID FROM bet GROUP by LotID) AS Lastbet
    right JOIN lot ON lot.LotID=Lastbet.LotID
    JOIN category ON lot.CategoryID=category.CategoryID
    WHERE lot.LotID=$lotid
    ORDER BY lot.LotTime DESC";
    $lots = my_query($select);
    return $lots[0];
}
function check_lot($id) {
    $select = "SELECT LotID FROM lot WHERE LotID=$id";
    if (empty(my_query($select))) $res = false;
    else $res = true;
    return $res;
}
function check_cat($id) {
    $select = "SELECT CategoryID FROM category WHERE CategoryID=$id";
    if (empty(my_query($select))) $res = false;
    else $res = true;
    return $res;
}
function get_open_lots($search = '') {
    $select = "SELECT
    lot.LotId as id,
    LotName as 'lot-name',
    LotPath as path,
    lot.LotStep as 'lot-step',
    lot.LotDate as 'lot-date',
    lot.LotTime as time,
    lot.LotMessage as message,
    CategoryName as category,
    IFNULL(LotBet, 0) AS bets,
    IFNULL(BetPrice, LotPrice) AS 'lot-rate'
    FROM (SELECT COUNT(BetID) AS LotBet, MAX(BetID) AS BetID, MAX(BetPrice) AS BetPrice, LotID FROM bet GROUP by LotID) AS Lastbet
    right JOIN lot ON lot.LotID=Lastbet.LotID
    JOIN category ON lot.CategoryID=category.CategoryID
    WHERE lot.LotOpen=1$search
    ORDER BY lot.LotTime DESC";
    return my_query($select);
}
// Определение победителя
function winner_determination() {
    global $bd;
    $lots = my_query("SELECT LotID, LotDate FROM lot WHERE LotOpen='1'");
    foreach ($lots as $lot) {
        if (timer_finishing($lot['LotDate'], 0)) {
            $users = my_query("SELECT UserID FROM bet WHERE LotID='{$lot['LotID']}' ORDER BY BetPrice DESC LIMIT 1");
            if (!empty($users[0]['UserID'])) {
                $update = "UPDATE lot SET WinUserID='{$users[0]['UserID']}', LotOpen='0' WHERE LotID='{$lot['LotID']}'";
                // Здесь должен быть код для отправки письма о победе пользователю
            }
            else $update = "UPDATE lot SET LotOpen='0' WHERE LotID='{$lot['LotID']}'";
            $res_query = mysqli_query($bd, $update);
        }
    }
}
// функция выводит False если:
// пользователь не авторизован
// лот создан текущим пользователем
// лот закрыт
function show_add_bet_bloc() {
    $lot = my_query("SELECT UserID, LotOpen FROM lot WHERE LotID='{$_SESSION['lotid']}'");
    $res = False;
    if (isset($_SESSION['username']) and $_SESSION['userid'] != $lot[0]['UserID'] and $lot[0]['LotOpen'] == 1) $res = True;
    return $res;
}
?>