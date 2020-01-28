<?php
if ((isset($URL[2]))&&(isset($_POST['shipping_fee'])))
{
	include('connection.php');
	$id = rtrim(ltrim(mysqli_real_escape_string($con,$URL[2])));
	$shipping_fee = rtrim(ltrim(mysqli_real_escape_string($con,$_POST['shipping_fee'])));
	$query = "UPDATE tblshipping_rates SET rate='$shipping_fee' WHERE id='$id'";
	if (mysqli_query($con,$query) or die(mysqli_error($con))) {
		echo '<script type="text/javascript">
	alert("Updated Successfully.");
	window.location.href = "/admin";
</script>';
	}
	else
	{
		echo '<script type="text/javascript">
	alert("Failed to Update Shipping Fee.");
	window.location.href = "/admin";
</script>';
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