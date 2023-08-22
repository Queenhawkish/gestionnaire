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
require_once "../models/Type.php";
require_once "../models/Costs.php";

$error = [];
$showForm = true;


// Vérification de l'id dans l'url, s'il est bien numérique et s'il existe dans la bdd
if (isset($_GET['id']) && !empty($_GET['id'])) {

    if (!ctype_digit($_GET['id'])) {
        header('Location: ../controllers/controllers_members_space.php');
        exit;
    } 
    else 
    {
        $id = strip_tags($_GET['id']);
// Réception des données de la bdd
        $cost = Cost::getCostByIdCost($id);
        $oldproof_base64 = $cost["proof_base64"];
        $openfile = finfo_open();
        $mime_type = finfo_buffer($openfile, $oldproof_base64, FILEINFO_MIME_TYPE);
        $oldproof = "data:" . $mime_type . ";base64," . $oldproof_base64;

        if ($cost === false) {
            header('Location: ../controllers/controllers_members_space.php');
            exit;
        }
    } 
} 
else {
    header('Location: ../controllers/controllers_members_space.php');
    exit;
}

// Si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (!isset($_POST['type'])) 
    {
        $error['type'] = "Le type est obligatoire";
    } 

    if (empty($_POST['date'])) 
    {
        $error['date'] = "La date est obligatoire";
    }

    if (empty($_POST['amount'])) 
    {
        $error['amount'] = "Le montant est obligatoire";
    }

    if (empty($_POST['motive'])) 
    {
        $error['motive'] = "Le motif est obligatoire";
    } 
    else if (strlen($_POST['motive']) > 150) 
    {
        $error['motive'] = "Le motif ne doit pas contenir plus de 150 caractères";
    }

    if (isset($_FILES["proof"])) 
    {
        $tfile = new finfo(FILEINFO_MIME);
        // var_dump($tfile->file($_FILES['proof']['tmp_name']));

        if ($_FILES["proof"]["error"] != 4) 
        {
            if (!str_contains($tfile->file($_FILES['proof']['tmp_name']), "image")) 
            {
                $error['proof'] = "Le format doit être de type image (jpg, jpeg, png)";
            } 
            else if (!str_contains($_FILES["proof"]["type"], "image")) 
            {
                $error['proof'] = "Le format doit être de type image (jpg, jpeg, png)";
            } 
            else if ($_FILES["proof"]["size"] > 1048576) 
            {
                $error['proof'] = "Le justificatif ne doit pas dépasser 1Mo";
            } 
            // else 
            // {
            //     $proof = file_get_contents($_FILES['proof']['tmp_name']);
            //     $proof_name = $_FILES['proof']['name'];
            //     $proof_base64 = base64_encode($proof);
            // }
        } 
    }


    if (empty($error)) 
    {

        $id_Reasons = $_POST['type'];
        $cost_date = $_POST['date'];
        $amount_ttc = $_POST['amount'];

        if ($id_Reasons == 1 || $id_Reasons == 2 || $id_Reasons == 3) 
        {
            $amount_ht = $amount_ttc - ($amount_ttc * 0.2);
        } 
        else 
        {
            $amount_ht = $amount_ttc - ($amount_ttc * 0.1);
        }
        $motive_cost = $_POST['motive'];

        if ($_FILES["proof"]["error"] == 4)
        {
            $newproof_base64 = $cost["proof_base64"];
            $newproof_name = $cost["proof_name"];
        } 
        else 
        {
        $newproof = file_get_contents($_FILES['proof']['tmp_name']);
        $newproof_name = $_FILES['proof']['name'];
        $newproof_base64 = base64_encode($newproof);
        }

        $updateCost = new Cost();
        if ($updateCost->updateCostEmployee($id, $cost_date, $amount_ht, $amount_ttc, $newproof_base64, $newproof_name, $id_Reasons, $motive_cost)) 
        {
            $showForm = false;
            $success = "La dépense a bien été modifiée";
        } 
        else 
        {
            $error['update'] = "La dépense n'a pas pu être modifiée";
        }
        
    }

}




include "../views/update_cost.php";