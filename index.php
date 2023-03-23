<?php
$is_auth = rand(0, 1);
session_start();
require_once('helpers.php');
require_once('data.php');
require_once('page.php');

$html = include_template('layout.php', [
    'category' => $category,
    'content' => $content,
    'title' => $title,
    'is_auth' => $is_auth,
    'user_name' => $user_name,
    'lots' => $lots,
]);
print($html);