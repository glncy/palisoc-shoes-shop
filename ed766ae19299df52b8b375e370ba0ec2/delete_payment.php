<?php
if (isset($_POST['id']))
{
	include('connection.php');

	$id = rtrim(ltrim(mysqli_real_escape_string($con,$_POST['id'])));

	$query = "DELETE FROM tblpayment WHERE id='$id'";
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