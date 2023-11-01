<?php

use src\models\User;

session_start();

$name = null;
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    $name = $user->getName();
}

require_once 'src/views/index.php';