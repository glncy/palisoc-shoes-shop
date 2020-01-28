<?php
include('connection.php');
$id =  $URL[1];
$query="SELECT * FROM tblitems WHERE id='$id'";
$get=mysqli_query($con,$query);
$num_row=mysqli_num_rows($get);
if ($num_row!=1) {
	require_once("error/404.php");
}
else {
	$row=mysqli_fetch_array($get);
	$location = $row['name'];
	include('header.php');
	$picture=explode("/", $row['picture']);
	$cnt = count($picture);
	$access_file = true;
	$qty_show=$row['qty'];
	include('product_details.php');
	include('footer.php');
}
?>