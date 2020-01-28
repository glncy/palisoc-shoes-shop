<?php
$location = "Products";
include('header.php');
?>

<div class="container" style="background-color: white; padding-top: 15px;">
	<h4>Products</h4>
	<hr/>
	<div class="row" id="notif">
		<div class="col-sm-12">
			<?php
			if (isset($_SESSION['notif'])){
				if ($_SESSION['notif']=="SUCCESS") {
					echo '<h4 style="padding:10px; color: white; background-color: green;">Product Added Successfully.</h4>';
					unset($_SESSION['notif']);
				}
				elseif ($_SESSION['notif']=="SUCCESS_UPDATE") {
					echo '<h4 style="padding:10px; color: white; background-color: green;">Product Updated Successfully.</h4>';
					unset($_SESSION['notif']);
				}
				elseif ($_SESSION['notif']=="FAILEd_UPDATE") {
					echo '<h4 style="padding:10px; color: white; background-color: red;">Failed to Update Product.</h4>';
					unset($_SESSION['notif']);
				}
				else{
					echo '<h4 style="padding:10px; color: white; background-color: red;">Failed to Add Product.</h4>';
					unset($_SESSION['notif']);
				}
			}
			?>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="row">
						<div class="col-sm-6">
							<input type="text" class="form-control" placeholder="Search" id="product_search" onkeyup="product_search();">
						</div>
						<div class="col-sm-5">
						</div>
						<div class="col-sm-1">
							<input type="button" class="form-control btn btn-warning" value="Add" data-toggle="modal" data-target="#addProduct">
						</div>
					</div>
				</div>
				<div class="panel-body">
					<div class="col-sm-12">
						<div class="table-responsive" id="product_search_result">
							<table class="table">
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
								</thead>
								<?php
								include('connection.php');
								$query="SELECT * FROM tblitems ORDER BY id DESC";
								$get=mysqli_query($con,$query);
								while ($row=mysqli_fetch_array($get)) {
									echo '<tr>
										<td>'.$row['id'].'</td>
										<td>'.$row['name'].'</td>
										<td>'.$row['qty'].'</td>
										<td>'.$row['category'].'</td>
										<td>'.$row['size'].'</td>
										<td>₱'.$row['price'].'</td>
										<td><a href="admin/products#" onclick="view_content('.$row['id'].');" data-toggle="modal" data-target="#viewProduct"><span class="glyphicon glyphicon-eye-open"></span>&nbspView</a></td>
										<td><a href="admin/products#" data-toggle="modal" data-target="#editProduct" onclick="edit_product(\''.$row['id'].'\')"><span class="glyphicon glyphicon-pencil"></span>&nbspEdit</a></td>
										<td><a href="admin/products#" onclick="delete_product(\''.$row['id'].'\',\''.$row['name'].'\');"><span class="glyphicon glyphicon-trash"></span>&nbspDelete</a></td>
									</tr>';
								}
								?>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
include('footer.php');
?>