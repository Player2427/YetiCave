<?php
session_start();
require_once('../inc/functions.php');
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $search = hsc($_GET['search']);
    $_SESSION['search'] = $search;
    header('Location: ../search?q='.$_GET['search']);
    exit();
}