<?php
require_once('includes/start.inc.php');
if (!isset($_GET['ref'])) {
    $message = 'Aucun document n\'a été spécifié !';
    redirect('index.php', $message);
} else if (!($doc = $db->read(doc::$TABLE, $_GET['ref'], 'ref')->fetch())) {
    $message = 'Ce document n\'existe pas !';
    redirect('index.php', $message);
}

$doc = new doc($_GET['ref']);

header('Content-Type: application/pdf');
header("Content-disposition: attachment; filename='$doc->name'");

echo $doc->file;