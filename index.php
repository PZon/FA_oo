<?php
session_start();
require_once('functions&classes.php');

if(isset($_SESSION['userVerified'])){
	header('Location:statements.php?view=cm');
}

$pageFrame=new Carousel();
$frontPage=new ContentFrontPage();
$pageFrame->displayTopPage();
$pageFrame->displayCarousel();
$frontPage->displayFrontPage();
$pageFrame->displayBottomPage();
?>