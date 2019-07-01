<?php 
session_start();
require_once('functions&classes.php');

SupportiveMethods::verifyUser();
$view=$_GET['view'];
$pageFrame=new Framework();
$income=new Income();
$expense=new Expense();

$currentYear=date('Y');
$currentMonth=date('m');
if(date('m')==1) $prevMonth=12;
else $prevMonth=date('m')-1;
$currentYM=$currentYear.'-'.$currentMonth.'-01';
$prevYM=$currentYear.'-'.$prevMonth.'-01';
$prevYMEnd=$currentYear.'-'.$prevMonth.'-31';

if($view=='cm'||($view=='cp' && !isset($_POST['dateFrom']))){
 $incomes=$income->getIncomesCM($_DB, $currentYM);
 $expenses=$expense->getExpensesCM($_DB, $currentYM);
}else if($view=='pm'){
 $incomes=$income->getIncomesPM($_DB, $prevYM, $prevYMEnd);
 $expenses=$expense->getExpensesPM($_DB, $prevYM, $prevYMEnd);
}else if($view=='cp' && isset($_POST['dateFrom'])){
 $dateFrom=$_POST['dateFrom'];
 $dateTo=$_POST['dateTo'];
 $incomes=$income->getIncomesCP($_DB, $dateFrom, $dateTo);
 $expenses=$expense->getExpensesCP($_DB, $dateFrom, $dateTo);
}
/******************/
$pageFrame->displayTopPage();
$pageFrame->displayMainMenu();
$pageFrame->displayStatementHeader($view);
$income->displayIncomes($incomes);
$expense->displayExpense($expenses);
$income->displayAddIncomeB($income->getIncomCat($_DB));
$expense->displayAddExpenseB($expense->getPayCat($_DB),$expense->getExpenseCat($_DB));

$pageFrame->displayBottomPage();


?>