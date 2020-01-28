<?php
if (isset($access_file)) {
	if ($access_file!=true) {
		header("Location: /");
	}
}
else
{
	header("Location: /");
}
?>
<div class="container" style="background-color: white; padding-top: 15px;">
	<div class="row">
		<div class="col-sm-12">
			<h2><?php echo $row['name'];
			$add_to_cart=$row['name'];?></h2>
		</div>
	</div>
	<hr/>
	<div class="row" style="padding: 0; margin: 0;">
		<div class="col-sm-4">
			<div id="product_pic" class="carousel slide" data-ride="carousel">
			<!-- Indicators -->
				<ol class="carousel-indicators">
					<?php
					$loop = 0;
					if ($cnt!=1) {
						if ($picture[1]!="") {
							while ($loop<$cnt) {
								if ($picture[$loop]!=""){
									if ($loop==0) {
									?>
										<li data-target="#product_pic" data-slide-to="<?php echo $loop;?>" class="active"></li>
									<?php
									}
									else {
										?>
										<li data-target="#product_pic" data-slide-to="<?php echo $loop;?>"></li>
										<?php
									}
								}
								$loop++;
							}
						}
					}
					?>
	  			</ol>
	 			 <!-- Wrapper for slides -->
	 			 <div class="carousel-inner">
	 			 	<?php
					$loop = 0;
					while ($loop<$cnt) {
						if ($picture[$loop]!=""){
							if ($loop==0) {
							?>
								<div class="item active">
							    	<img src="res/img/<?php echo $picture[$loop];?>">
							    </div>
							<?php
							}
							else {
								?>
								<div class="item">
							    	<img src="res/img/<?php echo $picture[$loop];?>">
							    </div>
								<?php
							}
						}
						$loop++;
					}
					?>
	  			</div>
	  			<!-- Left and right controls -->
	  			<?php
	  			if ($cnt!=1) {
	  				if ($picture[1]!="") {
		  				echo '<a class="left carousel-control" href="#product_pic" data-slide="prev">
					    <span class="glyphicon glyphicon-chevron-left"></span>
					    <span class="sr-only">Previous</span>
		  			</a>
		  			<a class="right carousel-control" href="#product_pic" data-slide="next">
		    			<span class="glyphicon glyphicon-chevron-right"></span>
		    			<span class="sr-only">Next</span>
		  			</a>';
	  				}
	  			}
	  			?>
			</div>
		</div>
		<div class="col-sm-5">
			<div class="row">
				<div class="col-sm-12">
					<h4>Specification:</h4>
				</div>
				<div class="col-sm-12">
					<ul>
						<li>Size : <?php echo $row['size'];?></li>
						<li>For : <?php echo $row['category'];?></li>
					</ul>
				</div>
				<div class="col-sm-12">
					<hr/>
				</div>
				<div class="col-sm-4">
					<?php
					$disc=0;
					$disc_price=0;
					$total=0;
					$format=0;
					$disc = (float) $row['discount']/100;
					$disc_price = (float) $row['price']*$disc;
					$total = (float) $row['price']-$disc_price;
					$format = number_format($total,2);
					?>
					<span style="font-size: 25px;">₱<?php echo $format;?></span><br/>
					<span style="font-size: 12px;">Before&nbsp:&nbsp</span><strike style="font-size: 12px;">₱<?php echo $row['price'];?></strike>&nbsp<br/><span style="font-size: 12px;">You save : <?php echo $row['discount'];?>%</span>
				</div>
				<?php
				if ($row['qty']<=0)
				{
					echo '<div class="col-sm-8">
					<button class="btn btn-default" disabled style="padding: 20px; font-size: 20px; width: 100%;">Out of Stock</button>
				</div>';
					
				}
				elseif (isset($_SESSION['user_name'])) {
					echo '<div class="col-sm-8">
					<button class="btn btn-warning" style="padding: 20px; font-size: 20px; width: 100%; background-image: none; border: 0px;" data-toggle="modal" data-target="#add_to_cart" onclick="addtoform('.$id.');">Add to Cart</button>
				</div>';
				}
				else
				{
						echo '<div class="col-sm-8">
					<button class="btn btn-default" disabled style="padding: 20px; font-size: 20px; width: 100%;">Login to Use Cart</button>
				</div>';
				}
				?>
				
			</div>
		</div>
		<div class="col-sm-3">
			<div class="row">
				<div class="col-sm-12">
					<?php
					/*if ($row['qty']>0) {
						echo '<h4 style="color: orange;">In Stock</h4>';
					}
					else{
						echo '<h4 style="color: red;">Out of Stock</h4>';
					}*/
					?>
					<center><h4>Reviews</h4></center>
				</div>
			</div>
			<div class="row pre-scrollable" <?php
			if (isset($_SESSION['user_name'])) {
				echo 'style="max-height: 243px; height: 243px;"';
			}
			else
			{
				echo 'style="max-height: 310px; height: 310px;"';
			}
			?>>

			<?php
			$query="SELECT * FROM tblreviews WHERE product_id='$id' ORDER BY id DESC";
			$get=mysqli_query($con,$query);
			$num_rows=mysqli_num_rows($get);
			if ($num_rows>0) {
				while ($row=mysqli_fetch_array($get)) {
					$user_ref = $row['user_id'];
					$query_2 = "SELECT * FROM tblusers WHERE id='$user_ref'";
					$get_2 = mysqli_query($con,$query_2);
					$row_2 = mysqli_fetch_array($get_2);
				?>
					<div class="col-sm-12"><h5><?php echo $row_2['fname']." ".$row_2['lname'];?></h5></div>
					<div class="col-sm-12"><pre style="white-space: pre-wrap;"><?php echo $row['comment'];?></pre></div>
				<?php
				if ($row['user_id']==$_SESSION['user_id']) {
				?>
					<div class="col-sm-12">
						<a href="delete_review/<?php echo $row['id'];?>" class="pull-right">Delete</a>
					</div>
				<?php
				}
				?>
					<br/>
				<?php
				}	
			}
			else
			{
			?>
				<div class="col-sm-12"><center><h5>No Reviews Yet.</h5></center></div>
			<?php 
			}
			?>
			</div>
			<?php
			if (isset($_SESSION['user_name'])) {
				echo '<form action="add_review/'.$id.'" method="post">
				<div class="row">
					<input type="text" name="review" class="form-control" required="" placeholder="Add Review">
				</div>
				<div class="row">
					<input type="submit" name="comment" class="btn btn-warning form-control" style="background-image: none; border: 0px;" required value="Submit Review">
				</div>
			</form>';
			}
			?>
		</div>
	</div>
	<br/>
	<hr/>
	<!--<div class="row">
		<div class="col-sm-12">
			<h5>Recommended For You</h5>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-2">
			<a href="">
				<img src="res/test.jpg" class="img-responsive">
				<span style="font-size: 20px;">Nike</span><br/></a>
				
				<span>₱</span><br/>
				<strike style="font-size: 12px;">₱466.00</strike>&nbsp<span style="font-size: 12px;">-80%</span>
		</div>
		<div class="col-sm-2" >
			<a href="">
				<img src="res/test.jpg" class="img-responsive">
				<span style="font-size: 20px;">Nike</span><br/></a>
				<span>₱466.00</span><br/>
				<strike style="font-size: 12px;">₱466.00</strike>&nbsp<span style="font-size: 12px;">-80%</span>
		</div>
		<div class="col-sm-2" >
			<a href="">
				<img src="res/test.jpg" class="img-responsive">
				<span style="font-size: 20px;">Nike</span><br/></a>
				<span>₱466.00</span><br/>
				<strike style="font-size: 12px;">₱466.00</strike>&nbsp<span style="font-size: 12px;">-80%</span>
		</div>
	</div>-->
</div>