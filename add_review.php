<?php
if ((isset($URL[1]))&&(isset($_POST['review']))&&(isset($_SESSION['user_id'])))
{
	include('connection.php');

	$review = rtrim(ltrim(mysqli_real_escape_string($con,$_POST['review'])));
	$id= rtrim(ltrim(mysqli_real_escape_string($con,$URL[1])));

	$user_id = $_SESSION['user_id'];

	$query = "SELECT * FROM tblreviews WHERE user_id='$user_id' AND product_id='$id'";
	$get = mysqli_query($con,$query);

	$num_rows = mysqli_num_rows($get);

	if ($num_rows==0)
	{
		$query = "INSERT INTO tblreviews (user_id,product_id,comment) VALUES ('$user_id','$id','$review')";
		if (mysqli_query($con,$query)) {
			echo '<script type="text/javascript">
				alert(\'Review Added Successfully.\');
				window.location.href = "'.$_SERVER['HTTP_REFERER'].'"
			</script>';
		}
		else {
			echo '<script type="text/javascript">
				alert(\'Failed to add review due to an Error.\');
				window.location.href = "'.$_SERVER['HTTP_REFERER'].'"
			</script>';
		}
	}
	else
	{
		echo '<script type="text/javascript">
			alert(\'Failed to add Review. You already added a Review to this Product.\');
			window.location.href = "'.$_SERVER['HTTP_REFERER'].'"
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

