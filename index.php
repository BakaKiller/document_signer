<?php
require_once('includes/start.inc.php');

if (!is_logged_in()) {
    redirect('login.php');
}

include_once('includes/header.inc.php');
?>
<div id="content" class="container-fluid">
    <div class="row">
        <div class="col">
            <table class="table table-stripped table-hover">
                <thead>
                <tr>
                    <th>Document</th>
                    <th>Date</th>
                    <th>Version</th>
                    <th>Signé</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach (doc::get_all() as $doc) {
                    ?>
                    <tr>
                        <td><a href="get_file.php?ref=<?php echo $doc->ref; ?>" target="_blank"><?php echo $doc->name; ?></a></td>
                        <td><?php echo date('d/m/Y', $doc->datecreation); ?></td>
                        <td><?php echo $doc->lastverion; ?></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
include_once('includes/footer.inc.php');