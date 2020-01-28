<?php
$location = "Transactions";
include('header.php');
$user_id=$_SESSION['user_id'];
?>

<div class="container" style="background-color: white; padding-top: 15px;">
	<div class="row">
		<div class="col-sm-12">
			<h2>Transactions</h2>
		</div>
	</div>
	<hr/>
	<div class="row">
		<div class="col-sm-4">
			<div class="row">
				<div class="col-sm-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							<span>Notifications</span>
							<a href="clear_notification/<?php echo $user_id;?>" class="pull-right">Clear</a>
						</div>
						<div class="panel-body pre-scrollable" style="height: 400px; max-height: 400px;" >
							<?php
							include('connection.php');
							$query = "SELECT * FROM tblnotif WHERE user_id='$user_id' ORDER BY id DESC LIMIT 20";
							$get = mysqli_query($con,$query);
							while ($row=mysqli_fetch_array($get)) {
								$data = json_decode($row['json_notif'],true);
							?>
							<?php
								if ($data['notif']=="CHECK_OUT_VERIFY") {
							?>
								<div class="row">
									<div class="col-sm-12">
										<p style="border: 2px solid black; padding: 18px; <?php
										if ($row['read_notif']=="false") {
											echo "background-color: #e9ff89;";
										}
										?>">Your Check Out Details is on Verification Process. <a href="transactions#" data-toggle="modal" data-target="#check_out_info" onclick="fetch_checkout('<?php echo $data['id'];?>','check_out_view');">Click Here</a> to see the Check Out Details.</p>
									</div>
								</div>
							<?php
								}
								elseif ($data['notif']=="CHECK_OUT_VERIFIED") {
							?>
								<div class="row">
									<div class="col-sm-12">
										<p style="border: 2px solid black; padding: 18px; <?php
										if ($row['read_notif']=="false") {
											echo "background-color: #e9ff89;";
										}
										?>">Your Check Out Details is Verified. <a href="transactions#" data-toggle="modal" data-target="#check_out_info" onclick="fetch_checkout('<?php echo $data['id'];?>','check_out_view');">Click Here</a> to see the Check Out Details.</p>
									</div>
								</div>
							<?php
								}
								elseif ($data['notif']=="CHECK_OUT_FAILED") {
							?>
								<div class="row">
									<div class="col-sm-12">
										<p style="border: 2px solid black; padding: 18px; <?php
										if ($row['read_notif']=="false") {
											echo "background-color: #e9ff89;";
										}
										?>">Failed to Verify Check Out. <a href="transactions#" data-toggle="modal" data-target="#check_out_reply" onclick="fetch_checkout_reply('<?php echo $data['id'];?>','<?php echo $row['id'];?>');">Click Here</a> to see the Check Out Details.</p>
									</div>
								</div>
							<?php
								}
								elseif ($data['notif']=="CHECK_OUT_PROCESSING") {
							?>
								<div class="row">
									<div class="col-sm-12">
										<p style="border: 2px solid black; padding: 18px; <?php
										if ($row['read_notif']=="false") {
											echo "background-color: #e9ff89;";
										}
										?>">Your Check Out is now Processing. <a href="transactions#" data-toggle="modal" data-target="#check_out_info" onclick="fetch_checkout('<?php echo $data['id'];?>','check_out_view');">Click Here</a> to see the Check Out Details.</p>
									</div>
								</div>
							<?php
								}
								elseif ($data['notif']=="CHECK_OUT_DELIVERING") {
							?>
								<div class="row">
									<div class="col-sm-12">
										<p style="border: 2px solid black; padding: 18px; <?php
										if ($row['read_notif']=="false") {
											echo "background-color: #e9ff89;";
										}
										?>">Delivering Check Out.<br/>Tracking Number : <?php echo $data['remarks'];?> <a href="transactions#" data-toggle="modal" data-target="#check_out_info" onclick="fetch_checkout('<?php echo $data['id'];?>','check_out_view');">Click Here</a> to see the Check Out Details.</p>
									</div>
								</div>
							<?php
								}
								elseif ($data['notif']=="CHECK_OUT_DELIVERED") {
							?>
								<div class="row">
									<div class="col-sm-12">
										<p style="border: 2px solid black; padding: 18px; <?php
										if ($row['read_notif']=="false") {
											echo "background-color: #e9ff89;";
										}
										?>">Your Check Out is Already Delivered.<br/><?php echo $data['remarks'];?><br/><a href="transactions#" data-toggle="modal" data-target="#check_out_info" onclick="fetch_checkout('<?php echo $data['id'];?>','check_out_view');">Click Here</a> to see the Check Out Details.</p>
									</div>
								</div>
							<?php
								}
							?>
							<?php
							}
							$query = "UPDATE tblnotif SET read_notif='true' WHERE user_id='$user_id'";
							mysqli_query($con,$query);
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-8">
			<div class="row">
				<div class="col-sm-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4>Orders</h4>
						</div>
						<div class="panel-body pre-scrollable" style="height: 400px; max-height: 400px;" >
							<div class="row">
									<div class="col-sm-12">
										<div class="table-responsive">
											<table class="table">
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
							$user_id=$_SESSION['user_id'];
							$query = "SELECT * FROM tblcheckout WHERE user_id='$user_id' ORDER BY id DESC";
							$get = mysqli_query($con,$query) or die(mysqli_error($con));
							while ($row=mysqli_fetch_array($get)) {
								$order_id = $row['id'];
								$status = ucwords($row['status']);
								if ($status == "") {
									$status = "Verifying";
								}
								$date = $row['checkout_date'];
							?>
											<tr>
												<td><?php echo $order_id;?></td>
												<td><?php echo $status;?></td>
												<td><?php echo $date;?></td>
												<td><a href="transactions#" data-toggle="modal" data-target="#check_out_info" onclick="fetch_checkout('<?php echo $order_id;?>','check_out_view');">View</a></td>
											</tr>
											
							<?php
							}
							?>
										</table>
									</div>
								</div>
							</div>
							<br/>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
include('footer.php');
?>