<?php
if (!empty($_GET)) {
    if (isset($_GET['page'])) $_SESSION['page'] = $_GET['page'];
    if (isset($_GET['lotid'])) {
        if (check_lot($_GET['lotid'])) $_SESSION['lotid'] = $_GET['lotid'];
        else $_SESSION['page'] = '404';
    };
    if (isset($_GET['catid'])) {
        if (check_cat($_GET['catid'])) $_SESSION['catid'] = $_GET['catid'];
        else $_SESSION['page'] = '404';
    };
    header('Location: index.php');
    exit();
} else {
    if (!isset($_SESSION['page']))
        $_SESSION['page'] = 'index';
};
switch ($_SESSION['page']) {
    case 'index':
        $page = 'index';
        $lots = get_open_lots();
        $title = 'Главная';
        break;

    case 'add-lot':
        if (isset($_SESSION['username'])) $page = 'add-lot';
        else $page = '403';
        $title = 'Добавление лота';
        break;

    case 'sign-up':
        $page = 'sign-up';
        $title = 'Регистрация';
        break;

    case 'login':
        $page = 'login';
        $title = 'Вход';
        break;
        
    case 'logout':
        $page = 'logout';
        break;

    case 'all-lots':
        $catsort = $_SESSION['catid'];
        if ($catsort) $catsort = " and Lot.CategoryID='$catsort'";
        $lots = get_open_lots($catsort);
        $page = 'all-lots';
        $title = 'Все лоты';
        break;

    case 'history':
        $page = 'history';
        $title = 'История просмотров';
        break;

    case 'lot':
        $page = 'lot';
        // Тайтл и другие переменные для страницы лота следует брать из базы данных
        $lot = get_lot($_SESSION['lotid']);
        $title = $lot['lot-name'];
        $bets = get_bets($_SESSION['lotid']);
        break;
        
    case 'search':
        $search = $_SESSION['search'];
        if ($search) {
            $search = " and (lot.LotName LIKE '%$search%' OR lot.LotMessage LIKE '%$search%')";
            $lots = get_open_lots($search);
        } else $lots = [];
        // $lots = get_search_lots($_SESSION['search']);
        $page = 'search';
        // Тайтл и другие переменные для страницы лота следует брать из базы данных
        $title = 'Результаты поиска';
        break;
    
    case 'my-bets':
        $page = 'my-bets';
        // Тайтл и другие переменные для страницы лота следует брать из базы данных
        $bets = get_bets_user($_SESSION['userid']);
        $title = 'Мои ставки';
        break;
        
    default:
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
// unset($_SESSION['page']);