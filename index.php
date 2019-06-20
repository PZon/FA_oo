<?php
require_once('functions&classes.php');

if(isset($_SESSION['userVerified'])){
	header('Location:statements.php?view=cm');
}
?>