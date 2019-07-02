<?php
session_start();
require_once('functions&classes.php');

class TransactionVerify{

 function addTransactionVerify($_DB){
	 $userId=$_SESSION['idUser'];
	 $transactionType=$_POST['transactionType'];
	 $transactionDate=filter_input(INPUT_POST,'transactionDate',FILTER_SANITIZE_STRING);
	 $amount=filter_input(INPUT_POST,'amount',FILTER_SANITIZE_STRING);
	 $category=$_POST['Category'];
	 $description=filter_input(INPUT_POST,'description',FILTER_SANITIZE_STRING);
	 if($transactionType=='E') {
	 $payType=filter_input(INPUT_POST,'payType',FILTER_SANITIZE_STRING);
	}
	
	$formValidation=true;
	
	if(is_numeric($amount)==false){
	$formValidation=false;
	$_SESSION['addTransError']='ERROR: Incorrect amount, Use (dot) . (not comma ,) to write decimals' ;
    if($transactionType=='I'){
	  header('Location: transaction.php?type=I');
	 }
	else if($transactionType=='E'){
		 header('Location: transaction.php?type=E');
	 }
	 exit();
	}
	
	if(!is_string($description)){
	$formValidation=false;
	$_SESSION['addTransError']='ERROR: In description you can use just alphanumeric characters';
    if($transactionType=='I')header('Location: transaction.php?type=I');
	else header('Location: transaction.php?type=E');
	 exit();
	}
 
	if($category==0){
	$formValidation=false;
	$_SESSION['addTransError']='ERROR: Category type must be chosen';
    if($transactionType=='I')header('Location: transaction.php?type=I');
	else header('Location: transaction.php?type=E');
	exit();
	}
 
	if(isset($_POST['payType'])){
	 if($payType==0){
		$formValidation=false;
		$_SESSION['addTransError']='ERROR: Payment type must be chosen';
	 header('Location: transaction.php?type=E');
	 exit(); 
	 }
	}
	
	if($formValidation==true){
	 if($transactionType=='I'){	
	  $query=$_DB->prepare('INSERT INTO income VALUES (NULL, :userId, :category, :transactionDate, :amount, :description )');
	 }else if($transactionType=='E'){
	  $query=$_DB->prepare('INSERT INTO expenses VALUES (NULL, :userId, :category, :payType, :transactionDate, :amount, :description )'); 
	  $query->bindValue(':payType', $payType, PDO::PARAM_STR);
	 }
    $query->bindValue(':userId', $userId, PDO::PARAM_STR);
    $query->bindValue(':category', $category, PDO::PARAM_INT);
    $query->bindValue(':transactionDate', $transactionDate, PDO::PARAM_STR);
    $query->bindValue(':amount', $amount, PDO::PARAM_STR);
    $query->bindValue(':description', $description, PDO::PARAM_STR);
    $query->execute();

    $_SESSION['addTransError']='Transaction added successfully';
    if($transactionType=='I')header('Location: transaction.php?type=I');
    else header('Location: transaction.php?type=E');
   }
 }//end function;	
}//end class;

/***********************/

if(isset($_POST['transactionType'])){
	$transaction=new TransactionVerify();
	$transaction->addTransactionVerify($_DB);
}else{
	header ('Location:index.php');
}
?>