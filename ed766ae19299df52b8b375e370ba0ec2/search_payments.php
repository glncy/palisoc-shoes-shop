<!DOCTYPE html>
<html>
<head>
	<title>Search Payment</title>
	<base href="http://localhost">
	<link rel="stylesheet" type="text/css" href="assets/bootstrap3/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/bootstrap3/css/bootstrap-theme.min.css">
	<script type="text/javascript" src="assets/jquery3.2.min.js"></script>
	<script type="text/javascript" src="assets/bootstrap3/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="assets/script.js"></script>
</head>
<body>
	<div class="container">
		<br/>
		<div class="row">
			<div class="col-sm-12">
				<select class="form-control" id="payment_mode">
					<option>Select Payment Method</option>
					<option>LBC Remittance</option>
					<option>Cebuana Lhuillier</option>
					<option>MLhuillier</option>
					<option>Palawan Express</option>
					<option>GCASH</option>
					<option>Paymaya</option>
				</select>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<input type="type" placeholder="Search Payment" class="form-control" id="search_payment" onkeyup="search('search_payment');">
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div class="table-responsive" id="result_search">
					
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		function search(target){

			var search=document.getElementById(target).value;
			var pay_mode=document.getElementById('payment_mode').value;

			$.ajax({
				type: 'post',
				url: '/admin/fetch_payment',
				data: {
					search:search,mode:pay_mode,
				},
				success: function(response){
					$('#result_search').html(response);
				}
			});
		}

		function claim_payment(id){
			var ans = confirm('Mark as Claim?');
			if (ans==true) {
				$.ajax({
					type: 'post',
					url: '/admin/mark_claim',
					data: {
						id:id,
					},
					success: function(response){
						$('#result_search').html(response);
					}
				});
			}
			else
			{
				alert('Cancelled.');
			}
		}
	</script>
</body>
</html>