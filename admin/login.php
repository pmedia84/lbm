<?php include("nav-login.inc.php"); ?>
<div class="login ">

        <!-- Tab links -->
        <div class="tab login-tab">
            <button class="tablinks" onclick="opentab(event, 'login')" id="defaultOpen">Login</button>
            <button class="tablinks" onclick="opentab(event, 'resetpw')" id="reset">Forgot Password</button>

        </div>

		<div id="login" class="tabcontent tabcontent-login">
		
	<form action="authenticate.php" method="post">

		<div class="inputwrapper admin-wrapper">

			<div class="input-prepend">
				<span class="input-prepend-text"><i class="fas fa-user"></i></span>
			</div>

			<input class="text-input input" type="text" name="username" placeholder="Username" id="username" required>
		</div>



		<div class="inputwrapper admin-wrapper">

			<div class="input-prepend">
				<i class="fas fa-lock"></i>
			</div>

			<input class="text-input input" type="password" name="password" placeholder="Password" id="password" required>
		</div>


		<input type="submit" value="Login">



	</form>
	
		</div>
		<div id="resetpw" class="tabcontent tabcontent-login">
		
		<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require $_SERVER['DOCUMENT_ROOT'].'/mailer/PHPMailer.php';
require $_SERVER['DOCUMENT_ROOT'].'/mailer/SMTP.php';
require $_SERVER['DOCUMENT_ROOT'].'/mailer/Exception.php';

include("../php/connect.php");
if (mysqli_connect_errno()){
echo "Failed to connect to MySQL: " . mysqli_connect_error();
die();
}
date_default_timezone_set('Europe/London');

$error="";





if(isset($_POST["email"]) && (!empty($_POST["email"]))){
$email = $_POST["email"];
$email = filter_var($email, FILTER_SANITIZE_EMAIL);
$email = filter_var($email, FILTER_VALIDATE_EMAIL);
if (!$email) {
   $error .="<p>Invalid email address please type a valid email address!</p>";
   }else{
   $sel_query = "SELECT * FROM `accounts` WHERE email='".$email."'";
   $results = mysqli_query($db,$sel_query);
   $row = mysqli_num_rows($results);
   if ($row==""){
   $error .= "<p>No user is registered with this email address!</p>";
   
   }
  }
   if(!$error=""){
   echo "<div class='error'>".$error."
   <p>No user is registered with this email address!</p>
   <br /><a href='javascript:history.go(-1)'>Go Back</a></div>";

   }else{
   $expFormat = mktime(
   date("H"), date("i"), date("s"), date("m") ,date("d")+1, date("Y")
   );
   $expDate = date("Y-m-d H:i:s",$expFormat);
   $key = substr(md5(rand()), 0, 7); 
   $addKey = substr(md5(uniqid(rand(),1)),3,10);
   $key = $key . $addKey;
// Insert Temp Table
mysqli_query($db,
"INSERT INTO `password_reset_temp` (`email`, `key`, `expDate`)
VALUES ('".$email."', '".$key."', '".$expDate."');");

$output='<p>Dear user,</p>';
$output.='<p>Please click on the following link to reset your password.</p>';
$output.='<p>-------------------------------------------------------------</p>';
$output.='<p><a href="http://localhost/lbm/admin/resetpw.php?key='.$key.'&email='.$email.'&action=reset" target="_blank">
http://localhost/lbm/admin/resetpw.php
?key='.$key.'&email='.$email.'&action=reset</a></p>';		
$output.='<p>-------------------------------------------------------------</p>';
$output.='<p>Please be sure to copy the entire link into your browser.
The link will expire after 1 day for security reasons.</p>';
$output.='<p>If you did not request this forgotten password email, no action 
is needed, your password will not be reset. However, you may want to log into 
your account and change your security password as someone may have guessed it.</p>';   	
$output.='<p>Thanks,</p>';
$output.='<p>Lashes Brows & Aesthetics Admin</p>';
$body = $output; 
$subject = "Password Recovery - Lashes Brows & Aesthetics Admin";

$email_to = $email;
$fromserver = "admin@lashesbrowsandaesthetics.co.uk"; 

$mail = new PHPMailer(true);
$mail->IsSMTP();
$mail->Host = "mail.lashesbrowsandaesthetics.co.uk"; // Enter your host here
$mail->SMTPAuth = true;
$mail->Username = "admin@lashesbrowsandaesthetics.co.uk"; // Enter your email here
$mail->Password = "LBA_2021!"; //Enter your password here
$mail->Port = 25;
$mail->IsHTML(true);
$mail->From = "admin@lashesbrowsandaesthetics.co.uk";
$mail->FromName = "Lashes Brows & Aesthetics";
$mail->Sender = $fromserver; // indicates ReturnPath header
$mail->Subject = $subject;
$mail->Body = $body;
$mail->AddAddress($email_to);
if(!$mail->Send()){
echo "Mailer Error: " . $mail->ErrorInfo;
}else{

echo "
	
	<div class='error'>
   <h1>Thank you</h1>
<p style='text-align:center;'>Check your email for instructions how to reset your password.</p>
</div><br /><br /><br />";
	

}
   }
}else{
?>
<h1>Reset your password here</h1>
<p class="tabcontent-textbox">If you are having problems logging in to your account then enter your email address below, and we will send you instructions to reset your password.</p>

	<form onsubmit="return stayontab" action="" method="post" autocomplete="off">
		
		<div class="inputwrapper admin-wrapper">

			<div class="input-prepend">
				<span class="input-prepend-text"><i class="fas fa-at"></i></span>
			</div>

			<input class="text-input input" type="email" name="email" placeholder="Email Address" id="username" autocomplete="off" required>
		</div>



	

		
		<input type="submit" value="Reset Password"/>
		


	</form>
	



<?php } ?>
	
			</div>
</div>


<script>
	function opentab(evt, tabname) {
		// Declare all variables
		var i, tabcontent, tablinks;
	
		// Get all elements with class="tabcontent" and hide them
		tabcontent = document.getElementsByClassName("tabcontent");
		for (i = 0; i < tabcontent.length; i++) {
		  tabcontent[i].style.display = "none";
		}
	
		// Get all elements with class="tablinks" and remove the class "active"
		tablinks = document.getElementsByClassName("tablinks");
		for (i = 0; i < tablinks.length; i++) {
		  tablinks[i].className = tablinks[i].className.replace(" active", "");
		}
	
		// Show the current tab, and add an "active" class to the button that opened the tab
		document.getElementById(tabname).style.display = "block";
		evt.currentTarget.className += " active";
	  }
	  document.getElementById("defaultOpen").click();
	 
</script>

<?php include("footer-admin.inc.php"); ?>