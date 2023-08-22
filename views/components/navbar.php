<nav>
    <ul class="nav">
        <li><a href="../controllers/controllers_connect_manager.php">Gestionnaire</a></li>
        <li><a href="../controllers/controllers_connect_members.php">Employés</a></li>
        <?php if (isset($_SESSION['user']) || isset($_SESSION['manager'])) { ?>
            <li><a href="../controllers/controllers_disconnect.php"><i class="logout">Déconnexion </i> <i class="bi bi-box-arrow-right"></i></a></li>
        <?php } ?>
    </ul>
</nav>