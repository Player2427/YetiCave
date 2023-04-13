<?php
$bd = mysqli_connect('127.0.0.1', 'yeticave', 'yeticave', 'yeticave');
mysqli_set_charset($bd, "utf8");
$select = "SELECT UserEmail as email, UserName as name, UserPassword as password FROM user";
$res_select = mysqli_query($bd, $select);
$users = mysqli_fetch_all($res_select, MYSQLI_ASSOC);
