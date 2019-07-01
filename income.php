<?php
class Income{
 function getIncomesCM($_DB, $currentYM){
	 $sqlQueryI=$_DB->query("SELECT i.idIncome, i.idIncomeCat, i.incomeDate, i.incomeAmount, i.incomeDescr, c.nameCatI FROM income i 
	 JOIN in_cat c ON (c.idCatI=i.idIncomeCat) 
	 WHERE i.idUser={$_SESSION['idUser']} AND i.incomeDate >= '$currentYM'
	 UNION
	 SELECT i.idIncome, i.idIncomeCat, i.incomeDate, i.incomeAmount, i.incomeDescr, u.nameUserCatIn FROM income i 
	 JOIN user_in_cat u ON (u.idUserCatIn=i.idIncomeCat)
	 WHERE i.idUser={$_SESSION['idUser']} AND i.incomeDate >= '$currentYM'
	 ORDER BY incomeDate");
	 $incomes=$sqlQueryI->fetchAll();
	 return $incomes;
 }
 
 function getIncomesPM($_DB, $prevYM, $prevYMEnd){
	 $sqlQueryI=$_DB->query("SELECT i.idIncome, i.idIncomeCat, i.incomeDate, i.incomeAmount, i.incomeDescr, c.nameCatI FROM income i 
	 JOIN in_cat c ON (c.idCatI=i.idIncomeCat)
	 WHERE i.idUser={$_SESSION['idUser']} 
	 AND i.incomeDate BETWEEN '$prevYM' AND '$prevYMEnd' 
	 UNION
	 SELECT i.idIncome, i.idIncomeCat, i.incomeDate, i.incomeAmount, i.incomeDescr, u.nameUserCatIn FROM income i 
	 JOIN user_in_cat u ON (u.idUserCatIn=i.idIncomeCat)
	 WHERE i.idUser={$_SESSION['idUser']} 
	 AND i.incomeDate BETWEEN '$prevYM' AND '$prevYMEnd'ORDER BY incomeDate");
	 $incomes=$sqlQueryI->fetchAll();
	 return $incomes;
 }
 
 function getIncomesCP($_DB, $dateFrom, $dateTo){
	 $sqlQueryI=$_DB->query("SELECT i.idIncome, i.idIncomeCat, i.incomeDate, i.incomeAmount, i.incomeDescr, c.nameCatI FROM income i 
	 JOIN in_cat c ON (c.idCatI=i.idIncomeCat)
	 WHERE i.idUser={$_SESSION['idUser']} 
	 AND i.incomeDate BETWEEN '$dateFrom' AND '$dateTo' 
	 UNION
	 SELECT i.idIncome, i.idIncomeCat, i.incomeDate, i.incomeAmount, i.incomeDescr, u.nameUserCatIn FROM income i 
	 JOIN user_in_cat u ON (u.idUserCatIn=i.idIncomeCat)
	 WHERE i.idUser={$_SESSION['idUser']} 
	 AND i.incomeDate BETWEEN '$dateFrom' AND '$dateTo' ORDER BY incomeDate");
	 $incomes=$sqlQueryI->fetchAll();
	 return $incomes;
 }
 
 function displayStatementHeader($view){
?>
	<main>
	<div id="mainPage" class="container">
	 <div class="row mb-5">
	   <div class="col-sm-12 col-md-8">
		<h5>Welcome to Finance Assitant: <br /><?= $_SESSION['userVerified']?></h5>
	   </div>
	   <div class="col-sm-12 col-md-4">
		<div class="dropdown">
		  <button class="btn btn-warning dropdown-toggle" type="button" id="menuStatement" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class='fas fa-chart-line'></i> Statements</button>
		  <div class="dropdown-menu" aria-labelledby="menuStatement">
		   <a class="dropdown-item" href="statements.php?view=cm">&#9656; Current Month</a>
		   <a class="dropdown-item" href="statements.php?view=pm">&#9656; Previous Month</a>
		   <a class="dropdown-item" href="statements.php?view=cp">&#9656; Custom Period</a>
		  </div>
		</div>
	   </div>
	  </div>
	<?php
		if($view=='cp'){
			SupportiveMethods::displayStatementDatepicker();
		}
	?>
	<hr>
<?php
 }

}//class end
?>