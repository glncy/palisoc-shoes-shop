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
if ((isset($_SERVER['HTTP_REFERER']))&&(isset($_POST['search'])))
{
	include('connection.php');
	$search=rtrim(ltrim(mysqli_real_escape_string($con,$_POST['search'])));
	$mode=rtrim(ltrim(mysqli_real_escape_string($con,$_POST['mode'])));
	$query = "SELECT * FROM tblpayment WHERE mode_of_payment='$mode' AND ref LIKE '$search%' ORDER BY id DESC";
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