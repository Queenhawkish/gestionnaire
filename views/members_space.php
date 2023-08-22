<?php include "components/head.php" ?>
<?php include "components/navbar.php" ?>

<div class="content">
    <h3 class="member">Bienvenue <?= $_SESSION['user']['firstname'] ?></h3>
    
    <a href="../controllers/controllers_add_cost.php" class="addcost">Ajouter une note de frais</a>

    <div class="table">
        <table>
            <thead>
                <tr>
                    <th>N° note de frais</th>
                    <th class="media">Type</th>
                    <th>Statut</th>
                    <th class="thaction">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach (Cost::getCostById($id_members) as $cost) { 
                    
                    $proof_base64 = $cost["proof_base64"];
                    $openfile = finfo_open();
                    $mime_type = finfo_buffer($openfile, $proof_base64, FILEINFO_MIME_TYPE);
                    $proof = "data:" . $mime_type . ";base64," . $proof_base64;
                    
                    ?>
                    <tr>
                        <td><?= $cost["id_cost"] ?></td>
                        <td class="media"><?= $cost["Reason"] ?></td>
                        <td><?= $cost["decision"] ?></td>

                        <td>


                            <a href="../controllers/controllers_cost.php?id=<?= $cost["id_cost"] ?>" class="butaction infos" title="informations">

                                <i class="bi bi-info-circle-fill"></i></a>

                            <button class="butaction delete" title="supprimer" data-id="<?= $cost["id_cost"] ?>">
                                <i class="bi bi-trash3-fill" data-id="<?= $cost["id_cost"] ?>"></i>
                            </button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

</div>

<?php include "components/footer.php" ?>