            <footer>
                <a href="#">Mentions légales - MA</a>
                <script src="../node_modules/lightbox2/dist/js/lightbox-plus-jquery.js"></script>
                <script src="../assets/script/script.js"></script>
            </footer>
        </div>

        <div id="confirm">
            <p>Êtes-vous sûr de vouloir supprimer cette note de frais ?</p>
            <div class="buttons">
                <a href="../controllers/controllers_members_space.php" title="annuler">
                    <i class="bi bi-x-circle-fill del"></i></a>
                <a href="../controllers/controllers_members_space.php?action=delete&id=<?= $cost["id_cost"] ?>" id="suppr" title="supprimer">
                    <i class="bi bi-check-circle-fill del"></i></a>
            </div>
        </div>

</body>

</html>