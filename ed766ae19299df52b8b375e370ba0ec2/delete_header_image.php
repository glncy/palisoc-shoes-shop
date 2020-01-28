<?php
if (isset($URL[2]))
{
	include('connection.php');

	$id = rtrim(ltrim(mysqli_real_escape_string($con,$URL[2])));

	$query = "SELECT * FROM tbllist WHERE id='$id'";
	$get = mysqli_query($con,$query);
	$row =  mysqli_fetch_array($get);
	$name = $row['picture'];

	$query = "DELETE FROM tbllist WHERE id='$id'";
	if (mysqli_query($con,$query)) {
		unlink("res/img/".$name);
		echo '<script type="text/javascript">
			alert("Deleted Successfully.");
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