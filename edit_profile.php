<!--A Design by W3layouts 
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<?php
session_start();
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

	<script type="text/javascript">
	function myFunctionSend() {
   header("location:upd_num.php");
}
function myFunctionSend1() {
   header("location:rm_card.php");
}
function myFunctionSend2() {
   header("location:upd_pwd.php");
}
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
	  $stmt2 = $conn->prepare("SELECT `usr_name`,`usr_email`,`usr_number`,`usr_crdsve` FROM `user_data` WHERE `usr_id`=?");
			   $stmt2->bind_param("i", $user_id); 
      $stmt2->execute();
	  $stmt2->bind_result($usr_name,$usr_mail,$usr_num,$usr_crdsve); 
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
				<a data-toggle='modal' data-target='' href='#'><i class='glyphicon glyphicon-user'> </i>Login/Register</a>
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
			<span class="agile-breadcrumbs"><a href="index.php"><i class="fa fa-home home_1"></i></a> / <span>My Account</span></span>
		</div>
	</div>
	<div class="support w3layouts-content">
		<div class="container">
			<h3 class="w3-head">Support Page</h3>
            <div class="col-md-8 w3ls-supportform">
					<div class="control-group form-group">
						<div class="controls">
						<h4>Name: <?php echo $usr_name;?></h4><br>
						<h4>Email: <?php echo $usr_mail;?></h4><br>
						<button onclick="myFunctionSend()" class="submit btn btn-primary">Change Number</button>
						<button onclick="myFunctionSend1()" class="submit btn btn-primary">Remove Card</button>
						<button onclick="myFunctionSend2()" class="submit btn btn-primary">Change Password</button>
						</div>
						<!--
						<h5>Enter New Mobile Number:</h5><br>
							<input type="text" class="form-control" placeholder="Enter your Number" name="ch_num" id="name" value=<?php //echo $usr_num;?>>
						</div>
					</div>
					<button onclick="myFunction1()" class="submit btn btn-primary">Change Password</button>
					<br>
					<div id="DivPass1" style="display:none;>
						<div class="controls">
						<h5>Enter New Password:</h5><br>
							<input id="field_pwd1" title="Password must contain at least 8 characters, including UPPER/lowercase and numbers." type="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" name="pwd1"/>
					</div>
					<br>
					<div id="DivPass2" style="display:none;>
                        <div class="controls">
						<h5>Enter Confirm Password:</h5><br>
                             <input id="field_pwd2" title="Please enter the same Password as above." type="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" name="pwd2"/>
							 </div>
							<p class="help-block"></p>
						<h5>Remove Card</h5><br>
					
											 $stmt1 = $conn->prepare("SELECT `sv_id`,`sv_num` FROM `savecard_details` WHERE `sv_usrid`=? and IsActive=1");
											$stmt1->bind_param("i", $user_id);
											$stmt1->execute();
											$stmt1->bind_result($sv_id,$sv_num);											
											  
											 //echo $sv_id;
												$stmt1->store_result(); 
											while($row = $stmt1->fetch())
											{											  
											  //$stmt1->fetch();
											  //$stmt1->close();
											  ?>
											  
											  <input type="checkbox" name="pay_save_card" value=//<?php// echo $sv_id;?> ><b><font color="#000">You have your card saved want to add from it?<?php //echo $sv_num;?><br></font>
											  <?php
						//}?>
						<div id="success"></div>
						<!-- For success/fail messages 
						<div id="DivFree">
						<button onclick="myFunction()" class="submit btn btn-primary">Save</button>
						</div>
							<div id="DivPaid" style="display:none;">
							<h5>Enter Profile Password</h5><br>
						 <!-- <input id="field_pwd3" title="Please enter the profile password" type="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" name="pwd3"/>
						  <input type="hidden" name="usr_email" value=<?php //echo $usr_mail;?>/>
						<button onclick="myFunctionSend()" class="submit btn btn-primary">Save</button>
						</form>*/?>-->
			</div>
						
					<div class="clearfix"></div>	
					
                </div>
            <div class="col-md-4 agileits-support">
                <ul>
                    <li><strong>Call to:</strong> +040 55 468, +005 256 54 </li>
                    <li><strong>Mail to:</strong> <a href="mailto:icsathlone@gmail.com">onlinerecharge@example.com</a></li>
                    <li><a class="w3-faq" href="faq.html">Faq</a></li>
                </ul>
            </div>
            <div class="clearfix"></div>
<!-- js files for contact from validation -->
		<script src="js/jqBootstrapValidation.js"></script>
		<script src="js/contact_me.js"></script>
	<!-- //js files for contact from validation -->

	</div>
</div>
</div>
</html>