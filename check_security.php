<?php
if ((isset($_POST['id']))&&(isset($_POST['q_target']))&&(isset($_POST['ans']))) {
	include('connection.php');
	$id=rtrim(ltrim(mysqli_real_escape_string($con,$_POST['id'])));
	$q_target=rtrim(ltrim(mysqli_real_escape_string($con,$_POST['q_target']."_ans")));
	$ans=rtrim(ltrim(mysqli_real_escape_string($con,$_POST['ans'])));

	$salt_key="ARCHER";
	$encrypt=md5($salt_key.$ans);

	$query="SELECT * FROM tblusers WHERE id='$id' AND $q_target='$encrypt'";
	$get=mysqli_query($con,$query);
	$num_rows=mysqli_num_rows($get);
	if ($num_rows==1) {
		echo "success";
	}
	else{
		echo "failed";
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