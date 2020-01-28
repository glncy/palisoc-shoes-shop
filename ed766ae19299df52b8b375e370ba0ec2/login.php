<?php
if ((isset($_POST['user_name']))&&(isset($_POST['pw']))) {
  include(base().'connection.php');
  $salt_key="ARCHER";
  $user_name=$_POST['user_name'];
  $pw=md5($salt_key.$_POST['pw']);

  $query="SELECT * FROM tblusers WHERE email='$user_name' AND password='$pw' AND role='admin'";
  $get=mysqli_query($con,$query);
  $num_rows=mysqli_num_rows($get);

  if ($num_rows==1) {
    mysqli_close($con);
    $_SESSION['admin_session']=$user_name;
    header("Location: /admin");
  }
  else{
    mysqli_close($con);
    header("Location: /admin");
    $_SESSION['error']='';
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login | Palisoc Footwear</title>
  <base href="http://localhost">
  <link rel="stylesheet" type="text/css" href="assets/bootstrap3/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="assets/bootstrap3/css/bootstrap-theme.min.css">
  <script type="text/javascript" src="assets/jquery3.2.min.js"></script>
  <script type="text/javascript" src="assets/bootstrap3/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="assets/get_js.php"></script>
  <style type="text/css">
    .nav>li>a:focus, .nav>li>a:hover {
      background-color: #ffffff;
      color: white;
    }
    .active>a
    {
      color: white;
    }
    .form-control
    {
      border-radius: 0px;
    }
    .btn
    {
      border-radius: 0px;
      background-image: none;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-sm-3"></div>
      <div class="col-sm-6" style="padding: 20px;margin-top: 5%;">
        <!--<ul class="nav nav-pills nav-justified" style="padding: 15px; background: rgba(140, 140, 140,0.5); border-radius: 20px;">
          <li class="active"><a data-toggle="pill" href="#login" style="color: black;">Login</a></li>
          <li><a data-toggle="pill" href="#about" style="color: black;">About</a></li>
        </ul>
        <br/>-->
        <div class="tab-content" style="padding: 30px; background: rgba(0, 0, 0,0.8); border-radius: 0px; box-shadow: 25px 25px 25px rgba(0,0,0,0.5);">
          <div id="login" class="tab-pane fade in active">
            <div class="row" id="pwd-container">
              <div class="col-md-12">
                <section class="login-form">
                  <form method="POST" action="" role="login"> 
                    <center><h2 style="color: white;">Palisoc Footwear</h2></center>
                    <center><h3 style="color: white;">Admin Portal</h3></center>
                    <?php 
                    if (isset($_SESSION['error'])) {
                      echo '<h6 style="background-color: red; color: white; padding: 10px;">'.$_SESSION['error'].'</h6>';
                      unset($_SESSION['error']);
                    }
                    ?>
                    <label style="color: white;">Username</label>
                    <input type="text" name="user_name" placeholder="Username" required class="form-control input-lg" value="" />
                    <label style="color: white;">Password</label>
                    <input type="password" class="form-control input-lg" name="pw" placeholder="Password" required="" />
                    <hr/>
                    <button type="submit" name="go" class="btn btn-lg btn-success btn-block">Sign in</button>
                  </form>
                </section>  
              </div>
            </div>
          </div>
          <div id="about" class="tab-pane fade">
            <div class="row" id="pwd-container">
              <div class="col-md-4"></div>
              <div class="col-md-12">
                <section class="login-form">
                  <form method="POST" action="" role="login"> 
                    <!--<center><h1></h1></center>-->
                  </form>
                </section>  
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-3"></div>
    </div>
  </div>
</body>
</html>