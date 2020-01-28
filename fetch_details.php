<?php
if ((isset($_GET['id']))&&(isset($_GET['mode']))&&isset($_SERVER['HTTP_REFERER']))
{
	include('connection.php');

	$mode = rtrim(ltrim(mysqli_real_escape_string($con,$_GET['mode'])));

	if ($mode=="check_out_view") {
		$array = check_out_view();
		$out = json_encode($array);
		echo $out;
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

function check_out_view(){
	include('connection.php');

	$id = rtrim(ltrim(mysqli_real_escape_string($con,$_GET['id'])));
	$query = "SELECT * FROM tblcheckout WHERE id = '$id'";

	$get = mysqli_query($con,$query);
	$row = mysqli_fetch_array($get);

	$product_id = explode('#', $row['products_id']);
	array_pop($product_id);

	$qty = explode('#', $row['qtys']);
	array_pop($qty);

	$price = explode('#', $row['price']);
	array_pop($price);

	$shipping  = explode('#', $row['shipping_info']);
	$billing = explode('#',$row['billing_info']);

	$remarks = $row['remarks'];
	$total_amount = $row['total_amount'];
	$shipping_fee = $row['shipping_fee'];
	$status = $row['status'];
	$cnt_item = count($product_id);
	$product_name = [];
	$loop = 0;
	while ($loop < $cnt_item) {
		$ref=$product_id[$loop];
		$query="SELECT * FROM tblitems WHERE id='$ref'";
		$get=mysqli_query($con,$query);
		$row=mysqli_fetch_array($get);
		$product_name[$loop]=$row['name'];
		$loop++;
	}

	$json['product_name'] = $product_name;
	$json['product_id'] = $product_id;
	$json['qty'] = $qty;
	$json['price'] = $price;
	$json['ship_name'] = $shipping[0]." ".$shipping[1];
	$json['ship_email'] = $shipping[2];
	$json['ship_phone'] = $shipping[3];
	$json['ship_address'] = $shipping[4];
	$json['bill_mode'] = $billing[0];
	$json['bill_trans'] = $billing[1];
	$json['bill_total'] = "₱".number_format($billing[2],2);
	$json['bill_name'] = $billing[3]." ".$billing[4];
	$json['bill_email'] = $billing[5];
	$json['bill_phone'] = $billing[6];
	$json['bill_address'] = $billing[7];
	$json['item_count'] = $cnt_item;
	$json['status'] = $status;
	$json['shipping_fee'] = $shipping_fee;
	$json['total_amount'] = $total_amount;
	$json['remarks'] = $remarks;
	return $json;
}

?>

