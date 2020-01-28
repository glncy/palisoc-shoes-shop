<?php
if (!isset($_POST['email']))
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
else
{
	include('connection.php');
	$email = rtrim(ltrim(mysqli_real_escape_string($con,$_POST['email'])));
	$query="SELECT * FROM tblusers WHERE email='$email'";
	$get=mysqli_query($con,$query);
	$num_rows=mysqli_num_rows($get);

	if ($num_rows>0)
	{
		echo 'exist';
	}
	else
	{
		if ($email=='')
		{
			echo '';
		}
		else
		{
			echo 'not_exist';
		}
	}
	mysqli_close($con);
}

?>