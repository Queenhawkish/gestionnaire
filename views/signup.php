<?php include "components/head.php" ?>
<?php include "components/navbar.php" ?>

<div class="content">
        <?php if ($showForm) { ?>
    <form class="connection" action="" method="POST">
            <h2>S'inscrire</h2>
            <div class="form">
                <div class="new">
                    <label for="newlastname">Veuillez entrer votre nom :<i class="error">*<?= $error['newlastname'] ?? '' ?></i></label>
                    <input class="membersco" id="lastname" type="text" name="newlastname" placeholder="ex : Doe" value="<?= htmlspecialchars($_POST["newlastname"] ?? "") ?>">
                </div>

                <div class="new">
                    <label for="newfirstname">Veuillez entrer votre prénom :<i class="error">*<?= $error['newfirstname'] ?? '' ?></i></label>
                    <input class="membersco" type="text" name="newfirstname" placeholder="ex : John" value="<?= htmlspecialchars($_POST["newfirstname"] ?? "") ?>">
                </div>

                <div class="new">
                    <label for="newemail">Veuillez entrer votre adresse email :<i class="error">*<?= $error['newemail'] ?? '' ?></i></label>
                    <input class="membersco" type="text" name="newemail" placeholder="ex : doe.john@exemple.fr" value="<?= htmlspecialchars($_POST["newemail"] ?? "") ?>">
                </div>

                <div class="new">
                    <label for="newphone">Veuillez entrer votre numéro de téléphone :<i class="error">*<?= $error["newphone"] ?? "" ?></i></label>
                    <input class="membersco" type="text" name="newphone" placeholder="ex : 0548792648" value="<?= htmlspecialchars($_POST["newphone"] ?? "") ?>">
                </div>

                <div class="new">
                    <label for="newpassword">Veuillez entrer votre mot de passe :<i class="error">*<?= $error['newpassword'] ?? '' ?></i></label>
                    <input class="membersco" type="password" name="newpassword" placeholder="Mot de passe">
                </div>

                <div class="new">
                    <label for="newpassword2">Veuillez confirmer votre mot de passe :<i class="error">*<?= $error['newpassword2'] ?? '' ?></i></label>
                    <input class="membersco" type="password" name="newpassword2" placeholder="Confirmer le mot de passe">
                </div>

            </div>
            <p class="error">Champs obligatoire *</p>
            <input class="membersco butsignup" type="submit" name="submit" value="S'incrire">
            <div class="co mymargintop">

                <p class="already">Déjà un compte ?</p>
                <a href="../controllers/controllers_connect_members.php" class="signin">Se connecter</a>
            </div>
            
    </form>
    <?php } else { ?>
        <?php if (isset($success)) { ?>
        <div class="connection">
            <h2 class="register"><?= $success ?></h2>
            <a href="../controllers/controllers_connect_members.php" class="signin">Se connecter</a>
        <?php } else { ?>
            <h2 class="register"><?= $error["error"] ?></h2>
            <a href="../controllers/controllers_signup.php" class="signin">Réessayer</a>
        <?php } ?>

        </div>
    <?php } ?>
</div>







<?php include "components/footer.php" ?>