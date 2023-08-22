<?php include "components/head.php" ?>
<?php include "components/navbar.php" ?>


<?php if ($costFound === true) { ?>

    <div class="content">
        <div id="informations">
            <a href="../controllers/controllers_manager_space.php" title="revenir" class="linkback">
                <i class="bi bi-arrow-left-square-fill goback">Retour</i>
            </a>
            <p class="error"><?= $error['update_decision'] ?? "" ?></p>
            <form class="info" method="POST">
                <ul class="ul">
                    <li>N° <?= $cost["id_cost"] ?></li>
                    <li class="title">Date :</li>
                    <li><?= $cost["cost_date"] ?></li>
                    <li class="title">Type :</li>
                    <li><?= $cost["Reason"] ?></li>
                    <li class="title">Montant HT</li>
                    <li><?= $cost["amount_ht"] ?>€</li>
                    <li class="title">Montant TTC :</li>
                    <li><?= $cost["amount_ttc"] ?>€</li>
                    <li class="title">Motif(s) :</li>
                    <li><?= $cost["motive_cost"] ?></li>
                    <li class="title">Justificatif :</li>
                    <li><a href="<?= $proof ?>" data-lightbox="image-1"><img src="<?= $proof ?>" class="nowproof" alt="justificatif actuel"></a></li>
                    <li class="title">Statut :</li>
                    <li><?= $cost["decision"] ?></li>
                    <?php if ($cost["dec_id"] == 2) { ?>
                        <li class="title">Date décision :</li>
                        <li><?= $cost["decision_date"] ?></li>
                    <?php } else if ($cost["dec_id"] == 3) { ?>
                        <li class="title">Date décision :</li>
                        <li><?= $cost["decision_date"] ?></li>
                        <li class="title">Motif décision :</li>
                        <li><?= $cost["reason_decision"] ?></li>
                </ul>

            <?php }
                    if (isset($_SESSION['user']) && $cost["dec_id"] == 1) { ?>
                <div class="linkupdate">
                    <a href="../controllers/controllers_update_cost.php?id=<?= $cost["id_cost"] ?>" class="update" title="modifier">
                        Modifier
                    </a>
                </div>
            <?php } else if (isset($_SESSION['manager']) && $cost["dec_id"] == 1) { ?>

                <select name="decision" id="decision" class="membersco">
                    <option selected disabled>Action</option>
                    <option value="2" <?= isset($_POST["decision"]) && $_POST["decision"] == 2 ? "selected" : "" ?>>Accepter</option>
                    <option value="3" <?= isset($_POST["decision"]) && $_POST["decision"] == 3 ? "selected" : "" ?>>Refuser</option>
                </select>
                <p class="error"><?= $error['decision'] ?? "" ?></p>

                <textarea name="reason_decision" id="reason_decision" cols="30" rows="5" class="membersco text"><?= htmlspecialchars($_POST["reason_decision"] ?? "Motif du refus") ?></textarea>
                <p class="error"><?= $error['reason_decision'] ?? "" ?></p>
                <button type="submit" class="membersco add">Valider</button>


            <?php } ?>
            </form>
        </div>
    </div>
<?php } else { ?>
    <p class="error">Cette note de frais n'existe pas ou plus</p>
    <a href="../index.php">Retour</a>
<?php } ?>

<?php include "components/footer.php" ?>