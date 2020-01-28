<?php
if ((isset($_POST['billing_mode']))&&(isset($_POST['mode_of_payment']))&&(isset($_POST['payment_reference']))&&(isset($_POST['payment_amount'])))
{
	include('connection.php');

	$billing_mode = rtrim(ltrim(mysqli_real_escape_string($con,$_POST['billing_mode'])));
	$mode_of_payment = rtrim(ltrim(mysqli_real_escape_string($con,$_POST['mode_of_payment'])));
	$payment_reference = rtrim(ltrim(mysqli_real_escape_string($con,$_POST['payment_reference'])));
	$payment_amount = rtrim(ltrim(mysqli_real_escape_string($con,$_POST['payment_amount'])));

	$shipping_fee = 0;
	$user_id = $_SESSION['user_id'];
	$query = "SELECT * FROM tblusers WHERE id='$user_id'";
	$get = mysqli_query($con,$query) or die (mysqli_error($con));
	$details = mysqli_fetch_array($get);

	$city = $details['city'];
	$province = $details['province'];


	$query_2 = "SELECT * FROM tblshipping_rates WHERE city='$city' AND province='$province'";
	$get_2 = mysqli_query($con,$query_2);
	$row_2 = mysqli_fetch_array($get_2);

	$shipping_fee = (float) $row_2['rate'];

	$shipping_info = "";
	$shipping_info .= $details['fname']."#";
	$shipping_info .= $details['lname']."#";
	$shipping_info .= $details['email']."#";
	$shipping_info .= $details['phone']."#";
	$shipping_info .= $details['house_no'].", ".$details['street'].", ".$details['barangay'].", ".$details['city'].", ".$details['province'].", ".$details['postal'];

	$billing_info = "";

	if ($billing_mode=="true") {
		$billing_info .= $mode_of_payment."#";
		$billing_info .= $payment_reference."#";
		$billing_info .= $payment_amount."#";
		$billing_info .= $shipping_info;
		//echo $billing_info;
	}
	else {
		$billing_info .= $mode_of_payment."#";
		$billing_info .= $payment_reference."#";
		$billing_info .= $payment_amount."#";
		$billing_info .= $_POST['bill_fname']."#";
		$billing_info .= $_POST['bill_lname']."#";	
		$billing_info .= $_POST['bill_email']."#";	
		$billing_info .= $_POST['bill_phone']."#";	
		$billing_info .= $_POST['bill_address']."#";
		//echo $billing_info;
	}
	$price_info = "";
	$products_id_info = "";
	$qtys_info = "";
	$total_amount_info = 0;
	$query = "SELECT * FROM tblcart WHERE user_id='$user_id'";
	$get = mysqli_query($con,$query);
	while ($row = mysqli_fetch_array($get)){
		$product_id = $row['item_id'];
		$qty = $row['qty'];

		$query_2 = "SELECT * FROM tblitems WHERE id='$product_id'";
		$get_2 = mysqli_query($con,$query_2);
		$row_2 = mysqli_fetch_array($get_2);

		$disc = (float) $row_2['discount']/100;
		$disc_price = (float) $row_2['price']*$disc;
		$total = (float) $row_2['price']-$disc_price;
		$format = number_format($total,2);

		$total_amount = (float) round($total*$row['qty'],2);
		$total_amount_info += (float) $total_amount;
		$price_info .= $total_amount."#";
		$products_id_info .= $product_id."#";
		$qtys_info .= $qty."#";
		$new_qty = (int)$row_2['qty']-$qty;
		$query_3 = "UPDATE tblitems SET qty='$new_qty' WHERE id='$product_id'";
		mysqli_query($con,$query_3) or die($con);
	}
	
	$total_amount_info += $shipping_fee;
	$checkout_date = date("Y-m-d");
	//echo $checkout_date;
	$query = "INSERT INTO tblcheckout (shipping_info,billing_info,products_id,price,qtys,shipping_fee,total_amount,user_id,checkout_date) VALUES ('$shipping_info','$billing_info','$products_id_info','$price_info','$qtys_info','$shipping_fee','$total_amount_info','$user_id','$checkout_date')";

	if (mysqli_query($con,$query)) {
		echo '<script type="text/javascript">
				alert(\'Check Out Successfully. Check Out will be reviewed by the Administrator. We will notify you as soon as posibble. Thank you.\');
				window.location.href = "'.$_SERVER['HTTP_REFERER'].'"
			</script>';
		$last_id=mysqli_insert_id($con);
		$query = "DELETE FROM tblcart WHERE user_id='$user_id'";
		mysqli_query($con,$query);
		$notif = array('notif'=>'CHECK_OUT_VERIFY','id'=>$last_id);
		$json = json_encode($notif);
		$query = "INSERT INTO tblnotif (json_notif,user_id,read_notif) VALUES ('$json','$user_id','false')";
		mysqli_query($con,$query);
	}
	else {
		echo '<script type="text/javascript">
				alert(\'Failed to do Check Out due to an error.\');
				window.location.href = "'.$_SERVER['HTTP_REFERER'].'"
			</script>';
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