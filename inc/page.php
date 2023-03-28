<?php
if (!empty($_GET)) {
    if (isset($_GET['page'])) $_SESSION['page'] = $_GET['page'];
    if (isset($_GET['lot'])) {
        $_SESSION['key'] = $_GET['lot'];
        if (!isset($lots[$_SESSION['key']])) $_SESSION['page'] = '404';;
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
        $title = 'Главная';
        break;

    case 'add-lot':
        $page = 'add-lot';
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

    case 'all-lots':
        $page = 'all-lots';
        $title = 'Все лоты';
        break;

    case 'lot':
        $page = 'lot';
        // Тайтл и другие переменные для страницы лота следует брать из базы данных
        if (isset($_SESSION['key'])) {
            $title = $lots[$_SESSION['key']]['name'];
            $lot = $lots[$_SESSION['key']];
        } else {
            $title = $_SESSION['new-lot']['lot-name'];
            $lot = $_SESSION['new-lot'];
        }
        unset($_SESSION['key']);
        break;
        
    case 'search':
        $page = 'search';
        // Тайтл и другие переменные для страницы лота следует брать из базы данных
        $title = 'Результаты поиска';
        break;
    
    case 'my-bets':
        $page = 'my-bets';
        // Тайтл и другие переменные для страницы лота следует брать из базы данных
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
]);
// unset($_SESSION['page']);