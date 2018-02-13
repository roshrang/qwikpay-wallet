<!--A Design by W3layouts 
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<?php
session_start();
ob_start();
?>
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
   <script type="text/javascript">

  document.addEventListener("DOMContentLoaded", function() {

    // JavaScript form validation

    var checkPassword = function(str)
    {
      var re = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}$/;
      return re.test(str);
    };

    var checkForm = function(e)
    {
      if(this.username.value == "") {
        alert("Error: Username cannot be blank!");
        this.username.focus();
        e.preventDefault(); // equivalent to return false
        return;
      }
      re = /^\w+$/;
      if(!re.test(this.username.value)) {
        alert("Error: Username must contain only letters, numbers and underscores!");
        this.username.focus();
        e.preventDefault();
        return;
      }
      if(this.pwd1.value != "" && this.pwd1.value == this.pwd2.value) {
        if(!checkPassword(this.pwd1.value)) {
          alert("The password you have entered is not valid!");
          this.pwd1.focus();
          e.preventDefault();
          return;
        }
      } else {
        alert("Error: Please check that you've entered and confirmed your password!");
        this.pwd1.focus();
        e.preventDefault();
        return;
      }
      //alert("Both username and password are VALID!");
    };

    var myForm = document.getElementById("myForm");
    myForm.addEventListener("submit", checkForm, true);

    // HTML5 form validation

    var supports_input_validity = function()
    {
      var i = document.createElement("input");
      return "setCustomValidity" in i;
    }

    if(supports_input_validity()) {
      var usernameInput = document.getElementById("field_username");
      usernameInput.setCustomValidity(usernameInput.title);

      var pwd1Input = document.getElementById("field_pwd1");
      pwd1Input.setCustomValidity(pwd1Input.title);

      var pwd2Input = document.getElementById("field_pwd2");

      // input key handlers

      usernameInput.addEventListener("keyup", function(e) {
        usernameInput.setCustomValidity(this.validity.patternMismatch ? usernameInput.title : "");
      }, false);

      pwd1Input.addEventListener("keyup", function(e) {
        this.setCustomValidity(this.validity.patternMismatch ? pwd1Input.title : "");
        if(this.checkValidity()) {
          pwd2Input.pattern = RegExp.escape(this.value);
          pwd2Input.setCustomValidity(pwd2Input.title);
        } else {
          pwd2Input.pattern = this.pattern;
          pwd2Input.setCustomValidity("");
        }
      }, false);

      pwd2Input.addEventListener("keyup", function(e) {
        this.setCustomValidity(this.validity.patternMismatch ? pwd2Input.title : "");
      }, false);

    }

  }, false);

</script>    
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
		//session_start();
		if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
		{
			$user_id=$_SESSION['usr_id'];
			
			//echo $user_id;
			$stmt = $conn->prepare("SELECT `usr_amt`,`wallet_id` FROM `user_wallet` WHERE `usr_id`=?");
			   $stmt->bind_param("i", $user_id); 
      $stmt->execute();
	  $stmt->bind_result($usr_walletamt,$usr_wllid); 
	  $stmt->fetch();
	  $stmt->close();
	  
	  $stmt1 = $conn->prepare("SELECT count(`trn_id`) FROM `transaction_details` WHERE `trn_usr_id`=?");
			   $stmt1->bind_param("i", $user_id); 
      $stmt1->execute();
	  $stmt1->bind_result($total_trn); 
	  $stmt1->fetch();
	  $stmt1->close();
	  $stmt2 = $conn->prepare("SELECT `usr_name`,`usr_email`,`usr_number` FROM `user_data` WHERE `usr_id`=?");
			   $stmt2->bind_param("i", $user_id); 
      $stmt2->execute();
	  $stmt2->bind_result($usr_name,$usr_mail,$usr_num); 
	  $stmt2->fetch();
	  $stmt2->close();
	  $stmt3 = $conn->prepare("SELECT count(`msg_id`) FROM `msg_details` WHERE `susr_id`=? OR `rusr_id`=?");
			   $stmt3->bind_param("ii", $user_id,$user_id); 
      $stmt3->execute();
	  $stmt3->bind_result($total_msg); 
	  $stmt3->fetch();
	  $stmt3->close();
	  $stmt4 = $conn->prepare("SELECT `prf_set`,`prf_id` FROM `user_profile` WHERE `prf_usrid`=?");
	  $stmt4->bind_param("i", $user_id); 
      $stmt4->execute();
	  $stmt4->bind_result($prf_val,$prf_id); 
	  $stmt4->fetch();
	  $stmt4->close();
	  
	  $stmt5 = $conn->prepare("SELECT count(`sv_id`) FROM `savecard_details` WHERE `sv_usrid`=? and IsActive=1");
	$stmt5->bind_param("i", $user_id); 
      $stmt5->execute();
	  $stmt5->bind_result($total_svcard); 
	  $stmt5->fetch();
	  $stmt5->close();
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
			<span class="agile-breadcrumbs"><a href="index.php"><i class="fa fa-home home_1"></i></a> / <span>My Account</span></span>
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
						<i class="fa fa-eye"></i>
					</div>
					<div class="col-md-8 market-update-left">
						<h4>Messages</h4>
						<h3><?php echo $total_msg;?></h3>
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
						<h4>Card Saved</h4>
						<h3><?php echo $total_svcard;?></h3>
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
	 

     <!--Vertical Tab-->
		<div class="categories-section main-grid-border" id="mobilew3layouts">
		<div class="container">
			<div class="category-list">
				<div id="parentVerticalTab">
					<div class="agileits-tab_nav">
					<ul class="resp-tabs-list hor_1">
						<a href='addmoney.php'><li>Add Money</li></a>
						<a href='transactions.php?id=<?php echo $_SESSION['usr_id'];?>'><li>My Transactions</li></a>
						<a href='sendmoney.php'><li>Send Money</li></a>
						<a href='message.php'><li>Send Message</li></a>
						<a href='inbox.php'><li>Inbox</li></a>
						<a href='outbox.php'><li>Outbox</li></a>
						<a href='upd_num.php'><li>Change Number</li></a>
						<a href='upd_pwd.php'><li>Change Password</li></a>
						<a href='rm_card.php'><li>Remove Saved Card</li></a>
					</ul>
					</div>
					<div class="resp-tabs-container hor_1">
                        <!-- tab1 -->
						<div>
                            <div class="tabs-box">
                                
                    <i class="icon fa fa-user inner-user" aria-hidden="true"></i>
										<div class="bahubali-details">
										
					<?php if(isset($_GET['msg']))
					{
						echo "<br>";
						echo "<span style='color:red'>";
						echo "Profile Password Saved ";
					}
				if(isset($_GET['umsg']))
				{
					echo "<br>";
					echo "<span style='color:red'>";
					echo "Try Again Saving Profile Password";
				}
				if(isset($_GET['inccrt']))
				{
					$res=$_GET['inccrt'];
					
					switch ($res) {
						case 1:
							echo "<br>";
					echo "<span style='color:red'>";
					echo "Contact Number Changed";
							break;
						case 2:
							echo "<br>";
					echo "<span style='color:red'>";
					echo "Login Password Changed";
							break;
						case 3:
						echo "<br>";
					echo "<span style='color:red'>";
					echo "Card Removed";
						break;
						case 4:
						echo "<br>";
					echo "<span style='color:red'>";
					echo "Try Again Updating Number";
						break;
						case 5:
					echo "<br>";
					echo "<span style='color:red'>";
					echo "Try Again Updating Login Password";
						break;
						case 6:
						echo "<br>";
					echo "<span style='color:red'>";
					echo "Try Again Removing Card";
						break;
						case 7:
						echo "<br>";
					echo "<span style='color:red'>";
					echo "Wrong Details Try Again";
						break;
						case 8:
						echo "<br>";
					echo "<span style='color:red'>";
					echo "Please Save Profile Password First";
						break;
					default:
						echo "Try Again Updating Details";
				}
				}
					?>
					</span>
					<br>
						<h4>Name:</h4><br>
						<p><?php echo $usr_name;?></p><br>
						<h4>Email Id:</h4><br>
						<p><?php echo $usr_mail;?></p><br>
						<h4>Contact Number:</h4><br>
						<p><?php echo $usr_num;?></p><br>
						<h4>WalletId:</h4><br>
						<p><?php echo"QwikPay2217". $usr_wllid;?></p><br>
						<h4>Amount In Wallet (In Euros):</h4><br>
						<p><?php echo $usr_walletamt;?></p><br>
						<h4>Card Details</h4><br>
						<p><?php
											 $stmt1 = $conn->prepare("SELECT `sv_id`,`sv_num` FROM `savecard_details` WHERE `sv_usrid`=? and IsActive=1");
											$stmt1->bind_param("i", $user_id);
											$stmt1->execute();
											$stmt1->bind_result($sv_id,$sv_num);											
											  $check=0;
											 //echo $sv_id;
												$stmt1->store_result(); 
											while($row = $stmt1->fetch())
											{		
												$check=1;										
											  //$stmt1->fetch();
											  //$stmt1->close();
											  ?>
											  <h4><font color="#000">Saved Card  <?php echo $sv_num;?><br></font></h4>
											  <?php
											}
											if($check==0){?> <h4><font color="#000">No Card Saved<br></font></h4></p><?php }?>
					</div>
			     <div class="clearfix"> </div>
				 <?php if($prf_val==0)
				 {?>
			     <div class="tab-grids">
                    <div id="tab1" class="tab-grid">  
		                      <div class="login-form">	
						<form action="setprofile.php" method="post" id="myForm">
													
							
                                <h4>Enter your Profile Password</h4>
								<input id="field_pwd1" title="Password must contain at least 8 characters, including UPPER/lowercase and numbers." type="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" name="pwd1"/>
								<br>
								
								 <h4>Re-Enter Profile Password</h4>
								 <input id="field_pwd2" title="Please enter the same Password as above." type="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" name="pwd2"/>
							<!--	<p class="validation01">
									<span class="invalid">Please enter a valid mobile number</span>
									<span class="valid">That's what we wanted!</span>
								</p> -->
							
                                <div class="mobile-right ">
                                    <h4>Enter 4 digit pin</h4>
                                    <div class="mobile-rchge">
                                        <input type="password" placeholder="Enter 4 digit" name="fr_digit" required="required" maxlength="4"  />	
                                    </div>
									<?php
									include('random.php');
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
                                    <div class="clearfix"></div>
                                </div>
                            <br>
							<br>
                            
                                <button type="submit" class="submit btn btn-primary btn-sm">Update</button>
                           
				       
						</form>	
																							
						</div>	

                    </div>
					<div class="clearfix"></div>
				</div>
				<?php 
				 }
				 ?>
			</div>
		</div>
	</div>
				</div>
				</div>
			
			<div class="clearfix"> </div>
		</div>
	<!-- script -->
		<script>
			$(document).ready(function() {
				$("#tab2").hide();
				$("#tab3").hide();
				$("#tab4").hide();
				$(".tabs-menu a").click(function(event){
					event.preventDefault();
					var tab=$(this).attr("href");
					$(".tab-grid").not(tab).css("display","none");
					$(tab).fadeIn("slow");
				});
			});
		</script>
                            
							
                            
            
                    
			             </div>
                        <!-- /tab1 -->
	<!--Plug-in Initialisation-->
	<script type="text/javascript">
    $(document).ready(function() {

        //Vertical Tab
        $('#parentVerticalTab').easyResponsiveTabs({
            type: 'vertical', //Types: default, vertical, accordion
            width: 'auto', //auto or any width like 600px
            fit: true, // 100% fit in a container
            closed: 'accordion', // Start closed if in accordion view
            tabidentify: 'hor_1', // The tab groups identifier
            activate: function(event) { // Callback function if tab is switched
                var $tab = $(this);
                var $info = $('#nested-tabInfo2');
                var $name = $('span', $info);
                $name.text($tab.text());
                $info.show();
            }
        });
    });
</script>
	<!-- //Categories -->


<!--phone-->
	<div class="phone" id="mobileappagileits">
		<div class="container">
			<div class="col-md-6">
				<img src="images/ph1.png" class="img-responsive" alt=""/>
			</div>
			<div class="col-md-6 phone-text">
				<h4>Online Payment mobile app on your smartphone!</h4>
                <p class="subtitle">Simple and Fast Payments</p>
					<div class="text-1">
						<h5>Recharge</h5>
						<p>Recharge your Mobile, DTH, Datacard etc...</p>
					</div>
					<div class="text-1">
						<h5>Paybills</h5>
						<p>Pay your Bills(Electricity, Water, Gas, Broadband, Landline etc...)</p>
					</div>
					<div class="text-1">
						<h5>Book Online</h5>
						<p>Book Online Tickets(Movies, Bus, Train etc...)</p>
					</div>
					<div class="agileinfo-dwld-app">
							<h6>Download The App : 
								<a href="#"><i class="fa fa-apple"></i></a>
								<a href="#"><i class="fa fa-windows"></i></a>
								<a href="#"><i class="fa fa-android"></i></a>
							</h6>
						</div>
			</div>
            <div class="clearfix"></div>
            <div class="wthree-mobile-app">
				<form action="#" method="get"> 
					<input class="text" type="tel" name="tel" placeholder="Enter Your Mobile Number" required="">
					<input type="submit" value="Send Download Link">
				</form>
			</div>
		</div>
	</div>
<!--//phone-->

	
<!-- Support content -->
	<div class="w3l-support">
		<div class="container">
			<div class="col-md-5 w3_agile_support_left">
				<img src="images/cus.jpg" alt=" " class="img-responsive" />
			</div>
			<div class="col-md-7 w3_agile_support_right">
				<h5>Online Recharge</h5>
				<h3>24/7 Customer Service Support</h3>
				<p>Pellentesque accumsan cursus dui, sodales blandit urna sodales vitae. 
					Maecenas placerat eget mi vitae euismod. Duis aliquam efficitur mi, 
					et eleifend velit.</p>
				<div class="agile_more">
					<a href="support.html" class="type-4">
						<span> Support </span>
						<span> Support  </span>
						<span> Support  </span>
						<span> Support  </span>	
						<span> Support  </span>
						<span> Support  </span>
					</a>
				</div>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
<!-- //Support content -->

    
<!--offers-->
		<div class="w3-offers">
			<div class="container">
				<div class="w3-agile-offers">
					<h3>the best offers</h3>
					<p>Contrary to popular belief
							, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.</p>
				</div>
			</div>
		</div>
<!--//offers-->
    
<!--partners-->
	<div class="w3layouts-partners">
		<h3>We are accepted at</h3>
	 		<div class="container">
				<ul>
					<li><a href="#"><img class="img-responsive" src="images/lg.png" alt=""></a></li>
					<li><a href="#"><img class="img-responsive" src="images/lg1.png" alt=""></a></li>
					<li><a href="#"><img class="img-responsive" src="images/lg2.png" alt=""></a></li>
					<li><a href="#"><img class="img-responsive" src="images/lg3.png" alt=""></a></li>
					<li><a href="#"><img class="img-responsive" src="images/lg4.png" alt=""></a></li>
				</ul>
				<ul>
					<li><a href="#"><img class="img-responsive" src="images/lg5.png" alt=""></a></li>
					<li><a href="#"><img class="img-responsive" src="images/lg6.png" alt=""></a></li>
					<li><a href="#"><img class="img-responsive" src="images/lg7.png" alt=""></a></li>
					<li><a href="#"><img class="img-responsive" src="images/lg8.png" alt=""></a></li>
					<li><a href="#"><img class="img-responsive" src="images/lg9.png" alt=""></a></li>	
				</ul>
			</div>
		</div>	
<!--//partners-->	
    
<!-- subscribe -->
	<div class="w3-subscribe agileits-w3layouts"> 
		<div class="container">
			<div class="col-md-6 social-icons w3-agile-icons">
				<h4>Join Us</h4>  
				<ul>
					<li><a href="#" class="fa fa-facebook sicon facebook"> </a></li>
					<li><a href="#" class="fa fa-twitter sicon twitter"> </a></li>
					<li><a href="#" class="fa fa-google-plus sicon googleplus"> </a></li>
					<li><a href="#" class="fa fa-dribbble sicon dribbble"> </a></li>
					<li><a href="#" class="fa fa-rss sicon rss"> </a></li> 
				</ul> 
			</div> 
			<div class="col-md-6 w3-agile-subscribe-right">
				<h3 class="w3ls-title">Subscribe to Our <br><span>Newsletter</span></h3>  
				<form action="#" method="post"> 
					<input type="email" name="email" placeholder="Enter your Email..." required="">
					<input type="submit" value="Subscribe">
					<div class="clearfix"> </div> 
				</form>  
			</div>
			<div class="clearfix"> </div> 
		</div>
	</div>
<!-- //subscribe --> 
    
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
    
<!-- for bootstrap working -->
		<script src="js/bootstrap.js"></script>
<!-- //for bootstrap working --><!-- Responsive-slider -->
    <!-- Banner-slider -->
<script src="js/responsiveslides.min.js"></script>
   <script>
    $(function () {
      $("#slider").responsiveSlides({
      	auto: true,
      	speed: 500,
        namespace: "callbacks",
        pager: true,
      });
    });
  </script>
    <!-- //Banner-slider -->
<!-- //Responsive-slider -->   
<!-- Bootstrap select option script -->
<script src="js/bootstrap-select.js"></script>
<script>
  $(document).ready(function () {
    var mySelect = $('#first-disabled2');

    $('#special').on('click', function () {
      mySelect.find('option:selected').prop('disabled', true);
      mySelect.selectpicker('refresh');
    });

    $('#special2').on('click', function () {
      mySelect.find('option:disabled').prop('disabled', false);
      mySelect.selectpicker('refresh');
    });

    $('#basic2').selectpicker({
      liveSearch: true,
      maxOptions: 1
    });
  });
</script>
<!-- //Bootstrap select option script -->
    
<!-- easy-responsive-tabs -->    
<link rel="stylesheet" type="text/css" href="css/easy-responsive-tabs.css " />
<script src="js/easyResponsiveTabs.js"></script>
<!-- //easy-responsive-tabs --> 
    <!-- here stars scrolling icon -->
			<script type="text/javascript">
				$(document).ready(function() {
					/*
						var defaults = {
						containerID: 'toTop', // fading element id
						containerHoverID: 'toTopHover', // fading element hover id
						scrollSpeed: 1200,
						easingType: 'linear' 
						};
					*/
										
					$().UItoTop({ easingType: 'easeOutQuart' });
										
					});
			</script>
			<!-- start-smoth-scrolling -->
			<script type="text/javascript" src="js/move-top.js"></script>
			<script type="text/javascript" src="js/easing.js"></script>
			<script type="text/javascript">
				jQuery(document).ready(function($) {
					$(".scroll").click(function(event){		
						event.preventDefault();
						$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
					});
				});
			</script>
			<!-- start-smoth-scrolling -->
		<!-- //here ends scrolling icon -->
</body>
<!-- //body -->
</html>
<!-- //html -->