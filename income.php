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
 
 function displayIncomes($incomes){
?>
	  <div class="row">
	<table class="table table-hover table-bordered">
	  <thead>
		<tr class="bg-success">
		  <th class="tbStyle" colspan="5">INCOMES</th>
		</tr>
		<tr class="bg-dark">
		  <th scope="col">Date</th>
		  <th scope="col">Amount</th>
		  <th scope="col">Category</th>
		  <th scope="col">Description</th>
		  <th scope="col">Options</th>
		</tr>
	  </thead>
	  <tbody>
	   <?php
		foreach($incomes as $row){
			echo"<tr>
			 <td>{$row['incomeDate']}</td>
			 <td>{$row['incomeAmount']}</td>
			 <td>{$row['nameCatI']}</td>
			 <td>{$row['incomeDescr']}</td>
			 <th>";
			 $this->editIncomeIcon()."</th>
			</tr>";
		}
	   ?>
	  </tbody>
  </table>
 </div>
<?php
 }

function editIncomeIcon(){
	?>
<a href="#" title="Edit&Remove" data-toggle="modal" data-target="#editIncome"><i class="fas fa-edit"></i></a>

<!--- edit Transation MODAL -->
	<div class="modal fade" id="editIncome" tabindex="-1" role="dialog" aria-labelledby="editTransaction" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="editTransactionLabel">Edit Transaction</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			<form action="editTransactionVerify.php">
			 <input type="text" class="form-control" id="userId" value="$_SESSION" hidden>
			<input type="text" class="form-control" id="transactionType" value="$_SESSION" hidden>
			<input type="text" class="form-control" id="transactionId" value="$_SESSION" hidden>
			  <div class="form-group">
				<label for="transactionDate" class="col-form-label">Date:</label>
				<input type="text" class="form-control" id="transactionDate" placeholder="$_SESSION">
			  </div>
			  <div class="form-group">
				<label for="amount" class="col-form-label">Amount:</label>
				<input type="text" class="form-control" id="amount" placeholder="$_SESSION">
			  </div>
			  <div class="form-group">
				<label for="category" class="col-form-label">Category:</label>
				<input type="text" class="form-control" id="Category" placeholder="$_SESSION">
			  </div>
			  <div class="form-group">
				<label for="description" class="col-form-label">Description:</label>
				<input type="text" class="form-control" id="description" maxlength="50" placeholder="$_SESSION">
			  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#removeIncome">Remove transaction</button>
			<button type="submit" class="btn btn-warning">Save changes</button>
		  </div>
		  </form>
		 </div>
		</div>
	  </div>
	</div>
<!--- remove transaction Modal -->
	<div class="modal fade" id="removeIncome" tabindex="-1" role="dialog" aria-labelledby="removeTransaction" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
		<div id="removeTransModal" class="modal-content">
		  <div class="modal-header">
			<h6 class="modal-title text-danger" id="removeTransactionLabel">Remove transaction !!!</h6>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			<p class="text-danger">Please confirm you want to remove this transaction?</p>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
			<a class="btn btn-danger" href="removeTransaction.php" role="button" >Yes</a>
		  </div>
		</div>
	  </div>
	</div>
<!--- end modal -->
<?php
}

function displayAddIncomeB($catI){
?>
 <div id="transBtns" class="row mt-5 justify-content-md-center">
 <button type="button" class="m-1  btn btn-outline-success btn-lg col-md-5" data-toggle="modal" data-target="#addIncome">Add income</button>
 
 <!--- Add income MODAL -->
	<div class="modal fade" id="addIncome" tabindex="-1" role="dialog" aria-labelledby="addIncome" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="addIncomeLabel">Add income:</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			<form action="addTransactionVerify.php" method="post">
			<input type="text" class="form-control" id="transactionType" value="I" name="transactionType" hidden>
			 <div class="form-group">
			  <label for="incomeDate" class="col-form-label">Date:</label>
			  <input type="text" class="form-control" id="incomeDate" name="transactionDate" required>
			 </div>
			 <div class="form-group">
				<label for="amountI" class="col-form-label">Amount:</label>
				<input type="text" class="form-control" id="amountI" name="amount" required>
			 </div>
			 <div class="form-group">
			  <label for="Category" class="col-form-label">Category:</label>
			  <div class="input-group mb-3">
				<select class="custom-select" id="selectCatI" name="Category" required>
				<option value="0">Choose...</option>
				 <?php
				 foreach($catI as $row){
				 echo "<option value=\"{$row['idCatI']}\">".$row['nameCatI']."</option>";
				 }
				 ?>
				 </select>
				</div>
			  </div>
			  <div class="form-group">
				<label for="descriptionI" class="col-form-label">Description:</label>
				<input type="text" class="form-control" id="descriptionI" maxlength="50" name="description" required>
			  </div>

		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			<button type="submit" class="btn btn-warning">Save income</button>
		  </div>
		  </form>
		 </div> 
		</div>
	  </div>
	</div>
<!--- end modal -->
<?php
}

function getIncomCat($_DB){
 $sqlQueryI=$_DB->query("SELECT idCatI, nameCatI FROM in_cat 
 UNION 
 SELECT idUserCatIn, nameUserCatIn FROM user_in_cat 
 WHERE idUser={$_SESSION['idUser']}");
 $catI=$sqlQueryI->fetchAll();
 return $catI;
}

 function displayAddIncomeForm($catI){
?>

<main>
 <article>
 <div id="mainPage" class="container">
  <div class="row">
   <div class="col-sm-12 ">
    <h5>Welcome to Finance Assitant: <?=$_SESSION['userVerified']?></h5>
   </div>
  </div><hr>
  <h5>Add Income</h5><br>
  <?php
  if(isset($_SESSION['addTransError'])){
	echo '<p class="text-danger text-center">';
	echo $_SESSION['addTransError'];
	echo '</p>';
    unset ($_SESSION['addTransError']);
  }
  ?>
	<form action="addTransactionVerify.php" method="post">
	 <input type="text" class="form-control" id="transactionType" value="I" name="transactionType" hidden>
	 <div class="form-row justify-content-md-center">
	  <div class="form-group col-md-3">
		<label for="transactionDate" class="col-form-label">Date:</label>
		<input type="text" class="form-control" id="transactionDate" name="transactionDate" required>
	  </div>
	  <div class="form-group col-md-3">
		<label for="amount" class="col-form-label">Amount:</label>
		<input type="text" class="form-control" id="amount" name="amount" required>
	  </div>
	  <div class="form-group col-md-3">
		<label for="Category" class="col-form-label">Category:</label>
		<div class="input-group mb-3">
		  <select class="custom-select" id="selectCatI" name="Category">
			<option value="0">Choose...</option>
			<?php
			foreach($catI as $row){
			echo "<option value=\"{$row['idCatI']}\">".$row['nameCatI']."</option>";
			}
			?>
		  </select>
		</div>
	  </div>
	 </div>
	 <div class="form-row justify-content-md-center">
	  <div class="form-group col-md-6">
		<label for="description" class="col-form-label">Description:</label>
		<input type="text" class="form-control" id="description" maxlength="50" name="description" required>
	  </div>
	 </div>
	 <div class="row justify-content-sm-center">
	  <button type="submit" class="btn btn-success col-sm-4 m-md-4">Add transaction</button>
	 </div>
	 <div  class="row justify-content-sm-center">
	  <a  class="btn btn-outline-success col-sm-3 m-md-3 " role="button">Add income category</a>
	 </div>
	</form>
 </div>
 </article>
</main>	
<?php
}


}//class end
?>