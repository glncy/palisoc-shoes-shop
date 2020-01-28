<?php
include('connection.php');
$id=rtrim(ltrim(mysqli_real_escape_string($con,$_POST['id'])));
$query="SELECT * FROM tblitems WHERE id='$id'";

$get=mysqli_query($con,$query) or die(mysqli_error($con));

if (mysqli_num_rows($get)>0) {
	$row = mysqli_fetch_array($get);
	echo '<div class="row">
	<div class="col-sm-4">
		<div class="row pre-scrollable">';
	$picture = explode("/", $row['picture']);
	$cnt = count($picture);
	$loop = 0;
	while ($loop<=$cnt-1) {
		if ($picture[$loop]!="") {
			echo '<div>
				<div class="col-sm-12" id="edit_old_preview'.($loop+1).'">
					<img src="res/img/'.$picture[$loop].'" class="img-responsive">
				</div>
			</div>';
		}
		$loop++;
	}
	echo '
		</div>
	</div>
	<div class="col-sm-8">
		<div class="row">
			<div class="col-sm-12">
				<h4>Product Details</h4>
			</div>
			<div class="col-sm-12">
				<div class="input-group">
    			<span class="input-group-addon">
		        	Product Name
		      	</span>
		    	<input type="text" class="form-control" placeholder="Product Name" required name="name" value="'.$row['name'].'" disabled>
		    </div>
		    <br/>
			</div>
			<div class="col-sm-6">
				<div class="input-group">
    			<span class="input-group-addon">
		        	Quantity
		      	</span>
		    	<input type="number" class="form-control" placeholder="Quantity" required name="qty" value="'.$row['qty'].'" disabled>
		    </div>
		    <br/>
			</div>
			<div class="col-sm-6">
				<div class="input-group">
    			<span class="input-group-addon">
		        	Category
		      	</span>
		    	<input type="text" class="form-control" placeholder="Size" required name="size" value="'.$row['category'].'" disabled>
		    </div>
		    <br/>
			</div>
			<div class="col-sm-6">
				<div class="input-group">
    			<span class="input-group-addon">
		        	Size
		      	</span>
		    	<input type="number" class="form-control" placeholder="Size" required name="size" value="'.$row['size'].'" disabled>
		    </div>
		    <br/>
			</div>
			<div class="col-sm-6">
				<div class="input-group">
    			<span class="input-group-addon">
		        	Price
		      	</span>
		    	<input type="number" class="form-control" value="'.$row['price'].'" disabled>
		    </div>
		    <br/>
			</div>
			<div class="col-sm-6">
				<div class="input-group">
    			<span class="input-group-addon">
		        	Discount
		      	</span>
		    	<input type="number" class="form-control" value="'.$row['discount'].'" disabled>
		    </div>
		    <br/>
			</div>
			<div class="col-sm-6">
				<div class="input-group">
    			<span class="input-group-addon">
		        	Discounted Price
		      	</span>';
		    $disc_price=$row['discount'];
		    $percent=(float)$disc_price/100;
		    $disc_price=(float)$row['price']*$percent;
		    $total_price=$row['price']-$disc_price;
		    echo'
		    	<input type="text" class="form-control" disabled="" value="'.$total_price.'">
		    </div>
		    <br/>
			</div>
		</div>
	</div>
</div>';
}
?>