<?php
include('connection.php');
$id=rtrim(ltrim(mysqli_real_escape_string($con,$_POST['id'])));
$query="SELECT * FROM tblitems WHERE id='$id'";

$get=mysqli_query($con,$query) or die(mysqli_error($con));

if (mysqli_num_rows($get)>0) {
	$row = mysqli_fetch_array($get);
	echo '<div class="row">
	<div class="col-sm-4">
		<div class="row pre-scrollable">
			<!-- STORED IN DB -->
			<div id="banner_stored_in_db"><center>Stored Picture/s</center></div>';
	$picture = explode("/", $row['picture']);
	$cnt = count($picture);
	$loop = 0;
	while ($loop<=$cnt-1) {
		if ($picture[$loop]!="") {
			echo '<div>
				<div class="col-sm-12" id="edit_old_preview'.($loop+1).'">
					<img src="res/img/'.$picture[$loop].'" class="img-responsive">
					<center><button type="button" 
					onclick="delete_picture('.($loop+1).','.$cnt.');">Delete</button></center>
					<hr/>
				</div>
			</div>';
		}
		$loop++;
	}
	echo '<!-- FOR NEW PIC -->
			<center>New Picture/s</center>
			<div id="edit_previewPictureAppend">
				<div class="col-sm-12" id="edit_new_preview1">
					<img src="" class="img-responsive" id="edit_imgPreview1">
					<hr/>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-8">
		<div class="row">
			<div class="col-sm-12">
				<h4>Product Pictures</h4>
				<h6>(2x2)</h6>
			</div>
			<div class="col-sm-12">
				<div class="input-group">
    			<span class="input-group-addon">
		        	#
		      	</span>
		    	<input type="file" class="form-control" id="edit_picture1" onchange="edit_PreviewImage(1)" name="picture1">
		    </div>
		    <br/>
			</div>
			<div id="edit_pictureAppend">
			</div>
			<div class="col-sm-12">
				<input type="button" class="btn btn-default btn-login pull-right" value="Add Picture" onclick="edit_append();">
			</div>
			<div class="col-sm-12">
				<hr/>
			</div>
			<div class="col-sm-12">
				<h4>Product Details</h4>
			</div>
			<div class="col-sm-12">
				<div class="input-group">
    			<span class="input-group-addon">
		        	Product Name
		      	</span>
		    	<input type="text" class="form-control" placeholder="Product Name" required name="name" value="'.$row['name'].'">
		    </div>
		    <br/>
			</div>
			<div class="col-sm-6">
				<div class="input-group">
    			<span class="input-group-addon">
		        	Quantity
		      	</span>
		    	<input type="number" class="form-control" placeholder="Quantity" required name="qty" value="'.$row['qty'].'">
		    </div>
		    <br/>
			</div>
			<div class="col-sm-6">
				<div class="input-group">
    			<span class="input-group-addon">
		        	Category
		      	</span>
		    	<select class="form-control" name="category">';
		    if ($row['category']=="Men") {
		    	echo '<option selected>Men</option>
		    		<option>Women</option>
		    		<option>Kids</option>';
		    }
		    elseif ($row['category']=="Women") {
		    	echo '<option>Men</option>
		    		<option selected>Women</option>
		    		<option>Kids</option>';
		    }
		    elseif ($row['category']=="Kids") {
		    	echo '<option>Men</option>
		    		<option>Women</option>
		    		<option selected>Kids</option>';
		    }
		    else
		    {
		    	echo '<option>Men</option>
		    		<option>Women</option>
		    		<option selected>Kids</option>';
		    }
		    echo '
		    	</select>
		    </div>
		    <br/>
			</div>
			<div class="col-sm-6">
				<div class="input-group">
    			<span class="input-group-addon">
		        	Size
		      	</span>
		    	<input type="number" class="form-control" placeholder="Size" required name="size" value="'.$row['size'].'">
		    </div>
		    <br/>
			</div>
			<div class="col-sm-6">
				<div class="input-group">
    			<span class="input-group-addon">
		        	Price
		      	</span>
		    	<input type="number" class="form-control" placeholder="Price" onkeyup="edit_discount_price_process();" required name="price" id="edit_price" value="'.$row['price'].'">
		    </div>
		    <br/>
			</div>
			<div class="col-sm-6">
				<div class="input-group">
    			<span class="input-group-addon">
		        	Discount
		      	</span>
		    	<select class="form-control" name="discount" onchange="edit_discount_price_process();" id="edit_discount" required="">';
			$loop=0;
			while ($loop<=100) {
				if ($loop==$row['discount']) {
					echo "<option value='".$loop."' selected>".$loop."%</option>";
				}
				else{
					echo "<option value='".$loop."'>".$loop."%</option>";
				}
				$loop++;
			}
		    echo '</select>
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
		    	<input type="text" class="form-control" placeholder="" id="edit_discount_price" disabled="" value="'.$total_price.'">
		    </div>
		    <br/>
			</div>
		</div>
	</div>
</div>';
}
?>