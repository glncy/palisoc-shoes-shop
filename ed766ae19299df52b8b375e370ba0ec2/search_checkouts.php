<?php
if (isset($_POST['search'])) {
	include('connection.php');
	$search=rtrim(ltrim(mysqli_real_escape_string($con,$_POST['search'])));
	if ($_POST['target']=='search_pending') {
		$query="SELECT * FROM tblcheckout WHERE id LIKE '%$search%' OR status LIKE '%$search%' AND status='delivered' ORDER BY id DESC";
		$get=mysqli_query($con,$query) or die(mysqli_error($con));
		$output='<table class="table">
					<thead>
						<tr>
							<th>Order ID</th>
							<th>Status</th>
							<th>Date</th>
							<th></th>
							<th></th>
						</tr>
					</thead>';
		$num_rows=mysqli_num_rows($get);
		if ($num_rows>0) {
			while ($row=mysqli_fetch_array($get)) {
				if ($row['status']!='delivered') {
					$status="";
					if ($row['status']=='') {
						$status='Verifying';
					}
					else {
						$status = ucwords($row['status']);
					}
					$output.='<tr>
						<td>'.$row['id'].'</td>
						<td>'.$status.'</td>
						<td>'.$row['checkout_date'].'</td>
						<td><a href="/admin#" data-toggle="modal" data-target="#check_out_info" onclick="fetch_checkout(\''.$row['id'].'\',\'check_out_view\');">View</a></td>
						<td><a href="/admin#" data-toggle="modal" data-target="#update_status" onclick="update_status(\''.$row['id'].'\',\''.$row['status'].'\');">Update Status</a></td>
					</tr>';
				}
			}
			$output.="</table>";
			mysqli_close($con);
			echo $output;
		}
		else {
			mysqli_close($con);
			echo '<table class="table"><thead><tr><th><center>Data Not Found</center></th></tr></thead></table>';
		}
	}
	else if  ($_POST['target']=='search_all') {
		$query="SELECT * FROM tblcheckout WHERE id LIKE '%$search%' OR status LIKE '%$search%' ORDER BY id DESC";	
		$get=mysqli_query($con,$query) or die(mysqli_error($con));
		$output='<table class="table">
					<thead>
						<tr>
							<th>Order ID</th>
							<th>Status</th>
							<th>Date</th>
							<th></th>
							<th></th>
						</tr>
					</thead>';
		$num_rows=mysqli_num_rows($get);
		if ($num_rows>0) {
			while ($row=mysqli_fetch_array($get)) {
				$status="";
				if ($row['status']=='') {
					$status='Verifying';
				}
				else {
					$status = ucwords($row['status']);
				}
			$output.='<tr>
				<td>'.$row['id'].'</td>
				<td>'.$status.'</td>
				<td>'.$row['checkout_date'].'</td>
				<td><a href="/admin#" data-toggle="modal" data-target="#check_out_info" onclick="fetch_checkout(\''.$row['id'].'\',\'check_out_view\');">View</a></td>
			</tr>';
			}
			$output.="</table>";
			mysqli_close($con);
			echo $output;
		}
		else {
			mysqli_close($con);
			echo '<table class="table"><thead><tr><th><center>Data Not Found</center></th></tr></thead></table>';
		}
	}
	else {
		$query="SELECT * FROM tblshipping_rates WHERE province LIKE '%$search%' OR city LIKE '%$search%' ORDER BY id DESC";	
		$get=mysqli_query($con,$query) or die(mysqli_error($con));
		$num_rows=mysqli_num_rows($get);
		if ($num_rows>0) {
			while ($row=mysqli_fetch_array($get)) {
				echo '<div class="col-sm-12" style="padding-bottom: 10px;">
							<a href="admin#" data-target="#ShippingFee" data-toggle="modal" onclick="shipping_fee(\''.$row['id'].'\',\''.$row['city'].', '.$row['province'].'\',\''.$row['rate'].'\');">'.$row['city'].", ".$row['province'].'</a>
						</div>';
			}	
		}
		else {
			mysqli_close($con);
			echo '<div class="col-sm-12" style="padding-bottom: 10px;">
							<center><h4>Data Not Found.</h4></center>
						</div>';
		}
	}
}

else
{
	if (isset($_SERVER['HTTP_REFERER']))
	{
		mysqli_close($con);
		header('Location: '.$_SERVER['HTTP_REFERER']);
	}
	else
	{
		mysqli_close($con);
		header('Location: /admin');
	}
}

?>