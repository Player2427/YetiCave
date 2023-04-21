<?php
session_start();
require_once('inc/functions.php');
require_once('inc/helpers.php');
require_once('inc/data.php');
// require_once('inc/history.php');
require_once('inc/auth.php');
date_default_timezone_set("Europe/Moscow");

if (!empty($_GET)) {
    if (isset($_GET['lotid'])) {
        if (check_lot($_GET['lotid'])) $_SESSION['lotid'] = $_GET['lotid'];
    };
    if (isset($_GET['catid'])) {
        if (check_cat($_GET['catid'])) $_SESSION['catid'] = $_GET['catid'];
    };
};
switch ($_SERVER['REDIRECT_URL']) {
    case '/index/':
    case '/index':
    case '/':
    case '':
    // case '':
        $page = 'index';
        $lots = get_open_lots();
        $title = 'Главная';
        break;

    case '/add-lot/':
    case '/add-lot':
        if (isset($_SESSION['username'])) $page = 'add-lot';
        else $page = '403';
        $title = 'Добавление лота';
        break;

    case '/sign-up/':
    case '/sign-up':
        $page = 'sign-up';
        $title = 'Регистрация';
        break;

    case '/login/':
    case '/login':
        $page = 'login';
        $title = 'Вход';
        break;
        
    case '/logout/':
    case '/logout':
        $page = 'logout';
        break;

    case '/all-lots/':
    case '/all-lots':
        $catsort = $_SESSION['catid'];
        if ($catsort) $catsort = " and Lot.CategoryID='$catsort'";
        $lots = get_open_lots($catsort);
        $page = 'all-lots';
        $title = 'Все лоты';
        break;

    case '/history/':
    case '/history':
        $page = 'history';
        $title = 'История просмотров';
        break;

    case '/lot/':
    case '/lot':
        $page = 'lot';
        $lot = get_lot($_SESSION['lotid']);
        $title = $lot['lot-name'];
        $bets = get_bets($_SESSION['lotid']);
        break;
        
    case '/search/':
    case '/search':
        $search = $_SESSION['search'];
        if ($search) {
            $search = " and (lot.LotName LIKE '%$search%' OR lot.LotMessage LIKE '%$search%')";
            $lots = get_open_lots($search);
        } else $lots = [];
        $page = 'search';
        $title = 'Результаты поиска';
        break;
    
    case '/my-bets/':
    case '/my-bets':
        $page = 'my-bets';
        $bets = get_bets_user($_SESSION['userid']);
        $title = 'Мои ставки';
        break;
        
    default:
        header("HTTP/1.0 404 Not Found");
        $page = '404';
        $title = 'Страницы не существует';
        break;
}
if ($page != 'index') $nav = include_template('blocks/nav.php', ['category' => $category]);
$content = include_template("$page.php", [
    'title' => $title,
    'nav' => $nav,
    'category' => $category,
    'lots' => $lots,
    'lot' => $lot,
    'bets' => $bets,
]);

$html = include_template('layout.php', [
    'category' => $category,
    'content' => $content,
    'title' => $title,
    'is_auth' => $is_auth,
    'user_name' => $user_name,
    'lots' => $lots,
]);
print($html);