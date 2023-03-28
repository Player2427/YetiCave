<?php
unset($_SESSION['username']);
header('Location: ../index.php?page=index');
exit();