<?php
if (!isset($URL[1])) {
	if (isset($_SERVER['HTTP_REFERER']))
	{
		mysqli_close($con);
		header('Location: '.$_SERVER['HTTP_REFERER']);
	}
	else
	{
		mysqli_close($con);
		header('Location: /');
	}	
}
elseif ($URL[1]=="") {
	if (isset($_SERVER['HTTP_REFERER']))
	{
		mysqli_close($con);
		header('Location: '.$_SERVER['HTTP_REFERER']);
	}
	else
	{
		mysqli_close($con);
		header('Location: /');
	}
}
$location = 'Search for "'.$URL[1].'"';
include('header.php');
$search = $URL[1];
?>
<div class="container" style="background-color: white; padding-top: 15px;">
	<div class="row">
		<div class="col-sm-12">
			<h2>Search for "<?php echo $URL[1];?>"</h2>
		</div>
	</div>
	<hr/>
	<div class="row">
		<?php
		include('connection.php');
		$query="SELECT * FROM tblitems WHERE name LIKE '%$search%'ORDER BY sold DESC";
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