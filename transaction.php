<?php
session_start();
require_once('functions&classes.php');

SupportiveMethods::verifyUser();
$transactionType=$_GET['type'];
$pageFrame=new MainMenu();
$income=new Income();
$expense=new Expense();
/***********************/
$pageFrame->displayTopPage();
$pageFrame->displayMainMenu();

if($transactionType=='I'){
	$income->displayAddIncomeForm($income->getIncomCat($_DB));
}else if($transactionType=='E'){
	$expense->displayAddExpenseForm($expense->getExpenseCat($_DB), $expense->getPayCat($_DB));
}

$pageFrame->displayBottomPage();
?>