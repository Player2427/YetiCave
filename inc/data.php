<?php
require_once('mysql_connect.php');
$select = "SELECT CategoryName as name, CategoryClass as style FROM category";
$res_select = mysqli_query($bd, $select);
$category = mysqli_fetch_all($res_select, MYSQLI_ASSOC);

$lots = [
    [
        'id' => '1',
        'lot-name' => '2014 Rossignol District Snowboard',
        'path' => 'img/lot-1.jpg',
        'lot-rate' => '10999',
        'lot-step' => '1',
        'lot-date' => '2023-03-26',
        'message' => 'Легкий маневренный сноуборд, готовый дать жару в&nbsp;любом парке, растопив снег мощным щелчком и&nbsp;четкими дугами. Стекловолокно Bi-Ax, уложенное в&nbsp;двух направлениях, наделяет этот снаряд отличной гибкостью и&nbsp;отзывчивостью, а&nbsp;симметричная геометрия в&nbsp;сочетании с&nbsp;классическим прогибом кэмбер позволит уверенно держать высокие скорости. А&nbsp;если к&nbsp;концу катального дня сил совсем не&nbsp;останется, просто посмотрите на&nbsp;Вашу доску и&nbsp;улыбнитесь, крутая графика от&nbsp;Шона Кливера еще никого не&nbsp;оставляла равнодушным.',
        'hint' => 'Сноуборд',
        'category' => 'Доски и лыжи',
        'bets' => '0',
    ],
    [
        'id' => '2',
        'path' => 'img/lot-2.jpg',
        'hint' => 'Сноуборд',
        'category' => 'Доски и лыжи',
        'lot-name' => 'DC Ply Mens 2016/2017 Snowboard',
        'bets' => '12',
        'lot-rate' => '15999',
        'lot-step' => '1',
        'lot-date' => '2023-03-24',
        'message' => 'Легкий маневренный сноуборд, готовый дать жару в&nbsp;любом парке, растопив снег мощным щелчком и&nbsp;четкими дугами. Стекловолокно Bi-Ax, уложенное в&nbsp;двух направлениях, наделяет этот снаряд отличной гибкостью и&nbsp;отзывчивостью, а&nbsp;симметричная геометрия в&nbsp;сочетании с&nbsp;классическим прогибом кэмбер позволит уверенно держать высокие скорости. А&nbsp;если к&nbsp;концу катального дня сил совсем не&nbsp;останется, просто посмотрите на&nbsp;Вашу доску и&nbsp;улыбнитесь, крутая графика от&nbsp;Шона Кливера еще никого не&nbsp;оставляла равнодушным.',
    ],
    [
        'id' => '3',
        'path' => 'img/lot-3.jpg',
        'hint' => 'Крепления',
        'category' => 'Крепления',
        'lot-name' => 'Крепления Union Contact Pro 2015 года размер L/XL',
        'bets' => '7',
        'lot-rate' => '8000',
        'lot-step' => '1',
        'lot-date' => '2023-03-25',
        'message' => 'Описание товара',
    ],
    [
        'id' => '4',
        'path' => 'img/lot-4.jpg',
        'hint' => 'Ботинки',
        'category' => 'Ботинки',
        'lot-name' => 'Ботинки для сноуборда DC Mutiny Charocal',
        'bets' => '12',
        'lot-rate' => '10999',
        'lot-step' => '1',
        'lot-date' => '2023-03-25',
        'message' => 'Описание товара',
    ],
    [
        'id' => '5',
        'path' => 'img/lot-5.jpg',
        'hint' => 'Куртка',
        'category' => 'Одежда',
        'lot-name' => 'Куртка для сноуборда DC Mutiny Charocal',
        'bets' => '12',
        'lot-rate' => '10999',
        'lot-step' => '1',
        'lot-date' => '2023-03-25',
        'message' => 'Описание товара',
    ],
    [
        'id' => '6',
        'path' => 'img/lot-6.jpg',
        'hint' => 'Маска',
        'category' => 'Разное',
        'lot-name' => 'Маска Oakley Canopy',
        'bets' => '0',
        'lot-rate' => '5500',
        'lot-step' => '1',
        'lot-date' => '2023-03-25',
        'message' => 'Описание товара',
    ],
];

$users = [
    [
        'id' => '1',
        'username' => 'Игнат',
        'email' => 'ignat.v@gmail.com',
        // 'password' => 'ug0GdVMi',
        'password' => '$2y$10$Tt9P1p4/m3AB4X3v9AkhIeIhzaly3aSsFhE8y46sqROHgqcimYvvq',
    ],
    [
        'id' => '2',
        'username' => 'Константин',
        'email' => 'kitty_93@li.ru',
        // 'password' => 'daecNazD',
        'password' => '$2y$10$6Uq/HOlhzhLzZjTgSOn17ukNWYnls.4pWyOrd550pfU6.cszwTzdi',
    ],
    [
        'id' => '2',
        'username' => 'Даниил',
        'email' => 'warrior07@mail.ru',
        // 'password' => 'oixb3aL8',
        'password' => '$2y$10$jax.lrjrM1NOJHItWwaxVuPlJXvGUa/B7Z6sqqaVzqPAVgpGYIFjK',
    ],
];