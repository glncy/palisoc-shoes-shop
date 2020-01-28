<?php
if (!isset($_POST['fname']))
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
	$fname = rtrim(ltrim(mysqli_real_escape_string($con,$_POST['fname'])));
	$lname = rtrim(ltrim(mysqli_real_escape_string($con,$_POST['lname'])));
	$birth = rtrim(ltrim(mysqli_real_escape_string($con,$_POST['birth'])));
	$phone = rtrim(ltrim(mysqli_real_escape_string($con,$_POST['phone'])));
	$house_no = rtrim(ltrim(mysqli_real_escape_string($con,$_POST['house_no'])));
	$street = rtrim(ltrim(mysqli_real_escape_string($con,$_POST['street'])));
	$barangay = rtrim(ltrim(mysqli_real_escape_string($con,$_POST['barangay'])));
	$postal = rtrim(ltrim(mysqli_real_escape_string($con,$_POST['postal'])));
	$id = $_SESSION['user_id'];
	if ((isset($_POST['city']))&&(!isset($_POST['province']))) {
		$city = rtrim(ltrim(mysqli_real_escape_string($con,$_POST['city'])));
		$query = "UPDATE tblusers SET fname='$fname', lname='$lname', birth='$birth', phone='$phone', house_no='$house_no', street='$street', barangay='$barangay', postal='$postal', city='$city' WHERE id='$id'";
	}
	else if ((isset($_POST['city']))&&(isset($_POST['province']))) {
		$city = rtrim(ltrim(mysqli_real_escape_string($con,$_POST['city'])));
		$province = rtrim(ltrim(mysqli_real_escape_string($con,$_POST['province'])));
		$query = "UPDATE tblusers SET fname='$fname', lname='$lname', birth='$birth', phone='$phone', house_no='$house_no', street='$street', barangay='$barangay', postal='$postal', city='$city', province='$province' WHERE id='$id'";
	}
	else if ((!isset($_POST['city']))&&(isset($_POST['province']))) {
		$province = rtrim(ltrim(mysqli_real_escape_string($con,$_POST['province'])));
		$query = "UPDATE tblusers SET fname='$fname', lname='$lname', birth='$birth', phone='$phone', house_no='$house_no', street='$street', barangay='$barangay', postal='$postal', province='$province' WHERE id='$id'";
	}
	else {
		$query = "UPDATE tblusers SET fname='$fname', lname='$lname', birth='$birth', phone='$phone', house_no='$house_no', street='$street', barangay='$barangay', postal='$postal' WHERE id='$id'";
	}
	if (mysqli_query($con,$query)) {
		echo '<script type="text/javascript">
			alert("Edited Successfully!")
		</script>';
	}
	else {
		echo '<script type="text/javascript">
			alert("Failed to edit due to an Error!")
		</script>';
	}
	mysqli_close($con);
}
?>

<script type="text/javascript">
	window.location.href = "profile";
</script>

