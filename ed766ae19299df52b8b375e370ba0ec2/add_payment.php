<?php
if ((isset($_POST['pay_mode']))&&(isset($_POST['pay_amount']))&&(isset($_POST['pay_ref'])))
{
	include('connection.php');

	$amount = rtrim(ltrim(mysqli_real_escape_string($con,$_POST['pay_amount'])));
	$mode = rtrim(ltrim(mysqli_real_escape_string($con,$_POST['pay_mode'])));
	$ref = rtrim(ltrim(mysqli_real_escape_string($con,$_POST['pay_ref'])));

	$query = "INSERT INTO tblpayment (ref, mode_of_payment, amount) VALUES ('$ref','$mode','$ref')";
	mysqli_query($con,$query);
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