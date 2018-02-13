<!--A Design by W3layouts 
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<!-- html -->
<html>
<!-- head -->
<head>
<title>Qwik-Pay Wallet</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" /><!-- bootstrap-CSS -->
<link rel="stylesheet" href="css/bootstrap-select.css"><!-- bootstrap-select-CSS -->
<link href="css/font-awesome.css" rel="stylesheet" type="text/css" media="all" /><!-- Fontawesome-CSS -->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script type='text/javascript' src='js/jquery-2.2.3.min.js'></script>
<!-- Custom Theme files -->
<!--theme-style-->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />	
<!--//theme-style-->
<!--meta data-->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Online Recharge Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, Sony Ericsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!--//meta data-->
<!-- online fonts -->
<link href="//fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;subset=latin-ext,vietnamese" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Oxygen:300,400,700&amp;subset=latin-ext" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="account/css/bootstrap.min.css" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="account/css/style.css" rel='stylesheet' type='text/css' />
<link href="account/css/style-responsive.css" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="account/css/font.css" type="text/css"/>
<link href="css/font-awesome.css" rel="stylesheet"> 
<link rel="stylesheet" href="account/css/morris.css" type="text/css"/>
<!-- calendar -->
<link rel="stylesheet" href="account/css/monthly.css">
<!-- //calendar -->
<!-- //font-awesome icons -->
<script src="account/js/jquery2.0.3.min.js"></script>
<script src="account/js/raphael-min.js"></script>
<script src="account/js/morris.js"></script>
<!-- /online fonts -->
       
</head>
<!-- //head -->
<!-- body -->
<body bgcolor="#FFFFFF">
<!--header-->
<header>

	<div class="container">
		<!--logo-->
			<div class="logo">
				<h1><a href="index.php">Qwik Pay</a></h1>
			</div>
		<!--//logo-->
		<?php
		include('config.php');
		session_start();
		if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
		{
			$user_id=$_SESSION['usr_id'];
			
			//echo $user_id;
			$stmt = $conn->prepare("SELECT `usr_amt` FROM `user_wallet` WHERE `usr_id`=?");
			   $stmt->bind_param("i", $user_id); 
      $stmt->execute();
	  $stmt->bind_result($usr_walletamt); 
	  $stmt->fetch();
	  $stmt->close();
	  
	  $stmt1 = $conn->prepare("SELECT count(`trn_id`) FROM `transaction_details` WHERE `trn_usr_id`=?");
			   $stmt1->bind_param("i", $user_id); 
      $stmt1->execute();
	  $stmt1->bind_result($total_trn); 
	  $stmt1->fetch();
	  $stmt1->close();
	  $stmt2 = $conn->prepare("SELECT count(`trn_id`) FROM `transaction_details` WHERE `trn_usr_id`=?");
			   $stmt2->bind_param("i", $user_id); 
      $stmt2->execute();
	  $stmt2->bind_result($total_trn); 
	  $stmt2->fetch();
	  $stmt2->close();
			echo" 
			<div class='w3layouts-login'>
<a href='logout.php'></i>Logout</a>	
</div>		
<div class='w3layouts-login'>
<a href='account.php'></i>MyAccount</a>	
</div>	
<div class='w3layouts-login'>
				<a><span style='color: #FFCA28'><i class='glyphicon glyphicon-eur'></i></span> <b>$usr_walletamt </b></a>
			</div>	
<div class='w3layouts-login'>
				<a><i class='glyphicon glyphicon-user'> </i>Welcome $_SESSION[usr_nme]</a>
			</div>
				<div class='clearfix'></div>";
		}
		else
		{
			echo"
		  <div class='w3layouts-login'>
				<a data-toggle='modal' data-target='#myModal' href='#'><i class='glyphicon glyphicon-user'> </i>Login/Register</a>
			</div>    
				<div class='clearfix'></div>";
		}
		?>
    <!--Login modal-->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" 
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            &times;</button>
                        <h4 class="modal-title" id="myModalLabel">
                            Qwik-Pay Wallet</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-8 extra-w3layouts" style="border-right: 1px dotted #C2C2C2;padding-right: 30px;">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="../index.html#Login" data-toggle="tab">Login</a></li>
                                    <li><a href="#Registration" data-toggle="tab">Register</a></li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active" id="Login">
                                        <form name="Loginform" action="logcheck.php" method="post">
                                        <div class="form-group">
                                            <label for="email" class="col-sm-2 control-label">
                                                Email</label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" name="usr_email" placeholder="Email" required="required" />
                                            </div>
                                        </div>
										<br>
										<br>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1" class="col-sm-2 control-label">
                                                Password</label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" name="usr_pwd" placeholder="password" required="required" />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-2">
                                            </div>
                                            <div class="col-sm-10">
											<br>
                                          <!--  <input type="submit"  value="Submit">    <input type="submit"  value="Submit" class="submit btn btn-primary btn-sm"> -->
										   <button type="submit" class="submit btn btn-primary btn-sm">Submit</button>
												
                                                <a href="javascript:;" class="agileits-forgot">Forgot your password?</a>
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane" id="Registration">
                                        <form  class="form-horizontal"  name="Regisform" action="register.php" method="post">
                                        <div class="form-group">
                                            <label for="email" class="col-sm-2 control-label">
                                                Name</label>
                                            <div class="col-sm-10">
                                                <div class="row">
                                                    <div class="col-md-3 col-sm-3 col-xs-3">
                                                        <select class="form-control" name="sel_opt">
                                                            <option value=1>Mr.</option>
                                                            <option value=2>Ms.</option>
                                                            <option value=3>Mrs.</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-9 col-sm-9 col-xs-9">
                                                        <input type="text" class="form-control" name="usr_nme" placeholder="Name" required="required" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="email" class="col-sm-2 control-label">
                                                Email</label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" name="usr_email" id="email" placeholder="Email" required="required" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="mobile" class="col-sm-2 control-label">
                                                Mobile</label>
                                            <div class="col-sm-10">
                                                <input type="number" class="form-control" id="mobile" name="usr_num" placeholder="Mobile" required="required" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="password" class="col-sm-2 control-label">
                                                Password</label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" id="password" name="usr_pwd" placeholder="Password" required="required" />
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label for="password" class="col-sm-2 control-label">
                                                Confirm Password</label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" id="password" name="usr_cpwd" placeholder="Password" required="required" />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-2">
                                            </div>
                                            <div class="col-sm-10">
											 <button type="submit" class="submit btn btn-primary btn-sm">Save & Continue</button>
                                                <button type="reset" class="submit btn btn-default btn-sm">
                                                    Cancel</button>
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                                <div id="OR" >
                                    OR</div>
                            </div>
                            <div class="col-md-4 extra-agileits">
                                <div class="row text-center sign-with">
                                    <div class="col-md-12">
                                        <h3 class="other-nw">
                                            Sign in with</h3>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="btn-group btn-group-justified">
                                            <a href="#" class="btn btn-primary">Facebook</a> <a href="#" class="btn btn-danger">
                                                Google +</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!--//Login modal-->
    </div>
</header>
<div class="agileits-inner-banner">
		
	</div>
	
	<div class="w3layouts-breadcrumbs text-center">
		<div class="container">
			<span class="agile-breadcrumbs"><a href="index.php"><i class="fa fa-home home_1"></i></a> / <span>My Acoount</span></span>
		</div>
	</div>
<!--//-->	
	<div class=" header-right">
		<div class="banner">
			<section id="main-content" bgcolor="#FFFFFF">
	<section class="wrapper">
		<!-- //market-->
		<div class="market-updates">
			<div class="col-md-3 market-update-gd">
				<div class="market-update-block clr-block-2">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-eye"> </i>
					</div>
					 <div class="col-md-8 market-update-left">
					 <h4>My Wallet</h4>
					<h3><i class="fa fa-euro"></i><?php echo $usr_walletamt;?></h3>
				  </div>
				  <div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-3 market-update-gd">
				<div class="market-update-block clr-block-1">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-users" ></i>
					</div>
					<div class="col-md-8 market-update-left">
					<h4>Transactions</h4>
						<h3><?php echo $total_trn;?></h3>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-3 market-update-gd">
				<div class="market-update-block clr-block-3">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-usd"></i>
					</div>
					<div class="col-md-8 market-update-left">
						<h4>Messages</h4>
						<h3>1,500</h3>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-3 market-update-gd">
				<div class="market-update-block clr-block-4">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-shopping-cart" aria-hidden="true"></i>
					</div>
					<div class="col-md-8 market-update-left">
						<h4>Orders</h4>
						<h3>1,500</h3>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
		   <div class="clearfix"> </div>
		</div>
	</div>
	</div>
	</section>
	</div>