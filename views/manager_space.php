<?php include "components/head.php" ?>
<?php include "components/navbar.php" ?>


<div class="content">
    <h3 class="member">Bienvenue dans l'espace de gestion</h3>

    <div class="table">
        <table>
            <thead>
                <tr>
                    <th>N° note de frais</th>
                    <th>Date</th>
                    <th class="media">Type</th>
                    <th class="thaction">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach (Cost::getAllCosts() as $cost) {

                ?>
                    <tr>
                        <td><?= $cost["id_cost"] ?></td>
                        <td><?= $cost["cost_date"] ?></td>
                        <td class="media"><?= $cost["Reason"] ?></td>

                        <td>

                            <a href="../controllers/controllers_cost.php?id=<?= $cost["id_cost"] ?>" class="butaction infos" title="informations">

                                <i class="bi bi-info-circle-fill"></i></a>

                            <i class="bi bi-question-square-fill" title="en cours"></i>

                            <i class="bi bi-x-square" title="refuser"></i>

                            <i class="bi bi-check-square" title="accepter"></i>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>


</div>


<?php include "components/footer.php" ?>