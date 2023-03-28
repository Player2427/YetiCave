<?php
session_start();
require_once('inc/functions.php');
require_once('inc/helpers.php');
require_once('inc/data.php');
require_once('inc/page.php');
date_default_timezone_set("Europe/Moscow");
$is_auth = rand(0, 1);

$html = include_template('layout.php', [
    'category' => $category,
    'content' => $content,
    'title' => $title,
    'is_auth' => $is_auth,
    'user_name' => $user_name,
    'lots' => $lots,
]);
print($html);