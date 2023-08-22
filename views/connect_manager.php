<?php include "components/head.php" ?>
<?php include "components/navbar.php" ?>

<div class="content">
    <form class="connection" action="" method="POST">
        <h2>Connexion espace gestionnaire</h2>
        <input class="membersco" type="text" name="email" placeholder="Adresse email" value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">
        <p class="error"><?= $error["email"] ?? "" ?></p>
        <input class="membersco" type="password" name="password" placeholder="Mot de passe">
        <p class="error"><?= $error["password"] ?? "" ?></p>
        <input class="memberssub" type="submit" name="submit" value="Se connecter">

    </form>
</div>






<div class="footer">
    <?php include "components/footer.php" ?>
</div>