<?php


session_start();


require_once "../config.php";
require_once "../helpers/Database.php";
require_once "../helpers/Form.php";
require_once "../models/Manager.php";
require_once "../models/Costs.php";

$costFound = false;

if (isset($_GET['id']) && !empty($_GET['id'])) {

     $id = strip_tags($_GET['id']);

    $costDetails = new Cost();
    $cost = $costDetails->getCostByIdCost($id);

    if ($cost != false) {
        $costFound = true;
        $id = strip_tags($_GET['id']);
        
        $proof_base64 = $cost["proof_base64"];
        $openfile = finfo_open();
        $mime_type = finfo_buffer($openfile, $proof_base64, FILEINFO_MIME_TYPE);
        $proof = "data:" . $mime_type . ";base64," . $proof_base64;
    }
}
else {
    header('Location: ../index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (empty($_POST['decision'])){
        $error['decision'] = "La décision est obligatoire";
    }
    else if ($_POST['decision'] != 2 && $_POST['decision'] != 3){
        $error['decision'] = "Cette décision n'existe pas";
    }
    if ($_POST['decision'] == 3 && $_POST['reason_decision'] == "Motif du refus"){
        $error['reason_decision'] = "Le commentaire est obligatoire";
    }

    if (empty($error)) {
        $decision = $_POST['decision'];

        if ($decision == 2){
            $reason_decision = "Accepté";
        }
        else if ($decision == 3){
            $reason_decision = $_POST['reason_decision'];
        }
        $decision_date = date("Y-m-d");

        $costdec = new Cost();
        if ($costdec->updateCostDecision($id, $decision, $decision_date, $reason_decision)) {
            header('Location: ../controllers/controllers_manager_space.php');
            exit;
        }
        else {
            $error['update_decision'] = "La décision n'a pas pu être enregistrée";
        }
        

        // header('Location: ../controllers/controllers_manager_space.php');
        // exit;
    }
}





include "../views/cost.php";