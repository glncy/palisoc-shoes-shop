<?php
if ($URL[1]=='men') {
 	$location = "Men";
}
else if ($URL[1]=='women') {
	$location = "Women";
}
else if ($URL[1]=='kids'){
	$location = "Kids";
}
else {
	header("Location: /");
}

include('header.php');
?>
<div class="container" style="background-color: white; padding-top: 15px;">
	<div class="row">
		<div class="col-sm-12">
			<?php
				if ($location=="Men") {
					echo "<h3>Men Shoes</h3>";
				}
				else if ($location=="Women") {
					echo "<h3>Women Shoes</h3>";
				}
				else {
					echo "<h3>Kids Shoes</h3>";
				}
			?>
			
		</div>
	</div>
	<div class="row">
		<?php
		include('connection.php');
		if ($location=="Men") {
			$query="SELECT * FROM tblitems WHERE category='Men' ORDER BY id";
		}
		else if ($location=="Women") {
			$query="SELECT * FROM tblitems WHERE category='Women' ORDER BY id";
		}
		else {
			$query="SELECT * FROM tblitems WHERE category='Kids' ORDER BY id";
		}
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