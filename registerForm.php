<?php
session_start();
require_once('functions&classes.php');

class RegisterForm{
 function displayRegisterForm(){
  echo '<hr>';
?>
 <div id="mainPage" class="container">
  <div class="row">
   <div class="col-sm-12 ">
    <h5>Welcome to Finance Assitant</h5>
   </div>
  </div>
  <?php
 if (isset($_SESSION['regError'])){
	 echo "<h6 class=\"text-danger\">".$_SESSION['regError']."</h6>";
	unset($_SESSION['regError']);
 }
 ?>
  <h5>Account Data:</h5><br>
	<form action="registerVeryfication.php" method="post">
	 <input type="text" class="form-control" id="userId" hidden>
	 <div class="row justify-content-md-center">
	  <div class="form-group col-md-4">
		<label for="nick" class="col-form-label">* Log In:</label>
		<input type="text" class="form-control" id="nick" name="nick" 
		<?= isset($_SESSION['tmp_nick']) ? 'value="'.$_SESSION['tmp_nick'].'"':'';
		unset($_SESSION['tmp_nick']);?> required>
	  </div>
	 </div>
	 <div class="row justify-content-md-center">
	  <div class="form-group col-md-4">
		<label for="mail" class="col-form-label">* Email:</label>
		<input type="email" class="form-control" id="email" name="email" 
		<?= isset($_SESSION['tmp_email']) ? 'value="'.$_SESSION['tmp_email'].'"':'';
		unset($_SESSION['tmp_email']);?> required >
	  </div>
	 </div>
	 <div class="row justify-content-md-center">
	  <div class="form-group col-md-4">
		<label for="password1" class="col-form-label">* Password:</label>
		<input type="password" class="form-control" id="password1" name="pass1" placeholder="at least 8 characters with digit/s" required>
	  </div>
	 </div>
	 <div class="row justify-content-md-center">
	  <div class="form-group col-md-4">
		<label for="password2" class="col-form-label">* Repeat password:</label>
		<input type="password" class="form-control" id="password2" name="pass2" placeholder="repeat password" required>
		<small id="passHelp" class="form-text text-warning">* indicates required fields </small>
	  </div>
	 </div>
	 <!--div class="row justify-content-sm-center">
	  <div class="g-recaptcha" data-sitekey="Page Key"></div>
	 </div-->
	 <div class="row justify-content-sm-center">
	  <button type="submit" class="btn btn-warning col-sm-3 m-md-3">REGISTER</button>
	 </div>
	</form>
  </div>
 </article>
</main>	
<?php	
 }
}
/*********************************************/
$pageContenet=new ContentRegisterForm();
$pageContenet->displayPageContents();