<?php
if (isset($_SESSION['page']) && $_SESSION['page'] == 'lot') {
    $new = true;
    if (isset($_COOKIE['history'])) {
        $history_arr = json_decode($_COOKIE['history'], true);
        if (in_array($_SESSION['key'], $history_arr)) $new = false;
    } else {
        $history_arr = [];
    };
    if ($new) array_unshift($history_arr, $_SESSION['key']);
    $history_str = json_encode($history_arr, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
    setcookie('history', $history_str, time() + 3600, '/');
    
}
?>