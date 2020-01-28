<?php
$location = "Reports";
include('header.php');
?>

<div class="container" style="background-color: white; padding-top: 15px;">
	<h4>Administrator Settings</h4>
	<hr/>
    <div class="row">
        <form action="admin/change_admin_username" method="POST">
            <div class="col-sm-12">
                <h4>Change Username</h4>
            </div>
            <div class="col-sm-4">
                <label>Current Username: </label>
                <input type="text" name="oldpw" class="form-control" required="">
            </div>
            <div class="col-sm-4">
                <label>New Username: </label>
                <input type="text" name="newpw" class="form-control" required="">
            </div>
            <div class="col-sm-4">
                <label>Retype Username: </label>
                <input type="text" name="cpw" class="form-control" required="">
            </div>
            <div class="col-sm-12">
                <br/>
            </div>
            <div class="col-sm-12">
                <input type="submit" class="btn btn-success pull-right">
            </div>
        </form>
    </div>
    <hr/>
	<div class="row">
        <form action="admin/change_admin_pw" method="POST">
    		<div class="col-sm-12">
                <h4>Change Password</h4>
    		</div>
            <div class="col-sm-4">
                <label>Current Password: </label>
                <input type="password" name="oldpw" class="form-control" required="">
            </div>
            <div class="col-sm-4">
                <label>New Password: </label>
                <input type="password" name="newpw" class="form-control" required="">
            </div>
            <div class="col-sm-4">
                <label>Retype Password: </label>
                <input type="password" name="cpw" class="form-control" required="">
            </div>
            <div class="col-sm-12">
                <br/>
            </div>
            <div class="col-sm-12">
                <input type="submit" class="btn btn-success pull-right">
            </div>
        </form>
	</div>
    <br/>
</div>
<?php
include('footer.php');
?>