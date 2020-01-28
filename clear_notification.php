<?php
if (isset($URL[1]))
{
	include('connection.php');
	$id = rtrim(ltrim(mysqli_real_escape_string($con,$URL[1])));
	$query = "DELETE FROM tblnotif WHERE user_id='$id'";
	if (mysqli_query($con,$query) or die(mysqli_error($con))) {
		echo '<script type="text/javascript">
	alert("Cleared Notification Successfully.");
	window.location.href = "'.$_SERVER['HTTP_REFERER'].'";
</script>';
	}
	else
	{
		echo '<script type="text/javascript">
	alert("Failed to Update Shipping Fee.");
	window.location.href = "'.$_SERVER['HTTP_REFERER'].'";
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