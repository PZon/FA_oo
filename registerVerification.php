<?php
session_start();
require_once('functions&classes.php');

class RegisterVerify{
 
function verifyRegistration($_DB){
  $nick=filter_input(INPUT_POST,'nick',FILTER_SANITIZE_STRING);
  $nick = strtoupper($nick);
  $email=filter_input(INPUT_POST,'email',FILTER_VALIDATE_EMAIL);
  $pass1=filter_input(INPUT_POST,'pass1',FILTER_SANITIZE_STRING);
  $pass2=filter_input(INPUT_POST,'pass2',FILTER_SANITIZE_STRING);
  $_SESSION['tmp_nick']=$nick;
  $_SESSION['tmp_email']=$email;
  
  if(empty($email)){
   header('Location: registerForm.php');
   $_SESSION['regError']='ERROR: You entered some incorrect data!<br /> Please try again.';
  }else{
   $formVerification=true;
	
	if(!ctype_alnum($nick)||!ctype_alnum($pass1)){
	 $formVerification=false;
	 $_SESSION['regError']='ERROR: All fields can have just alphanumeric characters';
     header('Location: registerForm.php');
	 exit();
	}
	if(strlen($nick)>20){
	 $formVerification=false;
	 $_SESSION['regError']='ERROR: Nick can have up to 20 characters';
     header('Location: registerForm.php');
	 exit();	
	}
	
	$queryNick=$_DB->prepare('select * from users where Nick = :nick');
    $queryNick->bindValue(':nick', $nick, PDO::PARAM_STR);
	$queryNick->execute();
	
	if($queryNick->rowCount()>0){
	 $formVerification=false;
	 $_SESSION['regError']='ERROR: Login already in use. ';
     header('Location: registerForm.php');
	 exit();	 
	}
	
	$queryEmail=$_DB->prepare('select * from users where  Email = :email');
    $queryEmail->bindValue(':email', $email, PDO::PARAM_STR);
	$queryEmail->execute();
	
	if($queryEmail->rowCount()>0){
	 $formVerification=false;
	 $_SESSION['regError']='ERROR: Email already in use. ';
     header('Location: registerForm.php');
	 exit();	 
	}
	
	if($pass1!=$pass2){
	 $formVerification=false;
	 $_SESSION['regError']='ERROR: You have enetered two different passwords';
     header('Location: registerForm.php');exit();
	}else if(strlen($pass1)<8 || strlen($pass1)>20){
	 $formVerification=false;
	 $_SESSION['regError']='ERROR: Password must have between 8 - 20 characters';
     header('Location: registerForm.php');exit();
	}else if(ctype_alpha($pass1)){
	 $formVerification=false;
	 $_SESSION['regError']='ERROR: Password must have at least 8 characters with at least one digit';
     header('Location: registerForm.php');exit();
	}else if (ctype_digit($pass1)){
	 $formVerification=false;
	 $_SESSION['regError']='ERROR: Password must have digit & alphabetic characters';
     header('Location: registerForm.php');exit();
	}
	
	/*	$captchaKey="secretkey";
	$checkCaptcha=file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$captchaKey.'&response='.$_POST['g-recaptcha-response']);
	$captchaRespond=json_decode($checkCaptcha);
	
	if(!($captchaRespond->success)){
	 $formVerification=false;
	 $_SESSION['regError']='ERROR: Confirm you are not a BOT';
     header('Location: registerForm.php');exit();
	}*/
   }
  
  if($formVerification==true){
   $pass_hash=password_hash($pass1, PASSWORD_DEFAULT);
   $query=$_DB->prepare('insert into users values (NULL,:Nick, :Email, :Password)');
   $query->bindValue(':Nick', $nick, PDO::PARAM_STR);
   $query->bindValue(':Email', $email, PDO::PARAM_STR);
   $query->bindValue(':Password', $pass_hash, PDO::PARAM_STR);
   $query->execute();
   $_SESSION['logInError']='<small class="text-success">Registration successful. Please login</small>';
   header ('Location:index.php');
  } 
 }
}
/***********************/
if(isset($_POST['email'])){
 $newUser= new RegisterVerify();
 $newUser->verifyRegistration($_DB);
}else{
 header('Location:registerForm.php');
 exit();
}