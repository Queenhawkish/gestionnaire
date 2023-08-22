<?php


session_start();

if (!isset($_SESSION['user'])) {
    header('Location: ../index.php');
    exit;
}

require_once "../config.php";
require_once "../helpers/Database.php";
require_once "../helpers/Form.php";
require_once "../models/Employee.php";
require_once "../models/Costs.php";

$id_members = $_SESSION['user']['id'];


// var_dump($id_members);

if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    Cost::deleteCostById($_GET['id']);
}



include "../views/members_space.php";