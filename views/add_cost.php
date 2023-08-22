<?php include "components/head.php" ?>
<?php include "components/navbar.php"?>



<div class="content" id="addcost">
    <form class="connection" action="" method="POST" enctype="multipart/form-data" novalidate>

        <?php if ($showForm) { ?>

            <h2 class="register cost">Ajouter une note de frais</h2>

            <div class="new">
                <label for="type">Type : </label>
                <p class="error"><?= $error['type'] ?? "" ?></p>
                <select class="membersco" name="type" id="type">
                    <option selected disabled>Selectionner</option>
                    <?php foreach (Type::getAllTypes() as $type) { ?>
                        <option value="<?= $type['id'] ?>" <?= isset($_POST["type"]) && $_POST["type"] == $type["id"] ? "selected" : "" ?>><?= $type['Reason'] ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="new">
                <label for="date">Date du paiement : </label>
                <p class="error"><?= $error['date'] ?? "" ?></p>
                <input class="membersco" type="date" name="date" value="<?= $_POST['date'] ?? date('Y-m-d') ?>">
            </div>

            <div class="new">
                <label for="amount">Montant TTC :</label>
                <p class="error"><?= $error['amount'] ?? "" ?></p>
                <input class="membersco price" type="number" name="amount" id="amount" step="0.01" value="<?= $_POST["amount"] ?? "0.00" ?>">
            </div>

            <div id="amountdetails">

            </div>

            <div class="new">
                <label for="motive">Motif :</label>
                <p class="error"><?= $error['motive'] ?? "" ?></p>
                <textarea class="membersco text" name="motive" id="" cols="35" rows="5" placeholder="Ne pas dépasser 150 caractères"><?= htmlspecialchars($_POST["motive"] ?? "") ?></textarea>
            </div>

            <div class="new">
                <label for="proof">Justificatif :<i class="error"> &#60; 1 Mo </i></label>
                <input class="proof" type="file" name="proof">
                <p class="error"><?= $error['proof'] ?? "" ?></p>
                <p class="error"><?= $error['proof2'] ?? "" ?></p>
            </div>

            <p class="error"><?= $error["add"] ?? "" ?></p>
            
            <input class="membersco add" type="submit" value="Ajouter">
            <a href="controllers_members_space.php" class="back">Retour</a>


    </form>

<?php } else { ?>

    <h2 class="register">Note de frais</h2>
    <p class="register cost">La note de frais a bien été ajoutée</p>
    <a href="../controllers/controllers_add_cost.php" class="signin"> Ajouter une nouvelle note de frais</a>
    <a href="../controllers/controllers_members_space.php" class="signin">Retour</a>
<?php } ?>
</div>


<?php include "components/footer.php" ?>