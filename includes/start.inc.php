<?php
session_start();
require_once(dirname(__FILE__) . '/db-init.inc.php');
require_once(dirname(__FILE__) . '/user.inc.php');

if (isset($_SESSION['blocked']) && $_SESSION['blocked'] > time()) {
    die('You have been blocked for now ! Maybe try later ?');
}