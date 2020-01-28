<?php
include('connection.php');
if ((isset($URL[1]))&&(isset($_POST['new_pw']))) {
	$user_id=$URL[1];
	$pw=$_POST['new_pw'];

	$salt_key="ARCHER";

	$encrypt=md5($salt_key.$pw);

	$query="UPDATE tblusers SET password='$encrypt' WHERE id='$user_id'";
	if (mysqli_query($con,$query)) {
		if (isset($_SERVER['HTTP_REFERER']))
		{
			mysqli_close($con);
			header('Location: '.$_SERVER['HTTP_REFERER']);
		}
		else
		{
			mysqli_close($con);
			header('Location: '.$_SERVER['DOCUMENT_ROOT']);
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
			header('Location: '.$_SERVER['DOCUMENT_ROOT']);
		}
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