<?php
$location = "Home";
include('header.php');
include('connection.php');

$id=$_SESSION['user_id'];
$query="SELECT * FROM tblusers WHERE id='$id'";
$get = mysqli_query($con,$query);
$row = mysqli_fetch_array($get);
?>
<style type="text/css">
	.col-sm-4,.col-sm-8,.col-sm-2
	{
		padding-bottom: 10px;
	}
</style>
<div class="container" style="background-color: white; padding-top: 15px;">
	<div class="row">
		<div class="col-sm-12">
			<h2>Profile</h2>
		</div>
	</div>
	<hr/>
	<div class="row">
		<form>
			<div class="col-sm-4">
				<label>First Name</label>
				<input type="text" class="form-control" disabled="" value="<?php echo $row['fname'];?>">
			</div>
			<div class="col-sm-4">
				<label>Last Name</label>
				<input type="text" class="form-control" disabled="" value="<?php echo $row['lname'];?>">
			</div>
			<div class="col-sm-4">
				<label>Birthday</label>
				<input type="text" class="form-control" disabled="" value="<?php echo $row['birth'];?>">
			</div>
			<div class="col-sm-4">
				<label>Phone Number</label>
				<input type="number" class="form-control" disabled="" value="<?php echo $row['phone'];?>">
			</div>
			<div class="col-sm-8">
				<label>Address</label>
				<input type="text" class="form-control" disabled="" value="<?php echo $row['house_no']." ".$row['street'].", ".$row['barangay'].", ".$row['city'].", ".$row['province'].", ".$row['postal'];?>">
			</div>
			<div class="col-sm-4">
				<input type="button" class="btn btn-default" value="Edit" data-target="#edit_profile" data-toggle="modal">&nbsp
				<input type="button" class="btn btn-default" value="Change Password" data-target="#change_pw" data-toggle="modal">
			</div>
		</form>
	</div>
</div>

<div id="edit_profile" class="modal fade" role="dialog">
	<div class="modal-dialog">
    	<div class="modal-content">
    		<div class="modal-header">
       			<button type="button" class="close" data-dismiss="modal">&times;</button>
        		<h4 class="modal-title">Edit</h4>
      		</div>
      		<form action="edit_profile" method="POST" id="form_edit">
	      		<div class="modal-body">
	      			<div class="row">
	      				<div class="col-sm-12">
	      					
	      				</div>
	      			</div>
	        		<div class="input-group">
	        			<span class="input-group-addon">
				        	First Name
				      	</span>
				    	<input type="text" class="form-control" placeholder="First Name" name="fname" required="" value="<?php echo $row['fname'];?>">
				    </div>
				    <br/>
				    <div class="input-group">
	        			<span class="input-group-addon">
				        	Last Name
				      	</span>
				    	<input type="text" class="form-control" placeholder="Last Name" name="lname" required="" value="<?php echo $row['lname'];?>">
				    </div>
				    <br/>
				    <div class="input-group">
	        			<span class="input-group-addon">
				        	Birthday
				      	</span>
				    	<input type="date" class="form-control" name="birth" required="" value="<?php echo $row['birth'];?>">
				    </div>
				    <br/>
				    <div class="input-group">
	        			<span class="input-group-addon">
				        	Phone Number
				      	</span>
				    	<input type="number" class="form-control" name="phone" required="" value="<?php echo $row['phone'];?>">
				    </div>
				    <br/>
				    <div class="row">
				    	<div class="col-sm-5">
				    		<div class="input-group">
			        			<span class="input-group-addon">
						        	House No.
						      	</span>
						    	<input type="number" class="form-control" placeholder="House No." name="house_no" required="" value="<?php echo $row['house_no'];?>">
						    </div>
				    	</div>
				    	<div class="col-sm-7">
				    		<div class="input-group">
			        			<span class="input-group-addon">
						        	Street
						      	</span>
						    	<input type="text" class="form-control" placeholder="Street" name="street" required="" value="<?php echo $row['street'];?>">
						    </div>
				    	</div>
				    </div>
				    <br/>
				    <script>	
					window.onload = function() {	

						// ---------------
						// basic usage
						// ---------------
						var $ = new City();
						$.showProvinces("#province");
						$.showCities("#city");

						// ------------------
						// additional methods 
						// -------------------

						// will return all provinces 
						console.log($.getProvinces());
						
						// will return all cities 
						console.log($.getAllCities());
						
						// will return all cities under specific province (e.g Batangas)
						console.log($.getCities("Batangas"));	
						
					}
					</script>
				    <div class="row">
				    	<div class="col-sm-6">
				    		<div class="input-group">
			        			<span class="input-group-addon">
						        	Barangay
						      	</span>
						    	<input type="text" class="form-control" placeholder="Barangay" name="barangay" required="" value="<?php echo $row['barangay'];?>">
						    </div>
				    	</div>
				    	<div class="col-sm-6">
				    		<div class="input-group">
			        			<span class="input-group-addon">
						        	Province
						      	</span>
						    	<select class="form-control" id="province" name="province" required="" value="<?php echo $row['province'];?>"></select>
						    </div>
				    	</div>
				    </div>
				    <br/>
				    <div class="row">
				    	<div class="col-sm-6">
				    		<div class="input-group">
			        			<span class="input-group-addon">
						        	City/Municipality
						      	</span>
						    	<select class="form-control" id="city" name="city" required="" value="<?php echo $row['city'];?>"></select>
						    </div>
				    	</div>	
				    	<div class="col-sm-6">
				    		<div class="input-group">
			        			<span class="input-group-addon">
						        	Postal Number
						      	</span>
						    	<input type="number" class="form-control" placeholder="Postal Number" name="postal" required="" value="<?php echo $row['postal'];?>">
						    </div>
				    	</div>
				    </div>
	      		</div>
	      		<div class="modal-footer">
	        		<button type="button" class="btn btn-success" id="edit_btn" onclick="submit_btn();">Submit</button>
	      		</div>
      		</form>
    	</div>
	</div>
</div>
<div id="change_pw" class="modal fade" role="dialog">
	<div class="modal-dialog">
    	<div class="modal-content">
    		<div class="modal-header">
       			<button type="button" class="close" data-dismiss="modal">&times;</button>
        		<h4 class="modal-title">Change Password</h4>
      		</div>
      		<form action="change_pw_edit" method="POST">
	      		<div class="modal-body">
	      			<div class="row">
	      				<div class="col-sm-12">
	      					
	      				</div>
	      			</div>
	        		<div class="input-group">
	        			<span class="input-group-addon">
				        	Old Password
				      	</span>
				    	<input type="password" class="form-control" name="oldpw" required="">
				    </div>
				    <br/>
				    <div class="input-group">
	        			<span class="input-group-addon">
				        	New Password
				      	</span>
				    	<input type="password" class="form-control" name="newpw" required="" id="newpw">
				    </div>
				    <br/>
				    <div class="input-group">
	        			<span class="input-group-addon">
				        	Confirm Password
				      	</span>
				    	<input type="password" class="form-control"  required="" id="cpw" onkeyup="check_pw_2();">
				    </div>
				    <div id="result_pw">
				    </div>
	      		</div>
	      		<div class="modal-footer">
	        		<button type="submit" class="btn btn-success" id="pw_btn" disabled="">Submit</button>
	      		</div>
      		</form>
    	</div>
	</div>
</div>
<script type="text/javascript">
	function submit_btn(){
		var province = document.getElementById('province').value
		var city = document.getElementById('city').value
		if (province!="Select Province") {
			if (city!="Select City / Municipality") {
				document.getElementById('form_edit').submit();
			}
			else {
				alert('Please Select City');
			}
		}
		else {
			document.getElementById('form_edit').submit();
		}
	}
	function check_pw_2(){
		var newpw = document.getElementById('newpw').value;
		var cpw = document.getElementById('cpw').value;
		if (newpw==cpw) {
			document.getElementById('result_pw').innerHTML = "";
			document.getElementById('pw_btn').removeAttribute('disabled');
		}
		else {
			document.getElementById('result_pw').innerHTML = "<br/><h6>Password Mismatch</h6>";
			document.getElementById('pw_btn').setAttribute('disabled','');
		}
	}
</script>
<?php
include('footer.php');
?>