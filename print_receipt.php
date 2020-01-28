<?php
$id = $_GET['id'];
include("connection.php");
$total = 0;
$query = "SELECT * FROM tblcheckout WHERE id='$id'";
$get = mysqli_query($con,$query);
$output = '<thead><tr><th>Details</th><th>Qty</th><th>Amount</th></tr></thead>';
$row=mysqli_fetch_array($get);
$product_id = explode("#",$row['products_id']);
array_pop($product_id);
$qty = explode("#",$row['qtys']);
array_pop($qty);
$price = explode('#', $row['price']);
array_pop($price);
$count = count($product_id);
$loop=0;
$cart=0;
while ($loop<$count) {
	$pid = $product_id[$loop];
	$qty_loop = $qty[$loop];
	$cart += (int)$qty_loop;
	$price_loop = $price[$loop];
	$query_2 = "SELECT * FROM tblitems WHERE id='$pid'";
	$get_2 = mysqli_query($con,$query_2);
	$row_2 = mysqli_fetch_array($get_2);
	$num_form=number_format($price_loop,2);
	$output.= "<tr><td>".$row_2['name']."</td><td>".$qty_loop."</td><td>&#8369;".$num_form."</td></tr>";
	$loop++;
}

$output_2 = '<thead><tr><th>No. of Items In Cart</th><th>'.$cart.'</th></tr></thead>';
$output_2 .= "<tr><td>Shipping Fee:</td><td>&#8369;".number_format($row['shipping_fee'],2)."</td></tr>";
$output_2 .= "<tr><td>Total Amount: </td><td>&#8369;".number_format($row['total_amount'],2)."</td></tr>";
mysqli_close($con);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Receipt</title>
	
</head>
<body id="print">
	<table width="40%">
		<tr>
			<td style="font-family: Arial; font-weight: bold;"><center>PALISOC FOOT WEAR</center></td>
		</tr>
		<tr>
			<td><center>PUBLIC MARKET, URBIZTONDO, PANGASINAN</center></td>
		</tr>
		<tr>
			<td><center>ELIZABETH R. PALISOC - Prop.</center></td>
		</tr>
		<tr>
			<td><center>Non VATE Reg. TIN: 466-986-822-000</center></td>
		</tr>
		<tr>
			<td><hr/></td>
		</tr>
	</table>
	<table cellspacing="0" cellpadding="0" width="40%">
		<tr>
			<td>Sold to: <?php $name = explode("#",$row['shipping_info']);
				echo $name[0]." ".$name[1];?></td>
			<td>Invoice # : <?php echo $row['id'];?></td>
		</tr>
		<tr>
			<td colspan="2"><hr/></td>
		</tr>
	</table>
	
	<table cellspacing="0" cellpadding="0" width="40%" border="1px">
		<?php echo $output;?>
	</table>
	<table cellspacing="0" cellpadding="0" width="40%">
		<tr>
			<td><hr/></td>
		</tr>
	</table>
	<table cellspacing="0" cellpadding="0" width="40%" border="1px">
		<?php echo $output_2;?>
	</table>
	<table cellspacing="0" cellpadding="0" width="40%">
		<tr>
			<td><hr/></td>
		</tr>
	</table>
	<table cellspacing="0" cellpadding="0" width="40%">
		<tr>
			<td><center>THIS IS YOUR OFFICIAL RECEIPT</center></td>
		</tr>
	</table>
	<script>
		alert('Click OK to Print the Receipt')
		var mywindow = window.open('', 'PRINT', 'height=400,width=600');
	    //mywindow.document.write('<html><head><title>Joves Pharmacy</title>');
	    //mywindow.document.write('</head><style>*{font-design:none; font-size:10px; font-family: Arial;} table{width:100%;} th {text-align:left;}</style><body>');
	    mywindow.document.write(document.getElementById('print').innerHTML);
	    //mywindow.document.write('</body></html>');

	    mywindow.document.close(); // necessary for IE >= 10
	    mywindow.focus(); // necessary for IE >= 10

	    setTimeout(function() {
			    mywindow.print();
			    mywindow.close();
			}, 20);

	    //window.location = "<?php echo $_SERVER['HTTP_REFERER']?>";
	</script>
</body>
</html>