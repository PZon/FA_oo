<?php
session_start();
require_once('functions&classes.php');

if(isset($_SESSION['userVerified'])){
	header('Location:statements.php?view=cm');
}

$topPage=new Framework();
$frontPage=new ContentFrontPage();
$topPage->displayTopPage();
$topPage->displayCarousel();
$frontPage->displayFrontPage();


$topPage->displayBottomPage();
?>