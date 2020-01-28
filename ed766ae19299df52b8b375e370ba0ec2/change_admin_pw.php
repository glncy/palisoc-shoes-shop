<?php
if (isset($_POST['oldpw']))
{
	include('connection.php');

	$oldpw = rtrim(ltrim(mysqli_real_escape_string($con,$_POST['oldpw'])));
	$newpw = rtrim(ltrim(mysqli_real_escape_string($con,$_POST['newpw'])));
	$cpw = rtrim(ltrim(mysqli_real_escape_string($con,$_POST['cpw'])));

	if ($newpw==$cpw) {
		$salt_key="ARCHER";
		$encrypt=md5($salt_key.$oldpw);
		$query = "SELECT * FROM tblusers WHERE role='admin' AND password='$encrypt'";
		$get = mysqli_query($con,$query);
		$num_rows = mysqli_num_rows($get);
		if ($num_rows!=0) {
			$encrypt=md5($salt_key.$newpw);
			$query = "UPDATE tblusers SET password='$encrypt' WHERE role='admin'";
			mysqli_query($con,$query);
			mysqli_close($con);
			echo '<script type="text/javascript">
			alert("Updated Password Successfully.");
			window.location.href = "/admin/manage";
					</script>';
		}
		else {
			echo '<script type="text/javascript">
			alert("Unable to Update. Invalid Current Password.");
			window.location.href = "/admin/manage";
					</script>';
		}
		
	}
	else {
		echo '<script type="text/javascript">
		alert("Failed to Update. Password Mismatch.");
		window.location.href = "/admin/manage";
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