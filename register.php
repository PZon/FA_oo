<?php

class RegisterFormModal {
 function displayRegisterFormModal(){
?>
	<h4>*If you have not account, please register here: 
    <a href="#" title="Register Form" data-toggle="modal" data-target="#registerModal">Register Form</a></h4>
<!--- Register MODAL -->
	<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModal" aria-hidden="true">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="registerModalLabel">Register Form:</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			<form action="registerVerification.php" method="post">
			  <div class="form-group">
				<label for="nick" class="col-form-label">*Login:</label>
				<input type="text" class="form-control" id="nick" name="nick"required>
			  </div>
			  <div class="form-group">
				<label for="email" class="col-form-label">*Email:</label>
				<input type="email" class="form-control" id="email" name="email" required>
			  </div>
			  <div class="form-group">
				<label for="password1" class="col-form-label">*Password:</label>
				<input type="password" class="form-control" id="password1" name="pass1" placeholder="at least 8 characters with digit/s" required>
			  </div>
			  <div class="form-group">
				<label for="password2" class="col-form-label">*Repeat Password:</label>
				<input type="password" class="form-control" id="password2" name="pass2" required>
				<small id="registerHelp" class="form-text text-warning">Fields with * are required</small>
			  </div>
			  <!--div class="form-group">
				<div class="g-recaptcha" data-sitekey="sitekey"></div>
			  </div-->
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			<button type="submit" class="btn btn-warning">Register</button>
		  </div>
		 </form></div>
		</div>
	  </div>
	</div>
<!--- end modal -->
</div>
</article>
</main>	
<?php
	}
}