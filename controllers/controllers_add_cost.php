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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    if (!isset($_POST['type'])) 
    {
        $error['type'] = "Le type est obligatoire";
    } 
    else if ($_POST['type'] != 1 && $_POST['type'] != 2 && $_POST['type'] != 3 && $_POST['type'] != 4 && $_POST['type'] != 5) 
    {
        $error['type'] = "Le type est incorrect";
    }

    if (empty($_POST['date'])) 
    {
        $error['date'] = "La date est obligatoire";
    } 
    else if (!preg_match(REGEX_DATE, $_POST['date'])) 
    {
        $error['date'] = "La date est incorrecte";
    } 
    else if (strtotime($_POST['date']) > time()) 
    {
        $error['date'] = "La date ne peut pas être supérieure à la date du jour";
    }

    if (empty($_POST['amount'])) 
    {
        $error['amount'] = "Le montant est obligatoire";
    }

    else if (!preg_match(REGEX_AMOUNT, $_POST['amount']) && !preg_match(REGEX_AMOUNT2, $_POST['amount'])) 
    {
        $error['amount'] = "Le montant est incorrect";
    } 
    else if ($_POST['amount'] < 5.00) 
    {
        $error['amount'] = "Le montant est inférieur au montant minimal remboursable";
    } 
    else if ($_POST['amount'] > 2999.99)
    {
        $error['amount'] = "Le montant est supérieur au montant maximal remboursable sur le site (pour plus d'informations, contactez votre superieur)";
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

        if ($_FILES["proof"]["error"] == 4) 
        {
            $error['proof'] = "Une erreur est survenue lors de la récupération du justificatif."; 
            $error['proof2'] = "Veuillez réessayer";
        } else 
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
        $id_Members = $_SESSION['user']['id'];
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
        $proof = file_get_contents($_FILES['proof']['tmp_name']);
        $proof_name = $_FILES['proof']['name'];
        $proof_base64 = base64_encode($proof);



        $newcost = new Cost();

        if ($newcost->addCost($cost_date, $amount_ht, $amount_ttc, $proof_base64, $proof_name, $id_Members, $id_Reasons, $motive_cost)) 
        {
            $showForm = false;
        } 
        else 
        {
            $error['add'] = "Une erreur est survenue lors de l'ajout de la note de frais";
        }
    }
}

// var_dump($_FILES["proof"]);
// var_dump($error);
// var_dump($_FILES);
// var_dump($_FILES['proof']['name']);
// var_dump($id_Members, $id_Reasons, $cost_date, $amount_ht, $amount_ttc, $motive_cost, $proof_base64, $proof_name, $dec_id);
// var_dump($proof_name, $proof_base64);


include "../views/add_cost.php";
