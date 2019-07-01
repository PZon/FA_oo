<?php
session_start();
require_once('functions&classes.php');

class LoginVerify{
 function verifyLogin($_DB){
  $nick=filter_input(INPUT_POST,'nick',FILTER_SANITIZE_STRING);
  $nick=strtoupper($nick);
  $pass=filter_input(INPUT_POST,'pass',FILTER_SANITIZE_STRING);
	 
  $query=$_DB->prepare('select * from users where Nick = :nick');
  $query->bindValue(':nick', $nick, PDO::PARAM_STR);
  $query->execute();
	 
  //echo $query->rowCount();
  $user=$query->fetch();
  if($user && password_verify($pass, $user['Password'])){
	 $_SESSION['userVerified']=$user['Nick'];
	 $_SESSION['idUser']=$user['idUser'];
	 unset($_SESSION['logInError']);
	 header('Location:statements.php?view=cm');
	 }else{
	  $_SESSION['logInError']='<small class="text-danger">Incorrect Login or Password. Please try again</small>';
	  header ('Location:index.php');
	  exit();
	 }
 }
}
/************************/
if(isset($_POST['nick'])){
 $user=new LoginVerify();
 $user->verifyLogin($_DB); 
}else{
 header('Location:index.php');
 exit();
}