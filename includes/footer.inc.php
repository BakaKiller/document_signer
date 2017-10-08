<?php
    if (is_logged_in()) {
        ?>
        <div id="footer">
            Vous êtes connecté-e en tant que<br />
            <?php echo $user->firstname . ' ' . $user->lastname . ' (' . $user->email . ')'; ?><br />
            <a href="logout.php">Se déconnecter</a>
        </div>
        <?php
    }
?>
</body>
</html>