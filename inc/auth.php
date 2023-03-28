<?php
if (isset($_SESSION['username'])) {
    $is_auth = 1;
    $user_name = $_SESSION['username'];
} else
    $is_auth = 0;