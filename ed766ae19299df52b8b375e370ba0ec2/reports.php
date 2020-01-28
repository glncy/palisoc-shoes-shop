<?php
$location = "Reports";
include('header.php');
?>

<div class="container" style="background-color: white; padding-top: 15px;">
	<h4>Reports</h4>
	<hr/>
	<div class="row">
		<div class="col-sm-12">
			<?php include('annually_chart.php');?>
		</div>
	</div>
</div>
<div id="monthly_chart" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Month</h4>
                </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12" id="monthly">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include('footer.php');
?>