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
		ob_start();
		if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
		{
			$user_id=$_SESSION['usr_id'];
			/*
			//echo $user_id;
			$stmt = $conn->prepare("SELECT `usr_amt` FROM `user_wallet` WHERE `usr_id`=?");
			   $stmt->bind_param('i', $user_id); 
      // Execute the prepared query.
      $stmt->execute();
      $stmt->store_result();
	  while($row=$stmt->fetch())
	  { 
     $usr_walletamt=$row['usr_amt'];
}*/


//$stmt->close();
//$conn->close();
//echo "wallet";
//echo $usr_walletamt;

$con = mysqli_connect('localhost', 'root', '','websec_recharge');
                $qcn1="SELECT `usr_amt` FROM `user_wallet` WHERE `usr_id`=$user_id"; 
				$result=mysqli_query($con,$qcn1);
                while($rescn1=mysqli_fetch_array($result))
                {
					$usr_walletamt=$rescn1[0];
				}
				/*$conn = mysqli_connect('localhost', 'root', '','websec_recharge');
				$stmt = $conn->prepare("SELECT `usr_amt` FROM `user_wallet` WHERE `usr_id`=?");
				$stmt->bind_param("s", $user_id); 
				$stmt->execute();
				$stmt->store_result();
				while($row=$stmt->fetch())
				{ 
				$usr_walletamt=$row[0];
				}*/
				$con->close();
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
			header('Refresh: 0; URL = index.php');
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
			<span class="agile-breadcrumbs"><a href="index.php"><i class="fa fa-home home_1"></i></a> / <a href="account.php"><span>Account</span></a>/ <span>Send Money</span></span>
		</div>
	</div>
<div class="categories-section main-grid-border" id="mobilew3layouts">
		<div class="container">
			<div class="category-list">
				<div id="parentVerticalTab">	
					<div class="agileits-tab_nav">
	<div>
							<i class="icon fa fa-euro inner-icon" aria-hidden="true"></i>
                    <div id="tab2" class="tab-grid">
		                      <div class="login-form">
							  <?php if(isset($_GET['msg']))
					{
						echo "<br>";
						echo "<span style='color:red'>";
						echo "Insufficient Balance ";
					}
					?>
						<form action="transferpay.php" method="get" id="signup">
						<ol>	
                            <li>
                                <div class="agileits-select">
                                <select name="wallet_number" required><option value="">Select Payee Wallet</option>
									<?php  
									///session_start();
									$user_id=$_SESSION['usr_id'];
									//$user_id=14;
									//echo $user_id;
			include('config.php');				 
            $stmt1 = $conn->prepare("SELECT `usr_id`,`usr_name` FROM `user_data`");
			/*if (!$stmt1->bind_param("i",$userid)) {
			echo "Binding parameters failed: (" . $stmt1->errno . ") " . $stmt1->error;
					}*/
			if (!$stmt1->execute()) {
				echo "Execute failed: (" . $stmt1->errno . ") " . $stmt1->error;
			}
			//$stmt->store_result();
			if (!$stmt1->store_result()) {
				echo "Execute failed: (" . $stmt1->errno . ") " . $stmt1->error;
			}			   	
     if ($stmt1->num_rows == 0) 
     {

     echo "Not registered kindly Register First";
         exit();             
     }
	 else
     {
	 $stmt1->bind_result($wlt_id,$wlt_nme);
	 $stmt1->store_result();
  while($row = $stmt1->fetch())
		  {	
	  //echo $user_id;
	  if($wlt_id<>$user_id)
	  {
?>

                                  <option value=<?php echo $wlt_id; ?>><?php echo $wlt_nme; ?></option>
								  <?php
	  }
		  }
	 }
	 $stmt1->close();
	 $conn->close();
	 ?>
                                </select>
                                </div>
                            </li>
                            <li>
                              <input type="text" id="customer" name="moneyvalue" placeholder="Enter amount in Euro" required>	
                            </li>
							<?php
							include('random.php');
							include('config.php');
							//session_start();
							$user_id=$_SESSION['usr_id'];
							//echo $user_id;
							$rndmnum = randomPassword(24,1,"lower_case,upper_case,numbers,special_symbols");
							$stmt2 = $conn->prepare("INSERT INTO `user_tokendetails`( `user_id`,`token_secret`,`token_date`) VALUES ( ?, ?, NOW())");
							if (!$stmt2->bind_param("is",$user_id,$rndmnum)) {
    echo "Binding parameters failed: (" . $stmt2->errno . ") " . $stmt2->error;
}
							if (!$stmt2->execute()) {
				echo "Execute failed: (" . $stmt2->errno . ") " . $stmt2->error;
			}
			//$stmt->store_result();
			if (!$stmt2->store_result()) {
				echo "Execute failed: (" . $stmt2->errno . ") " . $stmt2->error;
			}
							//$stmt2->bind_param("is",$userid,$rndmnum);
							//$stmt2->execute();
							$stmt2->close();
							$conn->close();
							echo "<input type='hidden' name='rndmnum' value=$rndmnum>";
							?>
                            
							<input type="hidden" name="rndvalue">
                            <li>
                              <button type="submit" class="submit btn btn-primary btn-sm">Submit</button>
                            </li>
				        </ol>
						
						</form>	
																							
						</div>	
						</div>
						</div>
						</div>
						</div>
						</div>
						</div>
						</div>
						<!--footer-->
<footer>
	<div class="container-fluid">
		<div class="w3-agile-footer-top-at">
			<div class="col-md-2 agileits-amet-sed">
				<h4>Company</h4>
				<ul class="w3ls-nav-bottom">
					<li><a href="#">About Us</a></li>
					<li><a href="#">Support</a></li>
					<li><a href="#">Sitemap</a></li>
					<li><a href="#">Terms & Conditions</a></li>
					<li><a href="#">Faq</a></li>	
					<li><a href="#">Mobile</a></li>	
					<li><a href="#">Feedback</a></li>	
					<li><a href="#">Contact</a></li>
					<li><a href="#">Shortcodes</a></li>
					<li><a href="#">Icons Page</a></li>
					
				</ul>	
			</div>
			<div class="col-md-3 agileits-amet-sed ">
				<h4>Mobile Recharges</h4>
					<ul class="w3ls-nav-bottom">
						<li><a href="#mobilew3layouts" class="scroll">Airtel</a></li>
						<li><a href="#mobilew3layouts" class="scroll">Aircel</a></li>
						<li><a href="#mobilew3layouts" class="scroll">Vodafone</a></li>
						<li><a href="#mobilew3layouts" class="scroll">BSNL</a></li>
						<li><a href="#mobilew3layouts" class="scroll">Tata Docomo</a></li>
						<li><a href="#mobilew3layouts" class="scroll">Reliance GSM</a></li>	
						<li><a href="#mobilew3layouts" class="scroll">Reliance CDMA</a></li>	
						<li><a href="#mobilew3layouts" class="scroll">Telenor</a></li>	
						<li><a href="#mobilew3layouts" class="scroll">MTS</a></li>	
						<li><a href="#mobilew3layouts" class="scroll">Jio</a></li>	
					</ul>	
			</div>
			<div class="col-md-3 agileits-amet-sed ">
				<h4>DATACARD RECHARGES</h4>
				   <ul class="w3ls-nav-bottom">
						<li><a href="#mobilew3layouts" class="scroll">Tata Photon</a></li>
						<li><a href="#mobilew3layouts" class="scroll">MTS MBlaze</a></li>
						<li><a href="#mobilew3layouts" class="scroll">MTS MBrowse</a></li>
						<li><a href="#mobilew3layouts" class="scroll">Airtel</a></li>
						<li><a href="#mobilew3layouts" class="scroll">Aircel</a></li>
						<li><a href="#mobilew3layouts" class="scroll">BSNL</a></li>	
						<li><a href="#mobilew3layouts" class="scroll">MTNL Delhi</a></li>	
						<li><a href="#mobilew3layouts" class="scroll">Vodafone</a></li>	
						<li><a href="#mobilew3layouts" class="scroll">Idea</a></li>	
						<li><a href="#mobilew3layouts" class="scroll">MTNL Mumbai</a></li>
						<li><a href="#mobilew3layouts" class="scroll">Tata Photon Whiz</a></li>	
					</ul>	
			</div>
			<div class="col-md-2 agileits-amet-sed">
				<h4>DTH Recharges</h4>
				<ul class="w3ls-nav-bottom">
						<li><a href="#mobilew3layouts" class="scroll"> Airtel Digital TV Recharges</a></li>
						<li><a href="#mobilew3layouts" class="scroll">Dish TV Recharges</a></li>
						<li><a href="#mobilew3layouts" class="scroll">Tata Sky Recharges</a></li>
						<li><a href="#mobilew3layouts" class="scroll">Reliance Digital TV Recharges</a></li>
						<li><a href="#mobilew3layouts" class="scroll">Sun Direct Recharges</a></li>
						<li><a href="#mobilew3layouts" class="scroll">Videocon D2H Recharges</a></li>	
					</ul>	
			</div>
            <div class="col-md-2 agileits-amet-sed ">
				<h4>Payment Options</h4>
				   <ul class="w3ls-nav-bottom">
						<li>Credit Cards</li>
						<li>Debit Cards</li>
						<li>Any Visa Debit Card (VBV)</li>
						<li>Direct Bank Debits</li>
						<li>Cash Cards</li>	
					</ul>	
			</div>
		<div class="clearfix"> </div>
		</div>
    </div>
	<div class="w3l-footer-bottom">
		<div class="container-fluid">
			<div class="col-md-4 w3-footer-logo">
				<h2><a href="index.html">Qwik-Pay Wallet</a></h2>
			</div>
			<div class="col-md-8 agileits-footer-class">
				<p >© 2017 Online Recharge. All Rights Reserved | Design by  <a href="http://w3layouts.com/" target="_blank">W3layouts</a> </p>
			</div>
		<div class="clearfix"> </div>
	 	</div>
	</div>
</footer>
<!--//footer-->
		  </html>
<!-- //Trains-list -->
