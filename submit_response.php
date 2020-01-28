<?php
if ((isset($URL[1]))&&(isset($_POST['remarks']))&&(isset($URL[2])))
{
	include('connection.php');
	$id = rtrim(ltrim(mysqli_real_escape_string($con,$URL[1])));
	$ref = rtrim(ltrim(mysqli_real_escape_string($con,$URL[2])));
	$response = rtrim(ltrim(mysqli_real_escape_string($con,$_POST['remarks'])));
	$query = "UPDATE tblcheckout SET remarks='$response', status='replied' WHERE id='$id'";
	if (mysqli_query($con,$query) or die(mysqli_error($con))) {
		$query="DELETE FROM tblnotif WHERE id='$ref'";
		mysqli_query($con,$query);
		echo '<script type="text/javascript">
	alert("Response Submitted Successfully.");
	window.location.href = "'.$_SERVER['HTTP_REFERER'].'";
</script>';
	}
	else
	{
		echo '<script type="text/javascript">
	alert("Failed to Submit Response due to an Error.");
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