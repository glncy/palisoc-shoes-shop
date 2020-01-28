<?php
if (isset($_POST['search'])) {
	$_POST['search'];
	header('Location: /search/'.$_POST['search']);
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