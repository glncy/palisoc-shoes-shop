	<?php
	if ($URL[0]!='profile') {
	?>
	<div id="sign_up" class="modal fade" role="dialog">
		<div class="modal-dialog">
	    	<div class="modal-content">
	    		<div class="modal-header">
	       			<button type="button" class="close" data-dismiss="modal">&times;</button>
	        		<h4 class="modal-title">Sign Up</h4>
	      		</div>
	      		<form action="signup.php" method="POST">
		      		<div class="modal-body">
		      			<div class="row">
		      				<div class="col-sm-12">
		      					
		      				</div>
		      			</div>
		        		<div class="input-group">
		        			<span class="input-group-addon">
					        	First Name
					      	</span>
					    	<input type="text" class="form-control" placeholder="First Name" name="fname" required="">
					    </div>
					    <br/>
					    <div class="input-group">
		        			<span class="input-group-addon">
					        	Last Name
					      	</span>
					    	<input type="text" class="form-control" placeholder="Last Name" name="lname" required="">
					    </div>
					    <br/>
					    <div class="input-group">
		        			<span class="input-group-addon">
					        	Birthday
					      	</span>
					    	<input type="date" class="form-control" name="birth" required="">
					    </div>
					    <br/>
					    <div class="input-group">
		        			<span class="input-group-addon">
					        	Phone Number
					      	</span>
					    	<input type="number" class="form-control" name="phone" required="">
					    </div>
					    <br/>
					    <div class="row">
					    	<div class="col-sm-5">
					    		<div class="input-group">
				        			<span class="input-group-addon">
							        	House No.
							      	</span>
							    	<input type="number" class="form-control" placeholder="House No." name="house_no" required="">
							    </div>
					    	</div>
					    	<div class="col-sm-7">
					    		<div class="input-group">
				        			<span class="input-group-addon">
							        	Street
							      	</span>
							    	<input type="text" class="form-control" placeholder="Street" name="street" required="">
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
							    	<input type="text" class="form-control" placeholder="Barangay" name="barangay" required="">
							    </div>
					    	</div>
					    	<div class="col-sm-6">
					    		<div class="input-group">
				        			<span class="input-group-addon">
							        	Province
							      	</span>
							    	<select class="form-control" id="province" name="province" required=""></select>
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
							    	<select class="form-control" id="city" name="city" required=""></select>
							    </div>
					    	</div>	
					    	<div class="col-sm-6">
					    		<div class="input-group">
				        			<span class="input-group-addon">
							        	Postal Number
							      	</span>
							    	<input type="number" class="form-control" placeholder="Postal Number" name="postal" required="">
							    </div>
					    	</div>
					    </div>
					    <br/>
					    <h4>Account</h4>
					    <hr/>
					    <div class="input-group">
		        			<span class="input-group-addon">
					        	Email
					      	</span>
					    	<input type="email" class="form-control" placeholder="Email" onkeyup="verify_email();" id="signup_email" name="email" required="">
					    </div>
					    <div id="verify_result">
					    	<br/>
					    </div>
					    <div class="input-group">
		        			<span class="input-group-addon">
					        	Password
					      	</span>
					    	<input type="password" class="form-control" placeholder="Password" id="signup_pw" disabled="" name="pw" required="">
					    </div>
					    <br/>
					    <div class="input-group">
		        			<span class="input-group-addon">
					        	Retype password
					      	</span>
					    	<input type="password" class="form-control" placeholder="Retype Password" id="signup_cpw" onkeyup="verify_pw('signup');" disabled="" required="">
					    </div>
					    <div id="verify_pw">
					    	<br/>
					    </div>
					    <br/>
					    <h4>Security Questions</h4>
					    <hr/>
					    <div class="input-group">
		        			<span class="input-group-addon">
					        	#1
					      	</span>
					      	<select class="form-control" id="signup_q1" disabled="" name="q1" required="">
					      		<option>What is the first and last name of your first boyfriend or girlfriend?</option>
					      		<option>Which phone number do you remember most from your childhood?</option>
					      		<option>What was your favorite place to visit as a child?</option>
					      		<option>Who is your favorite actor, musician, or artist?</option>
					      		<option>What is the name of your favorite pet?</option>
					      		<option>In what city were you born?</option>
					      	</select>
					    	<input type="password" class="form-control" placeholder="Answer" id="signup_q1_ans" disabled="" name="q1_ans" required="">
					    </div>
					    <br/>
					    <div class="input-group">
		        			<span class="input-group-addon">
					        	#2
					      	</span>
					      	<select class="form-control" id="signup_q2" disabled="" name="q2" required="">
					      		<option>What high school did you attend?</option>
					      		<option>What is the name of your first school?</option>
					      		<option>What is your favorite movie?</option>
					      		<option>What is your mother's maiden name?</option>
					      		<option>What street did you grow up on?</option>
					      		<option>What was the make of your first car?</option>
					      	</select>
					    	<input type="password" class="form-control" placeholder="Answer" id="signup_q2_ans" disabled="" onkeyup="sec_question();" name="q2_ans" required="">
					    </div>
		      		</div>
		      		<div class="modal-footer">
		        		<button type="submit" class="btn btn-success" id="signup_btn" disabled="">Sign Up</button>
		      		</div>
	      		</form>
	    	</div>
		</div>
	</div>
	<?php
	}
	?>
	
	<div id="login" class="modal fade" role="dialog">
		<div class="modal-dialog">
	    	<div class="modal-content">
	    		<div class="modal-header">
	       			<button type="button" class="close" data-dismiss="modal">&times;</button>
	        		<h4 class="modal-title">Log In</h4>
	      			</div>
	      		<form>
		      		<div class="modal-body">
					    <div class="input-group">
		        			<span class="input-group-addon">
					        	E-mail
					      	</span>
					    	<input type="email" class="form-control" placeholder="Email" required id="login_email">
					    </div>
					    <br/>
					    <div class="input-group">
		        			<span class="input-group-addon">
					        	Password
					      	</span>
					    	<input type="password" class="form-control" placeholder="Password" required id="login_pw">
					    </div>
					    <div class="row" id="failed">
		      			</div>
		      			<br/>
					    <a href="#" data-toggle="modal" data-target="#forgot_pw" data-dismiss="modal">Forgot Password?</a>
		      		</div>
		      		<div class="modal-footer">
		        		<input type="button" class="btn btn-success btn-login" onclick="login();" value="Log In">
		      		</div>
	      		</form>
	    	</div>
		</div>
	</div>
	<div id="forgot_pw" class="modal fade" role="dialog">
		<div class="modal-dialog">
	    	<div class="modal-content">
	    		<div class="modal-header">
	       			<button type="button" class="close" data-dismiss="modal">&times;</button>
	        		<h4 class="modal-title">Forgot Password</h4>
	      			</div>
	      		<form>
		      		<div class="modal-body">
					    <div class="input-group">
		        			<span class="input-group-addon">
					        	E-mail
					      	</span>
					    	<input type="email" class="form-control" placeholder="Email" required id="forgot_email" onkeyup="fetch_sec_question();">
					    </div>
					    <div id="forgot_email_result">
					    </div>
						<div id="sec_question_result">
						</div>
		      		</div>
		      		<div class="modal-footer">
		        		<input type="button" class="btn btn-success btn-login" value="Next" disabled="" data-toggle="modal" data-target="#renew_password" data-dismiss="modal" id="forgot_next_btn">
		      		</div>
	      		</form>
	    	</div>
		</div>
	</div>
	<div id="renew_password" class="modal fade" role="dialog">
		<div class="modal-dialog">
	    	<div class="modal-content">
	    		<div class="modal-header">
	       			<button type="button" class="close" data-dismiss="modal">&times;</button>
	        		<h4 class="modal-title">Forgot Password</h4>
	      			</div>
	      		<form id="change_submit" method="POST" action="#">
		      		<div class="modal-body">
		      			<div class="input-group">
		        			<span class="input-group-addon">
					        	New Password
					      	</span>
					    	<input type="password" class="form-control" id="change_new_pw" name="new_pw">
					    </div>
					    <br/>
					    <div class="input-group">
		        			<span class="input-group-addon">
					        	Confirm Password
					      	</span>
					    	<input type="password" class="form-control" id="change_confirm" onkeyup="check_change();">
					    </div>
					    <div id="change_result">
					    	<br/>
					    </div>
		      		</div>
		      		<div class="modal-footer">
		        		<input type="submit" class="btn btn-success btn-login" value="Change" disabled="" id="change_btn">
		      		</div>
	      		</form>
	    	</div>
		</div>
	</div>
	<?php
	if ($URL[0]=="product") {
	?>
	<div id="add_to_cart" class="modal fade" role="dialog">
			<div class="modal-dialog modal-sm">
		    	<div class="modal-content">
		    		<div class="modal-header">
		       			<button type="button" class="close" data-dismiss="modal">&times;</button>
		        		<h4 class="modal-title">Add to Cart</h4>
		      			</div>
		      		<form method="POST" id="addToCartForm">
			      		<div class="modal-body">
			      			<div class="row">
			      				<div class="col-sm-12">
				      				<center><h4><?php
				      				if (isset($add_to_cart)){
				      					echo $add_to_cart;
				      				}
				      				?></h4></center>
			      				</div>
			      				<div class="col-sm-12">
			      					<hr/>
			      				</div>
			      				<div class="col-sm-3">
			      					<center><h4>Quantity</h4></center>
			      				</div>
			      				<div class="col-sm-9">
			      					<select class="form-control" name="qty">
				      					<?php
					      				if (isset($add_to_cart)){
					      					$loop=1;
					      					while ($loop<=$qty_show) {
					      						echo "<option>".$loop."</option>";
					      						$loop++;
					      					}
					      				}
					      				?>
				      				</select>
			      				</div>
			      				<div class="col-sm-12">
			      					<h6>Available Quantity : <?php echo $qty_show; ?></h6>
			      				</div>
			      			</div>
			      		</div>
			      		<div class="modal-footer">
			        		<input type="submit" class="btn btn-success btn-login" value="Add">
			      		</div>
		      		</form>
		    	</div>
			</div>
	</div>
	<?php
	}
	?>
	<?php
	if ($URL[0]=="cart") {
	?>
	<form action="submit_checkout" method="post" id="ship_bill_submit">
		<div id="check_out_billing" class="modal fade" role="dialog">
			<div class="modal-dialog modal-lg">
		    	<div class="modal-content">
		    		<div class="modal-header">
		       			<button type="button" class="close" data-dismiss="modal">&times;</button>
		        		<h4 class="modal-title">Shipping and Billing Info</h4>
		      		</div>
		      		<div class="modal-body">
		      			<div id="info_status">
		      				
		      			</div>
		      			<div class="row">
		      				<div class="col-sm-6">
		      					<div class="row">
		      						<div class="col-sm-12">
		      							<h4>Billing Information</h4>
		      						</div>
		      						<div class="col-sm-12">
		      							<fieldset onchange="billing_choice();">
		      								<input type="radio" name="billing_mode" checked="" id="choice1" value="true">&nbsp<span>My Billing Information is the same as my Shipping Information.</span>
		      								<br/>
		      								<input type="radio" name="billing_mode" id="choice2" value="false">&nbsp<span>I am using different Billing Information.</span>
		      							</fieldset>
		      						</div>
		      						<div class="col-sm-12">
		      							<br/>
		      						</div>
		      						<div class="col-sm-12">
		      							<div class="input-group">
						        			<span class="input-group-addon">
									        	First Name
									      	</span>
									    	<input type="text" class="form-control" disabled="" id="bill_fname" name="bill_fname" required="">
									    </div>
		      						</div>
		      						<div class="col-sm-12">
		      							<br/>
		      						</div>
		      						<div class="col-sm-12">
		      							<div class="input-group">
						        			<span class="input-group-addon">
									        	Last Name
									      	</span>
									    	<input type="text" class="form-control" disabled="" id="bill_lname" name="bill_lname" required="">
									    </div>
		      						</div>
		      						<div class="col-sm-12">
		      							<br/>
		      						</div>
		      						<div class="col-sm-12">
		      							<div class="input-group">
						        			<span class="input-group-addon">
									        	Email
									      	</span>
									    	<input type="text" class="form-control" disabled="" id="bill_email" name="bill_email" required="">
									    </div>
		      						</div>
		      						<div class="col-sm-12">
		      							<br/>
		      						</div>
		      						<div class="col-sm-12">
		      							<div class="input-group">
						        			<span class="input-group-addon">
									        	Phone
									      	</span>
									    	<input type="number" class="form-control" disabled="" id="bill_phone" name="bill_phone" required="">
									    </div>
		      						</div>
		      						<div class="col-sm-12">
		      							<br/>
		      						</div>
		      						<div class="col-sm-12">
		      							<div class="input-group">
						        			<span class="input-group-addon">
									        	Address
									      	</span>
									      	<textarea class="form-control" disabled="" style="height: 75px;resize: none;" id="bill_address" name="bill_address" required="">
									      	</textarea>
									    </div>
		      						</div>
		      					</div>
		      				</div>
		      				<div class="col-sm-6">
		      					<?php
		      					include('connection.php');
		      					$user_id = $_SESSION['user_id'];
		      					$query = "SELECT * FROM tblusers WHERE id='$user_id'";
		      					$get = mysqli_query($con,$query);
		      					$row = mysqli_fetch_array($get);
		      					?>
		      					<div class="row">
		      						<div class="col-sm-12">
		      							<h4>Shipping Information</h4>
		      						</div>
		      						<div class="col-sm-12">
		      							<span>Shipping Address can be edited in Profile.</span>
		      						</div>
		      						<div class="col-sm-12">
		      							<br/>
		      						</div>
		      						<div class="col-sm-12">
		      							<div class="input-group">
						        			<span class="input-group-addon">
									        	First Name
									      	</span>
									    	<input type="text" class="form-control" disabled="" value="<?php echo $row['fname'];?>" required="">
									    </div>
		      						</div>
		      						<div class="col-sm-12">
		      							<br/>
		      						</div>
		      						<div class="col-sm-12">
		      							<div class="input-group">
						        			<span class="input-group-addon">
									        	Last Name
									      	</span>
									    	<input type="text" class="form-control" disabled="" value="<?php echo $row['lname'];?>" required="">
									    </div>
		      						</div>
		      						<div class="col-sm-12">
		      							<br/>
		      						</div>
		      						<div class="col-sm-12">
		      							<div class="input-group">
						        			<span class="input-group-addon">
									        	Email
									      	</span>
									    	<input type="text" class="form-control" disabled="" value="<?php echo $row['email'];?>" required="">
									    </div>
		      						</div>
		      						<div class="col-sm-12">
		      							<br/>
		      						</div>
		      						<div class="col-sm-12">
		      							<div class="input-group">
						        			<span class="input-group-addon">
									        	Phone
									      	</span>
									    	<input type="number" class="form-control" disabled="" value="<?php echo $row['phone'];?>" required="">
									    </div>
		      						</div>
		      						<div class="col-sm-12">
		      							<br/>
		      						</div>
		      						<div class="col-sm-12">
		      							<div class="input-group">
						        			<span class="input-group-addon">
									        	Address
									      	</span>
									      	<textarea class="form-control" disabled="" style="height: 100px;" required="">
									      	<?php echo $row['house_no']." ".$row['street'].", ".$row['barangay'].", ".$row['city'].", ".$row['province'].", ".$row['postal'];?>
									      	</textarea>
									    </div>
		      						</div>
		      					</div>
		      				</div>
		      			</div>
		      			<hr/>
		      			<div class="row">
		      				<div class="col-sm-3">
		      					<h4>Payment</h4>
		      				</div>
		      			</div>
		      			<div class="row">
		      				<div class="col-sm-6">
		      					<select class="form-control" name="mode_of_payment" id="mode_of_payment" onchange="modepayment()" required="">
		      						<option>Select Payment Method</option>
		      						<option>LBC Remittance</option>
		      						<option>Cebuana Lhuillier</option>
		      						<option>MLhuillier</option>
		      						<option>Palawan Express</option>
		      						<option>GCASH</option>
		      						<option>Paymaya</option>
		      					</select>
		      				</div>
		      				<div class="col-sm-6">
			      				<div class="row" id="print_form">
			      				</div>
		      				</div>
		      			</div>
		      		</div>
		      		<div class="modal-footer">
		        		<input type="submit" class="btn btn-success btn-login" value="Check Out" id="chkout" disabled="" onclick="form_submit();">
		      		</div>
		    	</div>
			</div>
		</div>
	</form>
	<script type="text/javascript">
		function billing_choice(){
			var choice1 = document.getElementById('choice1');
			var choice2 = document.getElementById('choice2');
			if (choice2.checked) {
				document.getElementById('bill_fname').removeAttribute('disabled');
				document.getElementById('bill_lname').removeAttribute('disabled');
				document.getElementById('bill_email').removeAttribute('disabled');
				document.getElementById('bill_phone').removeAttribute('disabled');
				document.getElementById('bill_address').removeAttribute('disabled');
			}
			else {
				document.getElementById('bill_fname').setAttribute('disabled','');
				document.getElementById('bill_lname').setAttribute('disabled','');
				document.getElementById('bill_email').setAttribute('disabled','');
				document.getElementById('bill_phone').setAttribute('disabled','');
				document.getElementById('bill_address').setAttribute('disabled','');
			}
		}

		function modepayment(){
			var modepay = document.getElementById('mode_of_payment');
			var referenceform = document.getElementById('print_form');
			if (modepay.value=="LBC Remittance") {
				referenceform.innerHTML = '<div class="col-sm-12"><div class="input-group"><span class="input-group-addon">Tracking Number</span><input type="number" class="form-control" placeholder="Tracking Number" name="payment_reference" required="" id="preference"></div></div><div class="col-sm-12"><br/></div><div class="col-sm-12"><div class="input-group"><span class="input-group-addon">Amount</span><input type="number" class="form-control" placeholder="Amount" name="payment_amount" required="" id="amnt" onkeyup="enterAmount();"></div></div><div class="col-sm-12" id="amount_status"></div>'
			}
			else if (modepay.value=="MLhuillier") {
				referenceform.innerHTML = '<div class="col-sm-12"><div class="input-group"><span class="input-group-addon">KPTN</span><input type="type" class="form-control" placeholder="KPTN" name="payment_reference" required="" id="preference"></div></div><div class="col-sm-12"><br/></div><div class="col-sm-12"><div class="input-group"><span class="input-group-addon">Amount</span><input type="number" class="form-control" placeholder="Amount" name="payment_amount" required="" id="amnt" onkeyup="enterAmount();"></div></div><div class="col-sm-12" id="amount_status"></div>'
			}
			else if (modepay.value=="Cebuana Lhuillier") {
				referenceform.innerHTML = '<div class="col-sm-12"><div class="input-group"><span class="input-group-addon">Control No.</span><input type="type" class="form-control" placeholder="Control No." name="payment_reference" required="" id="preference"></div></div><div class="col-sm-12"><br/></div><div class="col-sm-12"><div class="input-group"><span class="input-group-addon">Amount</span><input type="number" class="form-control" placeholder="Amount" name="payment_amount" required="" id="amnt" onkeyup="enterAmount();"></div></div><div class="col-sm-12" id="amount_status"></div>'
			}
			else if (modepay.value=="GCASH") {
				referenceform.innerHTML = '<div class="col-sm-12"><div class="input-group"><span class="input-group-addon">Reference No.</span><input type="type" class="form-control" placeholder="Reference No." name="payment_reference" required="" id="preference"></div></div><div class="col-sm-12"><br/></div><div class="col-sm-12"><div class="input-group"><span class="input-group-addon">Amount</span><input type="number" class="form-control" placeholder="Amount" name="payment_amount" required="" id="amnt" onkeyup="enterAmount();"></div></div><div class="col-sm-12" id="amount_status"></div>'
			}
			else if (modepay.value=="Paymaya") {
				referenceform.innerHTML = '<div class="col-sm-12"><div class="input-group"><span class="input-group-addon">Reference No.</span><input type="type" class="form-control" placeholder="Reference No." name="payment_reference" required="" id="preference"></div></div><div class="col-sm-12"><br/></div><div class="col-sm-12"><div class="input-group"><span class="input-group-addon">Amount</span><input type="number" class="form-control" placeholder="Amount" name="payment_amount" required="" id="amnt" onkeyup="enterAmount();"></div></div><div class="col-sm-12" id="amount_status"></div>'
			}
			else if (modepay.value=="Palawan Express") {
				referenceform.innerHTML = '<div class="col-sm-12"><div class="input-group"><span class="input-group-addon">Control No.</span><input type="type" class="form-control" placeholder="Control No." name="payment_reference" required="" id="preference"></div></div><div class="col-sm-12"><br/></div><div class="col-sm-12"><div class="input-group"><span class="input-group-addon">Amount</span><input type="number" class="form-control" placeholder="Amount" name="payment_amount" required="" id="amnt" onkeyup="enterAmount();"></div></div><div class="col-sm-12" id="amount_status"></div>'
			}
			else {
				referenceform.innerHTML = "";
			}
		}

		function enterAmount(){
			var amnt = document.getElementById('amnt');
			var cmp = parseFloat(amnt.value);
			var check_btn = document.getElementById('chkout');
			if (cmp>=product_total_price) {
				check_btn.removeAttribute('disabled');
				document.getElementById('amount_status').innerHTML = "";
			}
			else {
				check_btn.setAttribute('disabled','');
				document.getElementById('amount_status').innerHTML = "<h6>Insufficient Amount.";
			}
		}

		function form_submit(){
			var ans = confirm('Confirm Submit Details?');
			var bill_fname = document.getElementById('bill_fname').value;
			var bill_lname = document.getElementById('bill_lname').value;
			var bill_phone = document.getElementById('bill_phone').value;
			var bill_email = document.getElementById('bill_email').value;
			var bill_address = document.getElementById('bill_address').value;
			var preference = document.getElementById('preference').value;
			if (ans==true) {
				var choice2 = document.getElementById('choice2');
				if (choice2.checked){
					if ((bill_fname!="")&&(bill_lname!="")&&(bill_email!="")&&(bill_phone!="")&&(bill_address!="")&&(preference!="")) {
						return true;
					}
					else {
						alert('Please fill up all the details.');
						document.getElementById('info_status').innerHTML = "<h6 style='color:red'>Please fill up all the details.</h6>"
						return false;
					}
				}
				else {
					if (preference=="") {
						alert('Please fill up all the details.');
						document.getElementById('info_status').innerHTML = "<h6 style='color:red'>Please fill up all the details.</h6>"
						return false;
					}
					else {
						return true;
					}
				}
			}
			else {
				alert('Cancelled.');
				return false;
			}
		}
	</script>
	<?php
	}
	if ($URL[0]=="transactions") {
	?>
	<div id="check_out_info" class="modal fade" role="dialog">
		<div class="modal-dialog">
	    	<div class="modal-content">
	    		<div class="modal-header">
	       			<button type="button" class="close" data-dismiss="modal">&times;</button>
	        		<h4 class="modal-title">Check Out Info</h4>
	      		</div>
	      		<div class="modal-body">
	      			<div class="row">
	      				<div class="col-sm-12">
	      					<div class="table-responsive" id="product_details">
	      					</div>
	      				</div>
	      			</div>
	      			<hr/>
	      			<div class="row">
	      				<div class="col-sm-12">
	      					<h4>Shipping Info</h4>
	      				</div>
	      				<div class="col-sm-12">
	      					<div id="ship_details">
	      					</div>
	      				</div>
	      			</div>
	      			<div class="row">
	      				<div class="col-sm-12">
	      					<h4>Billing Info</h4>
	      				</div>
	      				<div class="col-sm-12">
	      					<div id="bill_details">
	      					</div>
	      				</div>
	      			</div>
	      		</div>
	      		<div class="modal-footer" id="check_out_info_footer">
	      			<input type="button" class="btn btn-danger btn-login" value="Cancel Check Out" onclick="cancel_checkout();" id="cancel_check">
	      		</div>
	      	</div>
	    </div>
	</div>
	<div id="check_out_reply" class="modal fade" role="dialog">
		<div class="modal-dialog">
	    	<div class="modal-content">
	    		<form action="/submit_response/" method="post" id="formResponse">
		    		<div class="modal-header">
		       			<button type="button" class="close" data-dismiss="modal">&times;</button>
		        		<h4 class="modal-title">Check Out Info</h4>
		      		</div>
		      		<div class="modal-body" id="check_out_reply">
		      			<div class="row">
		      				<div class="col-sm-12">
		      					<h4>Admininstrator Response: </h4>
		      				</div>
		      			</div>
		      			<div class="row">
		      				<div class="col-sm-12">
		      					<p id="remarks"></p>
		      				</div>
		      			</div>
		      			<hr/>
		      			<div class="row">
		      				<div class="col-sm-12">
		      					<h4>My Response: </h4>
		      				</div>
		      				<div class="col-sm-12">
		      					<textarea class="form-control" style="resize: none; height: 200px;" name="remarks"></textarea>
		      				</div>
		      			</div>
		      		</div>
		      		<div class="modal-footer" id="check_out_info_footer">
		      			<input type="submit" class="btn btn-success btn-login" value="Submit Reply">
		      		</div>
	      		</form>
	      	</div>
	    </div>
	</div>
	<script type="text/javascript">
		Number.prototype.formatMoney = function(c, d, t){
		var n = this, 
		    c = isNaN(c = Math.abs(c)) ? 2 : c, 
		    d = d == undefined ? "." : d, 
		    t = t == undefined ? "," : t, 
		    s = n < 0 ? "-" : "", 
		    i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))), 
		    j = (j = i.length) > 3 ? j % 3 : 0;
		   return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
		 };


		function fetch_checkout(id,mode){
			if (mode=="check_out_view"){
				var output = '<table class="table"><thead><tr><th>Product</th><th>Qty</th><th>Price</th></tr></thead>';
				var cnt = 0;
				var loop = 0;
				var data = {
					id:id,mode:mode,
				};
				var formatPrice = "";
				var price = 0;

				$.getJSON("fetch_details.php", data, function(result) {
					if (result.status != "") {
						document.getElementById('check_out_info_footer').remove()
						cnt = parseInt(result.item_count);
						loop = 0;
						while (loop<cnt){
							price = parseFloat(result.price[loop]);
							formatPrice = (price).formatMoney(2,'.',',');
							output += "<tr><td><a href='product/"+result.product_id[loop]+"' target='_blank'>"+result.product_name[loop]+"</a></td><td>"+result.qty[loop]+"</td><td>₱"+formatPrice+"</td></tr>";
							loop++;
						}
						price = parseFloat(result.shipping_fee);
						formatPrice = (price).formatMoney(2,'.',',');
						output += "<tr><td></td><td><span class='pull-right' style='font-weight: bold;'>Shipping Fee:<span></td><td>₱"+formatPrice+"</td></tr>";
						price = parseFloat(result.total_amount);
						formatPrice = (price).formatMoney(2,'.',',');
						output += "<tr><td></td><td><span class='pull-right' style='font-weight: bold;'>Total: <span></td><td>₱"+formatPrice+"</td></tr>";
						if ((result.status!='')&&(result.status!='verified')&&(result.status!='processing')&&(result.status!='failed')&&(result.status!='replied')) {
							output += "<tr><td></td><td><span class='pull-right' style='font-weight: bold;'>Receipt: <span></td><td><a href='print_receipt.php?id="+id+"' target='_blank'>Click Here</a></td><tr></table>";
						}
						else {
							output+="</table>";
						}
						$('#product_details').html(output);
						output = "<p>";
						output += result.ship_name+"<br/>";
						output += result.ship_email+"<br/>";
						output += result.ship_phone+"<br/>";
						output += result.ship_address;+"</p>";
						$('#ship_details').html(output);
						output = "<p>";
						output += result.bill_name+"<br/>";
						output += result.bill_email+"<br/>";
						output += result.bill_phone+"<br/>";
						output += result.bill_address;+"</p>";
						$('#bill_details').html(output);
					}
					else
					{
						cnt = parseInt(result.item_count);
						loop = 0;
						while (loop<cnt){
							price = parseFloat(result.price[loop]);
							formatPrice = (price).formatMoney(2,'.',',');
							output += "<tr><td><a href='product/"+result.product_id[loop]+"' target='_blank'>"+result.product_name[loop]+"</a></td><td>"+result.qty[loop]+"</td><td>₱"+formatPrice+"</td></tr>";
							loop++;
						}
						price = parseFloat(result.shipping_fee);
						formatPrice = (price).formatMoney(2,'.',',');
						output += "<tr><td></td><td><span class='pull-right' style='font-weight: bold;'>Shipping Fee:<span></td><td>₱"+formatPrice+"</td></tr>";
						price = parseFloat(result.total_amount);
						formatPrice = (price).formatMoney(2,'.',',');
						output += "<tr><td></td><td><span class='pull-right' style='font-weight: bold;'>Total: <span></td><td>₱"+formatPrice+"</td></tr>";
						if ((result.status!='')&&(result.status!='verified')&&(result.status!='processing')&&(result.status!='failed')&&(result.status!='replied')) {
							output += "<tr><td></td><td><span class='pull-right' style='font-weight: bold;'>Receipt: <span></td><td><a href='print_receipt.php?id="+id+"' target='_blank'>Click Here</a></td><tr></table>";
						}
						else {
							output+="</table>";
						}
						$('#product_details').html(output);
						output = "<p>";
						output += result.ship_name+"<br/>";
						output += result.ship_email+"<br/>";
						output += result.ship_phone+"<br/>";
						output += result.ship_address;+"</p>";
						$('#ship_details').html(output);
						output = "<p>";
						output += result.bill_name+"<br/>";
						output += result.bill_email+"<br/>";
						output += result.bill_phone+"<br/>";
						output += result.bill_address;+"</p>";
						$('#bill_details').html(output);
						document.getElementById('cancel_check').setAttribute('onclick','cancel_checkout('+id+');')
					}
				});
			}
		}
		function cancel_checkout(id){
			var ans = confirm("Do you want to Cancel Checkout?");
			if (ans==true) {
				window.location.href = "delete_checkout/?id="+id;
			}
		}
		function fetch_checkout_reply(id,reference){
			var formResponse = document.getElementById('formResponse');
			var oldLink = formResponse.action;
			var newLink = oldLink+id+'/'+reference;
			formResponse.setAttribute('action',newLink)
			$.ajax({
				type: 'post',
				url: 'fetch_response',
				data: {
					id:id,
				},
				success: function(response){
					$('#remarks').html(response);
				}
			});
		}
	</script>
	<?php
	}
	?>
</body>
</html>