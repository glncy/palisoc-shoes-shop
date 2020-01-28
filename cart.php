<?php
$location = "Cart";
include('header.php');
if (isset($_SESSION['user_id'])) {
	include('connection.php');
	$user_id=$_SESSION['user_id'];
	$query="SELECT * FROM tblcart WHERE user_id='$user_id'";
	$get=mysqli_query($con,$query) or die(mysqli_error($con));
	$cart=mysqli_num_rows($get);
	$loop = 1;
	$query_3="SELECT * FROM tblusers WHERE id='$user_id'";
	$get_3=mysqli_query($con,$query_3);
	$row_3=mysqli_fetch_array($get_3);
	$city=$row_3['city'];
	$province=$row_3['province'];
	$query_4="SELECT * FROM tblshipping_rates WHERE province='$province' AND city='$city'";
	$get_4=mysqli_query($con,$query_4);
	$row_4=mysqli_fetch_array($get_4);
	$shipping=mysqli_num_rows($get_4);
?>
<div class="container" style="background-color: white; padding-top: 15px;">
	<div class="row">
		<div class="col-sm-12">
			<h2>Cart</h2>
		</div>
	</div>
	<hr/>
	<div class="row">
		<div class="col-sm-8">
			<?php
			while ($row=mysqli_fetch_array($get)){
				$product_id = $row['item_id'];
				$query_2 = "SELECT * FROM tblitems WHERE id='$product_id'";
				$get_2 = mysqli_query($con,$query_2);
				$row_2 = mysqli_fetch_array($get_2);
				$disc = (float) $row_2['discount']/100;
				$disc_price = (float) $row_2['price']*$disc;
				$total = (float) $row_2['price']-$disc_price;
				$format = number_format($total,2);

				$total_amount = (float) $total*$row['qty'];
				$format_2 = number_format($total_amount,2);

				$picture=$row_2['picture'];
				$pic=explode("/", $picture);
			?>
			<div id="target<?php echo $loop;?>">
				<div class="row">
					<div class="col-sm-3">
						<a href="product/<?php echo $product_id;?>"><img src="res/img/<?php echo $pic[0];?>" class="img-responsive"></a>
					</div>
					<div class="col-sm-6">
						<a href="product/<?php echo $product_id;?>"><span style="font-size: 25px;"><?php echo $row_2['name']?></span><br/></a>
						<span>₱<?php echo $format;?></span><br/><strike style="font-size: 15px;">₱<?php echo $row_2['price']?></strike><br/><span style="font-size: 15px;">Discount : <?php echo $row_2['discount']?>%</span>
					</div>
					<div class="col-sm-3">
						<div class="row">
							<div class="col-sm-12">
								<h5>Quantity : <?php echo $row['qty'];?></h5>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12">
								<h5>Total Price : ₱<div id="product_price<?php echo $loop;?>" style="display: inline-block;"><?php echo $format_2;?></div></h5>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12">
								<button type="button" class="btn btn-danger form-control" onclick="delete_cart(<?php echo $row['id'];?>,<?php echo $loop;?>);">Delete</button>	
							</div>
						</div>
					</div>
				</div>
				<hr/>
			</div>
			<?php
				$loop++;
			}
			?>
			<div class="row" id="amount_counterAndBtn">
				<div class="col-sm-9">
				</div>
				<div class="col-sm-3">
					<div class="row">
						<?php
						if ($shipping>0) {
							if ($row_4['rate']!="0.00") {
								echo '<div class="col-sm-12">
								<h5>Shipping Fee Amount: </h5>
								<span style="font-size: 25px;">₱<div id="shipping_fee_price" style="display: inline-block;">'.$row_4['rate'].'</div></span>
								</div>';
							}
							else {
								echo '<div class="col-sm-12">
								<span>Shipping Fee was requested for your location. Waiting for the response.</span>
								</div>';
							}
							
						}
						else {
							echo '<div class="col-sm-12">
							<span>Shipping Fee not Available, </span>
							<a href="cart#" onclick="request_shipping('.$user_id.');">Request for Shipping Fee for your location.</a>
						</div>';
						}
						?>
					</div>
					<?php
						if ($shipping>0) {
							if ($row_4['rate']!="0.00") {
					?>
					<div class="row">
						<div class="col-sm-12">
							<h5>Total Amount: </h5>
						</div>
						<div class="col-sm-12">
							<span style="font-size: 25px;">₱<div id="total_price" style="display: inline-block;"></div></span>
						</div>
					</div>
					<br/>
					<?php
							}
						}
					?>
					<div class="row">
						<div class="col-sm-12">
							<?php
							if ($shipping>0) {
								if ($row_4['rate']!="0.00") {
									echo '<button class="btn btn-warning pull-right form-control" style="height: 50px; background-image: none;" data-toggle="modal" data-target="#check_out_billing">Check Out</button>';
								}
								else {
									echo '<h6>Waiting for Shipping Fee to Check Out.</h6>';
								}
								
							}
							else {
								echo '<h6>Waiting for Shipping Fee to Check Out.</h6>';
							}
							?>
						</div>
					</div>
				</div>
			</div>
			<br/>
		</div>
	</div>
</div>
<script type="text/javascript">
	var product_total_price = 0;
	Number.prototype.formatMoney = function(c, d, t){
	var n = this, 
	    c = isNaN(c = Math.abs(c)) ? 2 : c, 
	    d = d == undefined ? "." : d, 
	    t = t == undefined ? "," : t, 
	    s = n < 0 ? "-" : "", 
	    i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))), 
	    j = (j = i.length) > 3 ? j % 3 : 0;
	   return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
	};

	calculate_price();

	function calculate_price(){
		product_total_price = 0;
		var cart_count = <?php echo $cart; ?>;
		var loop = 1;
		var price_id;
		while (loop<=cart_count)
		{
			price_id = document.getElementById('product_price'+loop);
			if (price_id!=null) {
				currency = price_id.innerHTML;
				product_total_price += parseFloat(Number(currency.replace(/[^0-9\.-]+/g,"")));
			}
			loop++;
		}
		if (product_total_price==0) {
			var amount_counterAndBtn = document.getElementById('amount_counterAndBtn');
			amount_counterAndBtn.innerHTML = "<center>There's No Product in Cart</center>";
		}
		<?php
		if ($shipping>0) {
			if ($row_4['rate']!="0.00") {
			echo "price_id = document.getElementById('shipping_fee_price');
		currency = price_id.innerHTML;
		product_total_price += parseFloat(Number(currency.replace(/[^0-9\.-]+/g,'')));";
			}
		}
		?>
		var total_price_target = document.getElementById('total_price');
		if (total_price_target!=null) {
			total_price_target.innerHTML = product_total_price.formatMoney(2,'.',',');
		}
	}
</script>
<?php
	mysqli_close($con);
	include('footer.php');
}
else {
	header("Location: /");
}
?>