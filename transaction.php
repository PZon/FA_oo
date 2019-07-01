<?php
session_start();
require_once('functions&classes.php');

SupportiveMethods::verifyUser();
$transactionType=$_GET['type'];
?>