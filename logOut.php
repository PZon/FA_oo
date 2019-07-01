<?php
session_start();
//unset($_SESSION['userVerified']);
session_unset();
header('Location: index.php');
?>