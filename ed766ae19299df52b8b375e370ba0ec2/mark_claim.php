<table class="table">
	<thead>
		<tr>
			<th>Mode of Payment</th>
			<th></th>
			<th>Amount</th>
			<th>Status</th>
			<th></th>
		</tr>
	</thead>
<?php
if ((isset($_SERVER['HTTP_REFERER']))&&(isset($_POST['id'])))
{
	include('connection.php');
	$id=rtrim(ltrim(mysqli_real_escape_string($con,$_POST['id'])));
	$query = "UPDATE tblpayment SET status='Claimed' WHERE id='$id'";
	mysqli_query($con,$query);
	$query = "SELECT * FROM tblpayment WHERE id='$id'";
	$get = mysqli_query($con,$query);
	while ($row = mysqli_fetch_array($get))
	{
		$status = ucwords($row['status']);
		if ($status == "") {
			$status = "Not Claimed";
		}
	?>
		<tr>
			<td><?php echo $row['mode_of_payment'];?></td>
			<td><?php echo $row['ref'];?></td>
			<td>P<?php echo $row['amount'];?></td>
			<td><?php echo $status;?></td>
			<td><a href="/admin/search_payments#" onclick="claim_payment(<?php echo $row['id'];?>)">Claim</a></td>
		</tr>
	<?php
	}
	mysqli_close($con);
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
		header('Location: /');
	}
}
?>
</table>