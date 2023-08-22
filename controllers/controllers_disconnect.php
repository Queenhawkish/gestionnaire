<?php

session_start();

if (isset($_SESSION['user']) || isset($_SESSION['manager'])) {
    session_unset();
    session_destroy();
    header('Location: ../controllers/controllers_home.php');
    exit;
} else {
    header('Location: ../controllers/controllers_home.php');
    exit;
}