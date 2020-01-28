<?php

include('connection.php');
if ((isset($_POST['fname']))&&(isset($_POST['lname']))&&(isset($_POST['birth']))&&(isset($_POST['email']))&&(isset($_POST['pw']))&&(isset($_POST['phone']))&&(isset($_POST['house_no']))&&(isset($_POST['street']))&&(isset($_POST['barangay']))&&(isset($_POST['city']))&&(isset($_POST['province']))&&(isset($_POST['postal']))&&(isset($_POST['q1']))&&(isset($_POST['q1_ans']))&&(isset($_POST['q2']))&&(isset($_POST['q2_ans']))) {

	$fname=rtrim(ltrim(mysqli_real_escape_string($con,$_POST['fname'])));
	$lname=rtrim(ltrim(mysqli_real_escape_string($con,$_POST['lname'])));
	$birth=rtrim(ltrim(mysqli_real_escape_string($con,$_POST['birth'])));
	$email=rtrim(ltrim(mysqli_real_escape_string($con,$_POST['email'])));
	$password=rtrim(ltrim(mysqli_real_escape_string($con,$_POST['pw'])));

	$phone=rtrim(ltrim(mysqli_real_escape_string($con,$_POST['phone'])));
	$house_no=rtrim(ltrim(mysqli_real_escape_string($con,$_POST['house_no'])));
	$street=rtrim(ltrim(mysqli_real_escape_string($con,$_POST['street'])));
	$barangay=rtrim(ltrim(mysqli_real_escape_string($con,$_POST['barangay'])));
	$city=rtrim(ltrim(mysqli_real_escape_string($con,$_POST['city'])));
	$province=rtrim(ltrim(mysqli_real_escape_string($con,$_POST['province'])));
	$postal=rtrim(ltrim(mysqli_real_escape_string($con,$_POST['postal'])));
	$q1=rtrim(ltrim(mysqli_real_escape_string($con,$_POST['q1'])));
	$q2=rtrim(ltrim(mysqli_real_escape_string($con,$_POST['q2'])));
	$q1_ans=rtrim(ltrim(mysqli_real_escape_string($con,$_POST['q1_ans'])));
	$q2_ans=rtrim(ltrim(mysqli_real_escape_string($con,$_POST['q2_ans'])));





	$salt_key="ARCHER";

	$encrypt_pw=md5($salt_key.$password);
	$encrypt_q1=md5($salt_key.$q1_ans);
	$encrypt_q2=md5($salt_key.$q2_ans);

	$query="INSERT INTO tblusers(fname,lname,birth,email,password,role,phone,house_no,street,barangay,city,province,postal,q1,q2,q1_ans,q2_ans) VALUES ('$fname','$lname','$birth','$email','$encrypt_pw','user','$phone','$house_no','$street','$barangay','$city','$province','$postal','$q1','$q2','$encrypt_q1','$encrypt_q2')";

	if (mysqli_query($con,$query)) {
		mysqli_close($con);
		header('Location: '.$_SERVER['HTTP_REFERER']);
		//echo $_SERVER['HTTP_REFERER'];
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