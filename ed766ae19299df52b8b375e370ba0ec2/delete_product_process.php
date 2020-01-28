<?php
if (isset($_POST['id'])){
	include('connection.php');
	$id=rtrim(ltrim(mysqli_real_escape_string($con,$_POST['id'])));
	$query="SELECT * FROM tblitems WHERE id='$id'";
	$get=mysqli_query($con,$query);
	$row=mysqli_fetch_array($get);
	$pictures=explode("/", $row['picture']);
	$cnt=count($pictures);

	$query="DELETE FROM tblitems WHERE id='$id'";
	if (mysqli_query($con,$query) or die(mysqli_error($con))) {
		echo "SUCCESS";
		$loop=0;
		while ($loop<$cnt-1) {
			unlink("res/img/".$pictures[$loop]);
			$loop++;
		}
		mysqli_close($con);
	}
	else {
		mysqli_close($con);
		echo "FAILED";
	}
}
else {
	if (isset($_SERVER['HTTP_REFERER']))
	{
		mysqli_close($con);
		header('Location: '.$_SERVER['HTTP_REFERER']);
	}
	else
	{
		mysqli_close($con);
		header('Location: /admin');
	}
}
?>