<?php
if (!isset($_POST['oldpw']))
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
	$oldpw = rtrim(ltrim(mysqli_real_escape_string($con,$_POST['oldpw'])));
	$newpw = rtrim(ltrim(mysqli_real_escape_string($con,$_POST['newpw'])));
	$id = $_SESSION['user_id'];
	$salt_key = "ARCHER";
	$encrypt = md5($salt_key.$oldpw);
	$query = "SELECT * FROM tblusers WHERE id='$id' AND password='$encrypt'";
	$get = mysqli_query($con,$query);
	$num_rows = mysqli_num_rows($get);
	if ($num_rows==1) {

		$encrypt = md5($salt_key.$newpw);
		$query = "UPDATE tblusers SET password='$encrypt' WHERE id='$id'";
		if (mysqli_query($con,$query)) {
			echo '<script type="text/javascript">
				alert("Password Updated Successfully!")
			</script>';
		}
		else {
			echo '<script type="text/javascript">
				alert("Failed to update Password due to an Error!")
			</script>';
		}
	}
	else {
		echo '<script type="text/javascript">
			alert("Invalid Password. Please Try Again!")
		</script>';
	}
	
	mysqli_close($con);
}
?>

<script type="text/javascript">
	window.location.href = "profile";
</script>

