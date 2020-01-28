<?php
session_start();
mysqli_report(MYSQLI_REPORT_STRICT);
if (isset($_GET['id']))
{
	include('connection.php');
	$id = rtrim(ltrim(mysqli_real_escape_string($con,$_GET['id'])));
	$query = "DELETE FROM tblcart WHERE id='$id'";
	

	if (mysqli_query($con,$query) or die(mysqli_error($con))) {
		echo mysqli_error($con);
		$user_id=$_SESSION['user_id'];
		$query="SELECT * FROM tblcart WHERE user_id='$user_id'";
	    $get=mysqli_query($con,$query) or die(mysqli_error($con));
	    $cart=mysqli_num_rows($get);
	    echo json_encode(array('cart_count'=>$cart,'status'=>'true'));
	}
	else
	{
		$user_id=$_SESSION['user_id'];
		$query="SELECT * FROM tblcart WHERE user_id='$user_id'";
	    $get=mysqli_query($con,$query) or die(mysqli_error($con));
	    $cart=mysqli_num_rows($get);
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