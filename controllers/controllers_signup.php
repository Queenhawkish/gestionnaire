<?php
require_once "../config.php";
require_once "../helpers/Database.php";
require_once "../helpers/Form.php";
require_once "../models/Employee.php";

$error = [];

$showForm = true;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["newlastname"])) {
        if (empty($_POST["newlastname"])) {
            $error["newlastname"] = "Veuillez renseigner le champ";
        } else if (strlen($_POST["newlastname"]) < 2) {
            $error["newlastname"] = "Le nom doit contenir au moins 2 caractères";
        } else if (strlen($_POST["newlastname"]) > 50) {
            $error["newlastname"] = "Le nom ne doit pas dépasser 50 caractères";
        } else if (!preg_match(REGEX_NAME, $_POST["newlastname"])) {
            $error["newlastname"] = "Le nom ne doit contenir que des lettres";
        } else {
            $newlastname = $_POST["newlastname"];
        }
    }

    if (isset($_POST["newfirstname"])) {
        if (empty($_POST["newfirstname"])) {
            $error["newfirstname"] = "Veuillez renseigner le champ";
        } else if (strlen($_POST["newfirstname"]) < 2) {
            $error["newfirstname"] = "Le prénom doit contenir au moins 2 caractères";
        } else if (strlen($_POST["newfirstname"]) > 50) {
            $error["newfirstname"] = "Le prénom ne doit pas dépasser 50 caractères";
        } else if (!preg_match(REGEX_NAME, $_POST["newfirstname"])) {
            $error["newfirstname"] = "Le prénom ne doit contenir que des lettres";
        } else {
            $newfirstname = $_POST["newfirstname"];
        }
    }

    if (isset($_POST["newphone"])) {
        if (empty($_POST["newphone"])) {
            $error["newphone"] = "Veuillez renseigner le champ";
        } else if (strlen($_POST["newphone"]) < 10) {
            $error["newphone"] = "Le numéro de téléphone doit contenir au moins 10 caractères";
        } else if (strlen($_POST["newphone"]) > 10) {
            $error["newphone"] = "Le numéro de téléphone ne doit pas dépasser 10 caractères";
        } else if (!preg_match(REGEX_PHONE, $_POST["newphone"])) {
            $error["newphone"] = "Le numéro de téléphone ne doit contenir que des chiffres";
        } else {
            $newphone = $_POST["newphone"];
        }
    }

    if (isset($_POST["newemail"])) {
        if (empty($_POST["newemail"])) {
            $error["newemail"] = "Veuillez renseigner le champ";
        } else if (strlen($_POST["newemail"]) < 2) {
            $error["newemail"] = "L'adresse email doit contenir au moins 2 caractères";
        } else if (strlen($_POST["newemail"]) > 50) {
            $error["newemail"] = "L'adresse email ne doit pas dépasser 50 caractères";
        } else if (!preg_match(REGEX_EMAIL, $_POST["newemail"])) {
            $error["newemail"] = "L'adresse email n'est pas valide";
        } else if (Employee::checkEmail($_POST["newemail"])) {
            $error["newemail"] = "Cette adresse email est déjà utilisée";
        } else {
            $newemail = $_POST["newemail"];
        }
    }

    if (isset($_POST["newpassword"])) {
        if (empty($_POST["newpassword"])) {
            $error["newpassword"] = "Veuillez renseigner le champ";
        } else if (strlen($_POST["newpassword"]) < 8) {
            $error["newpassword"] = "Le mot de passe doit contenir au moins 8 caractères";
        } else if (strlen($_POST["newpassword"]) > 50) {
            $error["newpassword"] = "Le mot de passe ne doit pas dépasser 50 caractères";
        } else if (!preg_match(REGEX_PASSWORD, $_POST["newpassword"])) {
            $error["newpassword"] = "Le mot de passe doit contenir au moins une majuscule, une minuscule, un chiffre et un caractère spécial";
        }
    }

    if (isset($_POST["newpassword2"])) {
        if (empty($_POST["newpassword2"])) {
            $error["newpassword2"] = "Veuillez renseigner le champ";
        } else if ($_POST["newpassword2"] != $_POST["newpassword"]) {
            $error["newpassword2"] = "Les mots de passe ne correspondent pas";
        } else {
            $newpassword = password_hash($_POST["newpassword"], PASSWORD_DEFAULT);
        }
    }

    if (empty($error)) {
        $member = new Employee();
        $showForm = false;
        if ($member->addEmployee($newlastname, $newfirstname, $newphone, $newemail, $newpassword)) {
            $success = "Votre compte a bien été créé";
        } else {
            $error["error"] = "Une erreur est survenue lors de la création de votre compte";
        }
    }
}

include "../views/signup.php";
