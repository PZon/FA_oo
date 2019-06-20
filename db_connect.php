<?php
$dbConfig=require_once('db_config.php');

try{
 $_DB=new PDO(
  "mysql:host={$dbConfig['host']};
   dbname={$dbConfig['db']};
   charset=utf8",
   $dbConfig['user'],
   $dbConfig['pass'],
   [PDO::ATTR_EMULATE_PREPARES => false, 
    PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION]);
}catch(PDOException $error){
	//echo $error;
	//echo'<hr>';
	//echo $error->getMessage();
	exit(' :DB Error');
}
?>