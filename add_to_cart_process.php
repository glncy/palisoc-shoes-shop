<?php
if ((isset($_GET['product']))&&(isset($_POST['qty'])))
{
	include('connection.php');

	$id = rtrim(ltrim(mysqli_real_escape_string($con,$_GET['product'])));
	$qty = rtrim(ltrim(mysqli_real_escape_string($con,$_POST['qty'])));

	$user_id = $_SESSION['user_id'];

	$query = "INSERT INTO tblcart (user_id,	item_id, qty) VALUES ('$user_id','$id','$qty')";

	if (mysqli_query($con,$query)) {
		header('Location: '.$_SERVER['HTTP_REFERER']);
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

<script type="text/javascript">
	alert('Failed to Add Product to Cart due an Error.');
	window.location.href = "<?php echo $_SERVER['HTTP_REFERER'];?>";
</script>