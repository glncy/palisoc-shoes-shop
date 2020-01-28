<?php
$location = "Home";
include('header.php');
?>

<div class="container" style="background-color: white; padding-top: 15px;">
	<h4>Dashboard</h4>
	<hr/>
	<div class="row">
		<div class="col-sm-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h5>Request for Shipping Fee Rates</h5>
				</div>
				<div class="panel-body pre-scrollable">
					<div class="row">
						<?php
						include('connection.php');
						$query = "SELECT * FROM tblshipping_rates WHERE rate='0.00' ORDER BY id DESC";
						$get = mysqli_query($con,$query);
						while ($row = mysqli_fetch_array($get))
						{
						?>
						<div class="col-sm-12" style="padding-bottom: 10px;">
							<a href="admin#" data-target="#ShippingFee" data-toggle="modal" onclick="shipping_fee('<?php echo $row['id'];?>','<?php echo $row['city'].", ".$row['province'];?>','<?php echo $row['rate'];?>');"><?php echo $row['city'].", ".$row['province'];?></a>
						</div>
						<?php
						}
						$num_rows = mysqli_num_rows($get);
						if ($num_rows==0) {
						?>
						<div class="col-sm-12" style="padding-bottom: 10px;">
							<center><h4>No Request.</h4></center>
						</div>
						<?php
						}
						mysqli_close($con);
						?>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h5>Shipping Fee Rates</h5>
				</div>
				<div class="panel-body pre-scrollable">
					<div class="row">
						<div class="col-sm-12">
							<input type="type" placeholder="Search Place" class="form-control" id="search_all_place" onkeyup="search('search_all_place');">
						</div>
					</div>
					<br/>
					<div class="row" id="result_search_places">
						<?php
						include('connection.php');
						$query = "SELECT * FROM tblshipping_rates WHERE rate!='0.00' ORDER BY id DESC ";
						$get = mysqli_query($con,$query) or die(mysqli_error($con));
						while ($row = mysqli_fetch_array($get))
						{
						?>
						<div class="col-sm-12" style="padding-bottom: 10px;">
							<a href="admin#" data-target="#ShippingFee" data-toggle="modal" onclick="shipping_fee('<?php echo $row['id'];?>','<?php echo $row['city'].", ".$row['province'];?>','<?php echo $row['rate'];?>');"><?php echo $row['city'].", ".$row['province'];?></a>
						</div>
						<?php
						}
						$num_rows = mysqli_num_rows($get);
						if ($num_rows==0) {
						?>
						<div class="col-sm-12" style="padding-bottom: 10px;">
							<center><h4></h4></center>
						</div>
						<?php
						}
						mysqli_close($con);
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<hr/>
	<div class="row">
		<div class="col-sm-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h5>Pending Check Outs</h5>
				</div>
				<div class="panel-body pre-scrollable">
					<div class="row">
						<div class="col-sm-12">
							<input type="type" placeholder="Search Order ID or Status" class="form-control" id="search_pending"  onkeyup="search('search_pending');">
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 table-responsive">
							<table class="table" id="result_search_pending">
								<thead>
									<tr>
										<th>Order ID</th>
										<th>Status</th>
										<th>Date</th>
										<th></th>
										<th></th>
									</tr>
								</thead>
						<?php
						include('connection.php');
						$query = "SELECT * FROM tblcheckout WHERE status!='delivered' ORDER BY id DESC";
						$get = mysqli_query($con,$query);
						while ($row = mysqli_fetch_array($get))
						{
							$status = ucwords($row['status']);
							if ($status == "") {
								$status = "Verifying";
							}
						?>
							<tr>
								<td><?php echo $row['id'];?></td>
								<td><?php echo $status;?></td>
								<td><?php echo $row['checkout_date'];?></td>
								<td><a href="/admin#" data-toggle="modal" data-target="#check_out_info" onclick="fetch_checkout('<?php echo $row['id'];?>','check_out_view');">View</a></td>
								<td><a href="/admin#" data-toggle="modal" data-target="#update_status" onclick="update_status('<?php echo $row['id'];?>','<?php echo $row['status'];?>');">Update Status</a></td>
							</tr>
						<?php
						}
						mysqli_close($con);
						?>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h5>All Check Outs</h5>
				</div>
				<div class="panel-body pre-scrollable">
					<div class="row">
						<div class="col-sm-12">
							<input type="type" placeholder="Search Order ID or Status" class="form-control" id="search_all" onkeyup="search('search_all');">
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 table-responsive">
							<table class="table" id="result_search_all">
								<thead>
									<tr>
										<th>Order ID</th>
										<th>Status</th>
										<th>Date</th>
										<th></th>
									</tr>
								</thead>
						<?php
						include('connection.php');
						$query = "SELECT * FROM tblcheckout ORDER BY id DESC";
						$get = mysqli_query($con,$query);
						while ($row = mysqli_fetch_array($get))
						{
							$status = ucwords($row['status']);
							if ($status == "") {
								$status = "Verifying";
							}
						?>
							<tr>
								<td><?php echo $row['id'];?></td>
								<td><?php echo $status;?></td>
								<td><?php echo $row['checkout_date'];?></td>
								<td><a href="/admin#" data-toggle="modal" data-target="#check_out_info" onclick="fetch_checkout('<?php echo $row['id'];?>','check_out_view');">View</a></td>
							</tr>
						<?php
						}
						mysqli_close($con);
						?>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<hr/>
	<div class="row">
		<div class="col-sm-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h5>List of Header Images</h5>
				</div>
				<div class="panel-body pre-scrollable">
					<form action="/admin/upload_image" class="form-group" enctype="multipart/form-data" method="post">
						<fieldset>
							<label>Add Header Image (1280px x 350px)</label>
							<div class="row">
								<div class="col-sm-6">
									<input type="file" name="photo" class="form-control">
								</div>
								<div class="col-sm-6">
									<input type="text" name="title" class="form-control" placeholder="Title">
								</div>
								<div class="col-sm-12">
									<br/>
								</div>
								<div class="col-sm-6">
									<input type="text" name="desc" class="form-control" placeholder="Description">
								</div>
								<div class="col-sm-6">
									<input type="submit" value="Upload" class="btn btn-success form-control">
								</div>
							</div>
						</fieldset>
					</form>
					<hr/>
					<div class="row">
						<div class="col-sm-12 table-responsive">
							<table class="table" id="result_search_pending">
								<thead>
									<tr>
										<th>Image Title</th>
										<th>Description</th>
										<th></th>
									</tr>
								</thead>
						<?php
						include('connection.php');
						$query = "SELECT * FROM tbllist WHERE type='header_image' ORDER BY id DESC";
						$get = mysqli_query($con,$query);
						while ($row = mysqli_fetch_array($get))
						{
						?>
							<tr>
								<td><a href="res/img/<?php echo $row['picture'];?>" target="_blank"><?php echo $row['title'];?></a></td>
								<td><?php echo $row['description'];?></td>
								<td><a href="admin/delete_header_image/<?php echo $row['id'];?>">Delete</a></td>
							</tr>
						<?php
						}
						mysqli_close($con);
						?>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h5>Payment Database</h5>
				</div>
				<div class="panel-body pre-scrollable">
					<div class="row">
						<div class="col-sm-12">
							<select class="form-control" id="payment_mode">
	      						<option>Select Payment Method</option>
	      						<option>LBC Remittance</option>
	      						<option>Cebuana Lhuillier</option>
	      						<option>MLhuillier</option>
	      						<option>Palawan Express</option>
	      						<option>GCASH</option>
	      						<option>Paymaya</option>
	      					</select>
						</div>
						<div class="col-sm-12">
							<br/>
						</div>
						<div class="col-sm-12">
							<input type="number" class="form-control" placeholder="Control No. / Tracking No. / KPTN /Reference No." id="payment_reference">
						</div>
						<div class="col-sm-12">
							<br/>
						</div>
						<div class="col-sm-6">
							<input type="number" class="form-control" placeholder="Amount" id="payment_amount">
						</div>
						<div class="col-sm-6">
							<input type="button" class="btn btn-success form-control" value="Add" onclick="add_payment();">
						</div>
					</div>
					<hr/>
					<div class="row" id="3">
						<div class="col-sm-12 table-responsive" id="dbpayment">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
if ($location="Home") {
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
      			<div class="row">
      				<div class="col-sm-12">
      					<a href="/admin/search_payments"
   onclick="window.open(this.href,'targetWindow',
                                   'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=550,height=600'); return false;">Check Payment</a>
      				</div>
      			</div>
      		</div>
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

	fetch_paymentdb();

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

			$.getJSON("/fetch_details.php", data, function(result) {
				cnt = parseInt(result.item_count);
				loop = 0;
				while (loop<cnt){
					price = parseFloat(result.price[loop]);
					formatPrice = (price).formatMoney(2,'.',',');
					output += "<tr><td><a href='product/"+result.product_id[loop]+"' target='_blank'>"+result.product_name[loop]+"</a></td><td>"+result.qty[loop]+"</td><td>₱"+formatPrice+"</td></tr>";
					loop++;
				}
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
				output += result.bill_address;+"<br/>";
				output += "<h4>Payment Info</h4>";
				output += result.bill_mode+"<br/>";
				output += result.bill_trans+"<br/>";
				output += result.bill_total+"<br/>";
				if (result.remarks!='') {
					output += "<h4>Remarks</h4>";
					output += result.remarks+"<br/>";
				}
				if ((result.status!='')&&(result.status!='verified')&&(result.status!='processing')&&(result.status!='failed')&&(result.status!='replied')) {
					output += "<br/><a href='receipt.php?id='"+id+" target='_blank'>Receipt</a>";
				}
				output += "</p>"

				$('#bill_details').html(output);
			});
		}
	}

	function update_status(id,recent){
		var form_update = document.getElementById('form_update');
		var old = form_update.action;
		var newForm = old+id;
		form_update.setAttribute('action',newForm);

		if (recent=='') {
			document.getElementById('recent_status').innerHTML = "<option selected>Verifying</option><option>Verified</option><option>Failed</option><option>Processing</option><option>Delivering</option><option>Delivered</option>";
		}
		else if (recent=='verified'){
			document.getElementById('recent_status').innerHTML = "<option>Verifying</option><option selected>Verified</option><option>Failed</option><option>Processing</option><option>Delivering</option><option>Delivered</option>";
		}
		else if (recent=='processing'){
			document.getElementById('recent_status').innerHTML = "<option>Verifying</option><option>Verified</option><option>Failed</option><option selected>Processing</option><option>Delivering</option><option>Delivered</option>";
		}
		else if (recent=='failed'){
			document.getElementById('recent_status').innerHTML = "<option>Verifying</option><option>Verified</option><option selected>Failed</option><option>Processing</option><option>Delivering</option><option>Delivered</option>";
		}
		else if (recent=='delivering'){
			document.getElementById('recent_status').innerHTML = "<option>Verifying</option><option>Verified</option><option>Failed</option><option>Processing</option><option selected>Delivering</option><option>Delivered</option>";
		}
		else if (recent=='replied'){
			document.getElementById('recent_status').innerHTML = "<option>Verified</option><option>Failed</option><option>Processing</option><option>Delivering</option><option>Delivered</option>";
		}
	}

	function onchange_select(){
		var target=document.getElementById('recent_status').value;
		if (target=="Delivering") {
			document.getElementById('remarks').innerHTML = '<div class="input-group"><span class="input-group-addon">Remarks</span><textarea class="form-control" placeholder="Place Tracking Number" name="remarks" required="" style="resize: none;"></textarea></div>';
		}
		else if (target=="Failed") {
			document.getElementById('remarks').innerHTML = '<div class="input-group"><span class="input-group-addon">Remarks</span><textarea class="form-control" placeholder="Remarks" name="remarks" required="" style="resize: none;"></textarea></div>';
		}
		else {
			document.getElementById('remarks').innerHTML = '';
		}
	}

	function search(target){
		var search=document.getElementById(target).value;
		$.ajax({
			type: 'post',
			url: '/admin/search_checkouts',
			data: {
				search:search,target:target,
			},
			success: function(response){
				if (target=='search_pending') {
					$('#result_search_pending').html(response);
				}
				else if (target=='search_all') {
					$('#result_search_all').html(response);
				}
				else {
					$('#result_search_places').html(response);
				}
			}
		});
	}
	function add_payment(){
		var pay_mode = document.getElementById('payment_mode').value;
		var pay_amount = document.getElementById('payment_amount').value;
		var pay_ref = document.getElementById('payment_reference').value;
		$.ajax({
			type: 'post',
			url: '/admin/add_payment',
			data: {
				pay_mode:pay_mode,pay_amount:pay_amount,pay_ref:pay_ref,
			},
			success: function(response){
				fetch_paymentdb();	
				document.getElementById('payment_mode').value = "";
				document.getElementById('payment_amount').value = "";
				document.getElementById('payment_reference').value = "";
			}
		});		
	}
	function fetch_paymentdb(){
		$.ajax({
			type: 'post',
			url: '/admin/fetch_paymentdb',
			success: function(response){
				$('#dbpayment').html(response);	
			}
		});		
	}
	function delete_payment(id){
		var ans = confirm('Delete Payment Data?');
		if (ans==true) {
			$.ajax({
				type: 'post',
				url: '/admin/delete_payment',
				data: {
					id:id,
				},
				success: function(response){
					fetch_paymentdb();
					alert('Success.');
				}
			});	
		}
		else {
			alert('Cancelled.');
		}
	}
</script>
<div id="update_status" class="modal fade" role="dialog">
	<div class="modal-dialog modal-sm">
    	<div class="modal-content">
    		<div class="modal-header">
    			<button type="button" class="close" data-dismiss="modal">&times;</button>
        		<h4 class="modal-title">Update Status</h4>
    		</div>
    		<form action="/admin/update_status/" method="post" id="form_update">
	    		<div class="modal-body">
	    			<div class="row">
	    				<div class="col-sm-12">
	    					<div class="input-group">
			        			<span class="input-group-addon">
						        	Status
						      	</span>
						    	<select class="form-control" id="recent_status" name="status" required="" onchange="onchange_select();"></select>
						    </div>
	    				</div>
	    				<div class="col-sm-12">
	    					<br/>
	    				</div>
	    				<div class="col-sm-12" id="remarks">
	    				</div>
	    			</div>
	    		</div>
	    		<div class="modal-footer">
	    			<input type="submit" class="btn btn-success btn-login" value="Update Status">
	    		</div>
    		</form>
    	</div>
    </div>
</div>
    	
<?php
}
?>
<?php
include('footer.php');
?>