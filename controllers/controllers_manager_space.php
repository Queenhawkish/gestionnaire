<?php


session_start();

if (!isset($_SESSION['manager'])) {
    header('Location: ../index.php');
    if (isset($_SESSION['user'])) {
        header('Location: controllers_members_space.php');
        exit;
    }
    exit;
}



require_once "../config.php";
require_once "../helpers/Database.php";
require_once "../helpers/Form.php";
require_once "../models/Manager.php";
require_once "../models/Costs.php";





include "../views/manager_space.php";
