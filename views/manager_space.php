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
                    <th>Statut</th>
                    <th class="thaction">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach (Cost::getAllCosts() as $cost) {

                ?>
                    <tr>
                        <td><?= $cost["id_cost"] ?></td>
                        <td><?= $cost["cost_date"] ?></td>
                        <td><?= $cost["decision"] ?></td>

                        <td>

                            <a href="../controllers/controllers_cost.php?id=<?= $cost["id_cost"] ?>" class="butaction infos" title="informations">

                                <i class="bi bi-info-circle-fill"></i></a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>


</div>


<?php include "components/footer.php" ?>