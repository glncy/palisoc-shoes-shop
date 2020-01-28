<?php
if (isset($_POST['search'])) {
	include('connection.php');
	$search=rtrim(ltrim(mysqli_real_escape_string($con,$_POST['search'])));
	$query="SELECT * FROM tblitems WHERE id LIKE '%$search%' OR name LIKE '%$search%' OR category LIKE '%$search%' OR size LIKE '%$search%' OR price LIKE '%$search%' ORDER BY id DESC";
	$get=mysqli_query($con,$query);
	$output='<table class="table">
				<thead>
					<tr>
						<th>Product ID</th>
						<th>Name</th>
						<th>Qty</th>
						<th>Category</th>
						<th>Size</th>
						<th>Price</th>
						<th colspan="2">Action</th>
					</tr>
				</thead>';
	$num_rows=mysqli_num_rows($get);
	if ($num_rows>0) {
		while ($row=mysqli_fetch_array($get)) {
		$output.='<tr>
			<td>'.$row['id'].'</td>
			<td>'.$row['name'].'</td>
			<td>'.$row['qty'].'</td>
			<td>'.$row['category'].'</td>
			<td>'.$row['size'].'</td>
			<td>₱'.$row['price'].'</td>
			<td><a href="admin/products#"><span class="glyphicon glyphicon-eye-open"></span>&nbspView</a></td>
			<td><a href="admin/products#" data-toggle="modal" data-target="#editProduct" onclick="edit_product(\''.$row['id'].'\')"><span class="glyphicon glyphicon-pencil"></span>&nbspEdit</a></td>
			<td><a href="admin/products#" onclick="delete_product(\''.$row['id'].'\',\''.$row['name'].'\');"><span class="glyphicon glyphicon-trash"></span>&nbspDelete</a></td>
		</tr>';
		}
		$output.="</table>";
		mysqli_close($con);
		echo $output;
	}
	else {
		mysqli_close($con);
		echo '<table class="table"><thead><tr><th><center>Data Not Found</center></th></tr></thead></table>';
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
		header('Location: /admin');
	}
}

?>