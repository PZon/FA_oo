<?php
class FrontPage{
 function displayDescription(){
	?>
	<main>
	<article>
	<h2>Welcome to Finance Assitant</h2><hr class="mb-5">
	 <div id="mainPage" class="container">
	  <div class="row mb-3">
		<div class="col-sm-12 col-md-7 ">
		 <p>&nbsp; Managing household expenses can seem like a scary thing. It's important to confront your finances and create an effective household budget to help you get a grasp on your finances and limits.<br /><br />
		 &nbsp; By listing all of your sources of income against all of your monthly expenditures (from required expenses like mortgage or rent payments to discretionary spending like eating out or going to the movies), you get a true picture of your personal cash flow, which will allow you to make better and more informed financial decisions. An accurate budget will also help you to answer that ever elusive question, "Can I afford it?"<br /><br />
		 Finance Assistant help you to track your expenses, incomes, bills and always stay with-in budget.</p>
		</div>
		<div id="logForm" class="col-sm-12 col-md-4 pt-md-3 mb-md-5 ml-md-3 divBorder">
		 <h4 class="mb-4">To use Finance Assistant please Log In</h4>
			<?php
			 if(isset($_SESSION['logInError'])){
				 echo $_SESSION['logInError'];
				 unset($_SESSION['logInError']);
			 }
			?>
			<form action="loginVeryfication.php" method="post">
			  <div class="form-group">
			   <label for="InputLogin">Login</label>
				<input type="text" class="form-control" id="InputLogin" aria-describedby="InputLogin" placeholder="Enter Login" name="nick" required>
			  </div>
			  <div class="form-group">
				<label for="InputPassword">Password</label>
				<input type="password" class="form-control" id="InputPassword"  aria-describedby="InputPassword" placeholder="Password" name="pass" required>
				<small id="passHelp" class="form-text text-warning">Never share your password with anyone else.</small>
			  </div>
			  <button type="submit" class="m-1 btn btn-warning">Log In</button>
			</form>
		 </div><br>
	</div><hr>
<?php
 }
}







