<?php
class Expense{
 function getExpensesCM($_DB, $currentYM){
	 $sqlQueryE=$_DB->query("SELECT e.expenseDate, e.expenseAmount, e.expenseDescr, c.nameCatE, p.nameCatPay FROM expenses e 
	 JOIN ex_cat c ON (c.idCatE = e.idExpensesCat) 
	 JOIN pay_cat p ON (p.idCatPay = e.userPayMethId) WHERE e.idUser={$_SESSION['idUser']} AND e.expenseDate >= '$currentYM'
	 UNION 
	 SELECT e.expenseDate, e.expenseAmount, e.expenseDescr, u.nameUserCatEx, a.nameUserCatPay FROM expenses e 
	 JOIN user_ex_cat u ON (u.idUserCatEx = e.idExpensesCat) 
	 JOIN user_pay_cat a ON (a.idUserCatPay = e.userPayMethId) WHERE e.idUser={$_SESSION['idUser']} AND e.expenseDate >= '$currentYM'
	 ORDER BY expenseDate");
	 $expenses=$sqlQueryE->fetchAll();
	 return $expenses; 
	}

 function getExpensesPM($_DB, $prevYM, $prevYMEnd){
	 $sqlQueryE=$_DB->query("SELECT e.expenseDate, e.expenseAmount, e.expenseDescr, c.nameCatE, p.nameCatPay FROM expenses e 
	 JOIN ex_cat c ON (c.idCatE = e.idExpensesCat) 
	 JOIN pay_cat p ON (p.idCatPay = e.userPayMethId) WHERE e.idUser={$_SESSION['idUser']} AND
	 e.expenseDate BETWEEN '$prevYM' AND '$prevYMEnd'
	 UNION 
	 SELECT e.expenseDate, e.expenseAmount, e.expenseDescr, u.nameUserCatEx, a.nameUserCatPay FROM expenses e 
	 JOIN user_ex_cat u ON (u.idUserCatEx = e.idExpensesCat) 
	 JOIN user_pay_cat a ON (a.idUserCatPay = e.userPayMethId) WHERE e.idUser={$_SESSION['idUser']} AND 
	 e.expenseDate BETWEEN '$prevYM' AND '$prevYMEnd'ORDER BY expenseDate");
	 $expenses=$sqlQueryE->fetchAll();
	 return $expenses;
	}
	
 function getExpensesCP($_DB, $dateFrom, $dateTo){
	 $sqlQueryE=$_DB->query("SELECT e.expenseDate, e.expenseAmount, e.expenseDescr, c.nameCatE, p.nameCatPay FROM expenses e 
	 JOIN ex_cat c ON (c.idCatE = e.idExpensesCat) 
	 JOIN pay_cat p ON (p.idCatPay = e.userPayMethId) WHERE e.idUser={$_SESSION['idUser']} AND
	 e.expenseDate BETWEEN '$dateFrom' AND '$dateTo'
	 UNION 
	 SELECT e.expenseDate, e.expenseAmount, e.expenseDescr, u.nameUserCatEx, a.nameUserCatPay FROM expenses e 
	 JOIN user_ex_cat u ON (u.idUserCatEx = e.idExpensesCat) 
	 JOIN user_pay_cat a ON (a.idUserCatPay = e.userPayMethId) WHERE e.idUser={$_SESSION['idUser']} AND 
	 e.expenseDate BETWEEN '$dateFrom' AND '$dateTo' ORDER BY expenseDate");
	 $expenses=$sqlQueryE->fetchAll();
	 return $expenses;
	}
 function displayExpense($expenses){
?>
	<div class="row">
	<table class="table table-hover table-bordered">
	  <thead >
	  <tr class="bg-danger">
		  <th class="tbStyle" colspan="6">EXPENSES</th>
	  </tr>
		<tr class="bg-dark" >
		  <th scope="col">Date</th>
		  <th scope="col">Amount</th>
		  <th scope="col">Category</th>
		  <th scope="col">Description</th>
		  <th scope="col">Payment type</th>
		  <th scope="col">Options</th>
		</tr>
	  </thead>
	  <tbody>
	   <?php
		foreach($expenses as $row){
			echo"<tr>
			 <td>{$row['expenseDate']}</td>
			 <td>{$row['expenseAmount']}</td>
			 <td>{$row['nameCatE']}</td>
			 <td>{$row['expenseDescr']}</td>
			 <td>{$row['nameCatPay']}</td>
			 <th>";
			 $this->editExpenseIcon()."</th>
			</tr>";
		}
	   ?>
	  </tbody>
  </table>
 </div>
<?php
 }
 function editExpenseIcon(){
	?>
<a href="#" title="Edit&Remove" data-toggle="modal" data-target="#editExpense"><i class="fas fa-edit"></i></a>

<!--- edit Transation MODAL -->
	<div class="modal fade" id="editExpense" tabindex="-1" role="dialog" aria-labelledby="editTransaction" aria-hidden="true">
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
			  <div class="form-group">
				<label for="paymentType" class="col-form-label">Payment type:</label>
				<input type="text" class="form-control" id="paymentType" placeholder="$_SESSION">
			  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#removeExpense">Remove transaction</button>
			<button type="submit" class="btn btn-warning">Save changes</button>
		  </div>
		  </form>
		 </div>
		</div>
	  </div>
	</div>
<!--- remove transaction Modal -->
	<div class="modal fade" id="removeExpense" tabindex="-1" role="dialog" aria-labelledby="removeTransaction" aria-hidden="true">
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

 function displayAddExpenseB($catP, $catE){
?>
 <button type="button" class="m-1  btn btn-outline-danger btn-lg col-md-5" data-toggle="modal" data-target="#addExpense">Add expense</button>
 <div class="modal fade" id="addExpense" tabindex="-1" role="dialog" aria-labelledby="addExpense" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="addExpenseLabel">Add expense:</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
		  <form action="addTransactionVerify.php" method="post">
			<input type="text" class="form-control" id="transactionType" value="E" name="transactionType"hidden>
			  <div class="form-group">
				<label for="expenseDate" class="col-form-label">Date:</label>
				<input type="text" class="form-control" id="expenseDate" name="transactionDate">
			  </div>
			  <div class="form-group">
				<label for="amountE" class="col-form-label">Amount:</label>
				<input type="text" class="form-control" id="amountE" name="amount">
			  </div>
			  <div class="form-group">
				<label for="payType" class="col-form-label">Payment Type:</label>
				<div class="input-group">
				 <select class="custom-select" id="PayType" name="payType" >
				 <option value="0">Choose...</option>
				 <?php
				 foreach($catP as $row){
				 echo "<option value=\"{$row['idCatPay']}\">".$row['nameCatPay']."</option>";
				 }
				 ?>
				 </select>
				</div>
			  </div>
			  <div class="form-group">
				<label for="categoryE" class="col-form-label">Category:</label>
				<div class="input-group">
				  <select class="custom-select" id="selectCatE" name="Category"  required>
					<option value="0">Choose...</option>
					<?php
					foreach($catE as $row){
					echo "<option value=\"{$row['idCatE']}\">".$row['nameCatE']."</option>";
					}
					?>
				  </select>
				</div>
			  </div>
			  <div class="form-group">
				<label for="descriptionE" class="col-form-label">Description:</label>
				<input type="text" class="form-control" id="descriptionE" maxlength="50" name="description">
			  </div>
			
			  <div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-warning">Save expense</button>
			  </div>
		  </form>
		  </div>
		</div>
	  </div>
	</div>
<!--- end modal -->
   </div>
  </div>
 </article>
</main>	
<?php
}

function getExpenseCat($_DB){
 $sqlQueryE=$_DB->query("SELECT idCatE, nameCatE FROM ex_cat 
 UNION 
 SELECT idUserCatEx, nameUserCatEx FROM user_ex_cat 
 WHERE idUser={$_SESSION['idUser']}");
 $catE=$sqlQueryE->fetchAll();
 return $catE;
}

function getPayCat($_DB){
 $sqlQueryP=$_DB->query("SELECT idCatPay, nameCatPay FROM pay_cat
 UNION 
 SELECT idUserCatPay, nameUserCatPay FROM user_pay_cat 
 WHERE idUser={$_SESSION['idUser']}");
 $catP=$sqlQueryP->fetchAll();
 return $catP;
}

 function displayAddExpenseForm($catE, $catP){
?>

<main>
 <article>
 <div id="mainPage" class="container">
  <div class="row">
   <div class="col-sm-12 ">
    <h5>Welcome to Finance Assitant: <?=$_SESSION['userVerified']?></h5>
   </div>
  </div><hr>
  <h5>Add Expese</h5><br>
    <?php
	if(isset($_SESSION['addTransError'])){
		echo '<p class="text-danger text-center">';
		echo $_SESSION['addTransError'];
		echo '</p>';
		unset ($_SESSION['addTransError']);
	}
	?>
	<form action="addTransactionVerify.php" method="post">
	 <input type="text" class="form-control" id="userId" value="<?= $_SESSION['idUser']?>" name="idUser" hidden>
	 <input type="text" class="form-control" id="transactionType" value="E" name="transactionType" hidden>
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
		<label for="payType" class="col-form-label">Payment type:</label>
		<div class="input-group mb-3">
		  <select class="custom-select" id="PayType" name="payType">
			<option value="0">Choose...</option>
			<?php
			foreach($catP as $row){
			echo "<option value=\"{$row['idCatPay']}\">".$row['nameCatPay']."</option>";
			}
			?>
		  </select>
		</div>
	  </div>
	 </div>
	 <div class="form-row justify-content-md-center">
	  <div class="form-group col-md-3">
		<label for="Category" class="col-form-label">Category:</label>
		<div class="input-group mb-3">
		  <select class="custom-select" id="selectCatE" name="Category"  >
			<option value="0">Choose...</option>
			<?php
			foreach($catE as $row){
			echo "<option value=\"{$row['idCatE']}\">".$row['nameCatE']."</option>";
			}
			?>
		  </select>
		</div>
	  </div>
	  <div class="form-group col-md-6">
		<label for="description" class="col-form-label">Description:</label>
		<input type="text" class="form-control" id="description" maxlength="50" name="description"  required>
	  </div>
	 </div>
	 <div class="row justify-content-sm-center">
	  <button type="submit" class="btn btn-warning col-sm-4 m-md-4">Add transaction</button>
	 </div>
	 <div  class="row justify-content-sm-center">
	  <a  class="btn btn-outline-warning col-sm-3 m-md-3 " role="button">Add expense category</a>
	 </div>
	</form>
 </div>
 </article>
</main>	
<?php
} 
 
 
}//end class
?>