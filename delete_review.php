<?php
if (isset($URL[1]))
{
	include('connection.php');

	$id= rtrim(ltrim(mysqli_real_escape_string($con,$URL[1])));

	$query = "SELECT * FROM tblreviews WHERE id='$id'";
	$get = mysqli_query($con,$query);
	$num_rows = mysqli_num_rows($get);
	if ($num_rows>0)
	{
		$query = "DELETE FROM tblreviews WHERE id='$id'";
		if (mysqli_query($con,$query)) {
			echo '<script type="text/javascript">
				alert(\'Review Deleted Successfully.\');
				window.location.href = "'.$_SERVER['HTTP_REFERER'].'"
			</script>';
		}
		else {
			echo '<script type="text/javascript">
				alert(\'Failed to delete review due to an Error.\');
				window.location.href = "'.$_SERVER['HTTP_REFERER'].'"
			</script>';
		}
	}
	else
	{
		echo '<script type="text/javascript">
			window.location.href = "'.$_SERVER['HTTP_REFERER'].'"
		</script>';
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
		header('Location: /');
	}
}
?>