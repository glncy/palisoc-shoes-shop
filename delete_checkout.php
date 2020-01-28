<?php
if (isset($_GET['id']))
{
	include('connection.php');

	$id= rtrim(ltrim(mysqli_real_escape_string($con,$_GET['id'])));
	$query = "DELETE FROM tblcheckout WHERE id='$id'";

	if (mysqli_query($con,$query)) {
		$json = mysqli_real_escape_string($con,'{"notif":"CHECK_OUT_VERIFY","id":'.$id.'}');
		$query = "DELETE FROM tblnotif WHERE json_notif='$json'";
		if (mysqli_query($con,$query)) {
			echo '<script type="text/javascript">
				alert("Check Out Cancelled Successfully.");
				window.location.href = "/transactions";
			</script>';
		}
	}
	else {
		echo '<script type="text/javascript">
			alert("Failed to Cancel Check Out.");
			window.location.href = "/transactions";
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
