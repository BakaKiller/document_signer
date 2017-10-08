<?php
require_once(dirname(__FILE__) . '/db-init.inc.php');
require_once(dirname(__FILE__) . '/user.inc.php');
require_once(dirname(__FILE__) . '/doc.inc.php');
require_once(dirname(__FILE__) . '/lib.inc.php');
session_start();

if (isset($_SESSION['blocked']) && $_SESSION['blocked'] > time()) {
    die('You have been blocked for now ! Maybe try later ?');
}

$user = get_user();