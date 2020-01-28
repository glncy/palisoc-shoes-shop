<?php
if ((isset($_POST['email']))&&(isset($_POST['pw'])))
{
	include('connection.php');

	$email = rtrim(ltrim(mysqli_real_escape_string($con,$_POST['email'])));
	$pw = rtrim(ltrim(mysqli_real_escape_string($con,$_POST['pw'])));

	$salt_key = "ARCHER";

	$encrypt_pw = md5($salt_key.$pw);
	$query = "SELECT * FROM tblusers WHERE email='$email' AND password='$encrypt_pw'";
	$get = mysqli_query($con,$query) or die(mysqli_error($con));
	$num_row = mysqli_num_rows($get);
	if ($num_row==1) {
		$row=mysqli_fetch_array($get);
		$_SESSION['user_name'] = $row['fname']." ".$row['lname'];
		$_SESSION['user_id'] = $row['id'];
		echo "success";
	}
	else
	{
		echo "<script type='text/javascript'>
			setTimeout(function() {
			    $('#notif').fadeOut('slow');
			}, 4000); // <-- time in milliseconds
		</script>
		<div class='col-sm-12' id='notif'>
		     <h5 style='padding: 10px; background-color: red; color: white;'>Incorrect Email or Password.</h5>
		</div>";
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