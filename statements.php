<?php 
session_start();
require_once('functions&classes.php');

SupportiveMethods::verifyUser();

$pageFrame=new Framework();
$incomes=new Income();
$expense=new Expense();

$view=$_GET['view'];


$currentYear=date('Y');
$currentMonth=date('m');
if(date('m')==1) $prevMonth=12;
else $prevMonth=date('m')-1;
$currentYM=$currentYear.'-'.$currentMonth.'-01';
$prevYM=$currentYear.'-'.$prevMonth.'-01';
$prevYMEnd=$currentYear.'-'.$prevMonth.'-31';

if($view=='cm'||($view=='cp' && !isset($_POST['dateFrom']))){
 $incomes->getIncomesCM($_DB, $currentYM);
 //$expenses->getExpensesCM($_DB, $currentYM);
}else if($view=='pm'){
 $incomes->getIncomesPM($_DB, $prevYM, $prevYMEnd);
 //$expenses->getExpensesPM($_DB, $prevYM, $prevYMEnd);
}else if($view=='cp' && isset($_POST['dateFrom'])){
 $dateFrom=$_POST['dateFrom'];
 $dateTo=$_POST['dateTo'];
 $incomes->getIncomesCP($_DB, $dateFrom, $dateTo);
 //$expenses->getExpensesCP($_DB, $dateFrom, $dateTo);
}
/******************/
$pageFrame->displayTopPage();
$pageFrame->displayMainMenu();
$incomes->displayStatementHeader($view);

$pageFrame->displayBottomPage();


?>