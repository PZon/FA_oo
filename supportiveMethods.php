<?php
class SupportiveMethods{
 public static function verifyUser(){
	 if(!isset($_SESSION['userVerified'])){
	 header('location:index.php');
     exit();
	 }
	}
	
 public static function displayStatementDatepicker(){
?>
  <!-- datepicker for custom period -->
 <div class="row">
	<h5 class="mb-md-3 col-md-12">Choose statement period:</h5>
 </div>
	<form action="" method="post">
	 <div class="form-row justify-content-md-center">
	  <div class="form-group m-xs-1 col-md-4">
		<label for="datepickerFrom" class="col-form-label">from:</label> 
		<input type="text" class="form-control m-2" id="datepickerFrom" name="dateFrom" placeholder="From">
	  </div>
	  <div class="form-group m-xs-1 col-md-4">
		<label for="datepickerTo" class="col-form-label">to: </label>
		<input type="text" class="form-control m-2" id="datepickerTo" name="dateTo" placeholder="To">
	  </div>
    </div>
	<div class="row justify-content-sm-center">
	  <button type="submit" class="btn btn-warning col-sm-4 m-md-4">Submit</button>
	</div>
   </form>
    <!-- end datepicker -->
<?php
 } 
 
}//class end;
?>