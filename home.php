<?php
$location = 'Home';
include('header.php');

include('connection.php');
$query = "SELECT * FROM tbllist WHERE type='header_image' ORDER BY id DESC";
$get = mysqli_query($con,$query);
$cnt=0;
while ($row = mysqli_fetch_assoc($get)) {
	$picture[$cnt] = $row['picture'];
	$cnt++;
}
?>
<div class="container" style="background-color: white; padding-top: 15px;">
	<?php
	if ($picture[0]="") {
	?>
	<div class="row collapse navbar-collapse" style="padding: 0; margin: 0;">
		<div id="header_pic" class="carousel slide" data-ride="carousel">
		<!-- Indicators -->
			<ol class="carousel-indicators">
				<?php
				$loop = 0;
				if ($cnt!=1) {
					while ($loop<$cnt) {
						if ($picture[$loop]!=""){
							if ($loop==0) {
							?>
								<li data-target="#header_pic" data-slide-to="<?php echo $loop;?>" class="active"></li>
							<?php
							}
							else {
								?>
								<li data-target="#header_pic" data-slide-to="<?php echo $loop;?>"></li>
								<?php
							}
						}
						$loop++;
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
	  				echo '<a class="left carousel-control" href="#header_pic" data-slide="prev">
				    <span class="glyphicon glyphicon-chevron-left"></span>
				    <span class="sr-only">Previous</span>
	  			</a>
	  			<a class="right carousel-control" href="#header_pic" data-slide="next">
	    			<span class="glyphicon glyphicon-chevron-right"></span>
	    			<span class="sr-only">Next</span>
	  			</a>';
  			}
  			?>
		</div>
	</div>
	<?php
	}
	?>
	<div class="row">
		<div class="col-sm-12">
			<h3>Top Shoes</h3>
		</div>
	</div>
	<div class="row">
		<?php
		include('connection.php');
		$query="SELECT * FROM tblitems ORDER BY sold DESC LIMIT 12";
		$get=mysqli_query($con,$query);
		while ($row=mysqli_fetch_array($get)) {
			$picture=$row['picture'];
			$pic=explode("/", $picture);
			echo '<div class="col-sm-2">
					<a href="product/'.$row['id'].'">
					<img src="res/img/'.$pic[0].'" class="img-responsive">
					<span style="font-size: 18px;">'.$row['name'].'</span><br/></a>
					<span>₱';
			$disc = (float) $row['discount']/100;
			$disc_price = (float) $row['price']*$disc;
			$total = (float) $row['price']-$disc_price;
			$format = number_format($total,2);
			echo $format.'</span><br/>
					<strike style="font-size: 12px;">₱'.$row['price'].'</strike>&nbsp<span style="font-size: 12px;">-'.$row['discount'].'%</span><br/><span style="font-size: 12px;">Size: '.$row['size'].'</span>
			</div>';
		}
		?>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<h3>New Shoes</h3>
		</div>
	</div>
	<div class="row">
		<?php
		include('connection.php');
		$query="SELECT * FROM tblitems ORDER BY id DESC LIMIT 12";
		$get=mysqli_query($con,$query);
		while ($row=mysqli_fetch_array($get)) {
			$picture=$row['picture'];
			$pic=explode("/", $picture);
			echo '<div class="col-sm-2">
					<a href="product/'.$row['id'].'">
					<img src="res/img/'.$pic[0].'" class="img-responsive">
					<span style="font-size: 18px;">'.$row['name'].'</span><br/></a>
					<span>₱';
			$disc = (float) $row['discount']/100;
			$disc_price = (float) $row['price']*$disc;
			$total = (float) $row['price']-$disc_price;
			$format = number_format($total,2);
			echo $format.'</span><br/>
					<strike style="font-size: 12px;">₱'.$row['price'].'</strike>&nbsp<span style="font-size: 12px;">-'.$row['discount'].'%</span><br/><span style="font-size: 12px;">Size: '.$row['size'].'</span>
			</div>';
		}
		?>
	</div>
</div>
<?php
include('footer.php');
?>