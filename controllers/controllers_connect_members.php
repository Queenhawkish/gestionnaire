<?php

session_start();

if (isset($_SESSION['user'])) {
    header('Location: ../controllers/controllers_members_space.php');
    exit;
}

if (isset($_SESSION['manager'])) {
    header('Location: ../controllers/controllers_manager_space.php');
    // $error['connect'] = "Vous êtes déjà connecté en tant qu'employé ! <br> Veuillez vous déconnecter pour vous connecter en tant que gestionnaire"; --> A faire avec un cookie <p class="error"><?= $error["connect"] ?? "" ? ></p>
    exit;
}

require_once "../config.php";
require_once "../helpers/Database.php";
require_once "../helpers/Form.php";

require_once "../models/Employee.php";

$error = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST["email"];
    $password = $_POST["password"];

    if (empty($email)) {
        $error['email'] = "Veuillez renseigner votre email";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error['email'] = "Veuillez renseigner un email valide";
    }

    if (empty($password)) {
        $error['password'] = "Veuillez renseigner votre mot de passe";
    }

    if (empty($error)) {
        if (!Employee::checkEmail($email)) {

            $error['email'] = "Email incorrect";
        } else {
            if (Employee::checkPassword($email, $password)) {
                $_SESSION['user'] = Employee::getEmployee($email);
                unset($_SESSION['user']['password']);
                header('Location: ../controllers/controllers_members_space.php');
                exit;
            } else {
                $error['password'] = "Mot de passe incorrect";
            }
        }
    }
}


include "../views/connect_members.php";
