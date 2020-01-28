	<div id="addProduct" class="modal fade" role="dialog">
		<div class="modal-dialog modal-lg">
	    	<div class="modal-content">
	    		<div class="modal-header">
	       			<button type="button" class="close" data-dismiss="modal">&times;</button>
	        		<h4 class="modal-title">Add Product</h4>
	      		</div>
	      		<form action="admin/add_product_process" method="POST" id="addProductForm" enctype="multipart/form-data">
		      		<div class="modal-body">
		      			<div class="row">
			      			<div class="col-sm-4">
			      				<div class="row">
			      					<center>Picture/s</center>
			      				</div>
			      				<div class="row pre-scrollable">
			      					<div id="previewPictureAppend">
				      					<div class="col-sm-12">
				      						<img src="" class="img-responsive" id="imgPreview1">
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
									    	<input type="file" class="form-control" id="photo1" onchange="PreviewImage(1)" name="picture1">
									    </div>
									    <br/>
			      					</div>
			      					<div id="pictureAppend">
			      					</div>
			      					<div class="col-sm-12">
			      						<input type="button" class="btn btn-default btn-login pull-right" value="Add Picture" onclick="append();">
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
									    	<input type="text" class="form-control" placeholder="Product Name" required name="name">
									    </div>
									    <br/>
			      					</div>
			      					<div class="col-sm-6">
					      				<div class="input-group">
						        			<span class="input-group-addon">
									        	Quantity
									      	</span>
									    	<input type="number" class="form-control" placeholder="Quantity" required name="qty">
									    </div>
									    <br/>
			      					</div>
			      					<div class="col-sm-6">
					      				<div class="input-group">
						        			<span class="input-group-addon">
									        	Category
									      	</span>
									    	<select class="form-control" name="category">
									    		<option>Men</option>
									    		<option>Women</option>
									    		<option>Kids</option>
									    	</select>
									    </div>
									    <br/>
			      					</div>
			      					<div class="col-sm-6">
					      				<div class="input-group">
						        			<span class="input-group-addon">
									        	Size
									      	</span>
									    	<input type="number" class="form-control" placeholder="Size" required name="size">
									    </div>
									    <br/>
			      					</div>
			      					<div class="col-sm-6">
					      				<div class="input-group">
						        			<span class="input-group-addon">
									        	Price
									      	</span>
									    	<input type="number" class="form-control" placeholder="Price" required name="price" id="price">
									    </div>
									    <br/>
			      					</div>
			      					<div class="col-sm-6">
					      				<div class="input-group">
						        			<span class="input-group-addon">
									        	Discount
									      	</span>
									    	<select class="form-control" name="discount" onchange="discount_price_process();" id="discount" required="">
									    		<?php
									    			$loop=0;
									    			while ($loop<=100) {
									    				echo "<option value='".$loop."'>".$loop."%</option>";
									    				$loop++;
									    			}
									    		?>
									    	</select>
									    </div>
									    <br/>
			      					</div>
			      					<div class="col-sm-6">
					      				<div class="input-group">
						        			<span class="input-group-addon">
									        	Discounted Price
									      	</span>
									    	<input type="text" class="form-control" placeholder="" id="discount_price" disabled="">
									    </div>
									    <br/>
			      					</div>
			      				</div>
			      			</div>
		      			</div>
		      		</div>
		      		<div class="modal-footer">
		        		<input type="submit" class="btn btn-success" value="Add">
		      		</div>
	      		</form>
	    	</div>
		</div>
	</div>
	<div id="editProduct" class="modal fade" role="dialog">
		<div class="modal-dialog modal-lg">
	    	<div class="modal-content">
	    		<div class="modal-header">
	       			<button type="button" class="close" data-dismiss="modal">&times;</button>
	        		<h4 class="modal-title">Edit Product</h4>
	      		</div>
	      		<form action="admin/edit_product_process/" method="POST" id="editProductForm" enctype="multipart/form-data">
	      			<div class="modal-body" id="edit_content">
		      		</div>
	      		<div class="modal-footer">
	      			<input type="submit" class="btn btn-success btn-login" value="Save" id="edit_btn">
	      		</div>
	      		</form>
	      	</div>
	    </div>
	</div>
	<div id="viewProduct" class="modal fade" role="dialog">
		<div class="modal-dialog modal-lg">
	    	<div class="modal-content">
	    		<div class="modal-header">
	       			<button type="button" class="close" data-dismiss="modal">&times;</button>
	        		<h4 class="modal-title">View Product</h4>
	      		</div>
      			<div class="modal-body" id="view_content">
	      		</div>
	      	</div>
	    </div>
	</div>
	<div id="ShippingFee" class="modal fade" role="dialog">
		<div class="modal-dialog modal-sm">
	    	<div class="modal-content">
	    		<div class="modal-header">
	       			<button type="button" class="close" data-dismiss="modal">&times;</button>
	        		<h4 class="modal-title" id="shipping_fee_title"></h4>
	      		</div>
	      		<form action="admin/shipping_fee/" method="POST" id="shippingLink" enctype="multipart/form-data">
	      			<div class="modal-body">
      					<label>Shipping Rate: </label>
      					<input type="number" name="shipping_fee" class="form-control" id="shipping_fee">
		      		</div>
		      		<div class="modal-footer">
		      			<input type="submit" class="btn btn-success btn-login" value="Save">
		      		</div>
	      		</form>
	      	</div>
	    </div>
	</div>
</body>
</html>