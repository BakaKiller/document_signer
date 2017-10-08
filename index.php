<?php
require_once('includes/start.inc.php');

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false) {
    header('Location: login.php');
}

include_once('includes/header.inc.php');
?>
<div id="content" class="container-fluid">
    <div class="row justify-content-md-center">
        <div class="col-6">
            <form>

            </form>
        </div>
    </div>
</div>
</body>
</html>