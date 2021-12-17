

<?php
include("nav-login.inc.php");
include('../php/connect.php');
if (isset($_GET["key"]) && isset($_GET["email"]) && isset($_GET["action"]) 
&& ($_GET["action"]=="reset") && !isset($_POST["action"])){
  $key = $_GET["key"];
  $email = $_GET["email"];
  $curDate = date("Y-m-d H:i:s");
  $query = mysqli_query($db,
  "SELECT * FROM `password_reset_temp` WHERE `key`='".$key."' and `email`='".$email."';"
  );
  $row = mysqli_num_rows($query);
  if ($row==""){
  $error .= '<h2>Invalid Link</h2>
<p>The link is invalid/expired. Either you did not copy the correct link
from the email, or you have already used the key in which case it is 
deactivated.</p>
<p><a href="/login">
Click here</a> to reset password.</p>';
	}else{
  $row = mysqli_fetch_assoc($query);
  $expDate = $row['expDate'];
  if ($expDate >= $curDate){
    
  ?>
  <br />

  <div class="container update">
    <h1 style="text-align: center;">Reset Your Password</h1>
    <form method="post" action="" name="update">
    <input type="hidden" name="action" value="update" />
    <br /><br />
    <label for="pass1">Enter New Password</label>
          <div class="inputwrapper admin-wrapper">
    
              <div class="input-prepend">
                  <span class="input-prepend-text"><i class="fas fa-key"></i></span>
              </div>
    
              <input class="text-input input" type="password" name="pass1" placeholder="Enter New Password" id="pass1" maxlength="15" required>
          </div>
          <label for="pass2">Re-Enter New Password</label>
          <div class="inputwrapper admin-wrapper">
    
              <div class="input-prepend">
                  <span class="input-prepend-text"><i class="fas fa-key"></i></span>
              </div>
    
              <input class="text-input input" type="password" name="pass2" placeholder="Enter New Password" id="pass2" maxlength="15" required>
          </div>
    <input type="hidden" name="email" value="<?php echo $email;?>"/>
    <input type="submit" value="Reset Password" />
    </form>
  </div>







<?php
}else{
$error .= "<h2>Link Expired</h2>
<p>The link has expired. You are trying to use an expired link which 
is valid only for 24 hours (1 day after the request).<br /><br /></p>";
            }
      }
if($error=""){
  echo "<div class='error'>".$error."</div><br />";
  }			
} // isset email key validate end


if(isset($_POST["email"]) && isset($_POST["action"]) &&
 ($_POST["action"]=="update")){
$error="";
$pass1 = mysqli_real_escape_string($db,$_POST["pass1"]);
$pass2 = mysqli_real_escape_string($db,$_POST["pass2"]);
$password = password_hash($pass1, PASSWORD_DEFAULT);
$email = $_POST["email"];
$curDate = date("Y-m-d H:i:s");
if ($pass1!=$pass2){
$error.= "<p>Password do not match, both passwords should be same.<br /><br /></p>";
  }
  if($error!=""){
echo "<div class='error'>".$error."</div><br />";
}else{

mysqli_query($db,
"UPDATE `accounts` SET `password`='".$password."' 
WHERE `email`='".$email."';"
);

mysqli_query($db,"DELETE FROM `password_reset_temp` WHERE `email`='".$email."';");
	
echo '<div class="error container"><p>Congratulations! Your password has been updated successfully.</p>
<p><a href="login">
Click here</a> to Login.</p></div><br />';
	  }		
}
?>

<?php include("footer-admin.inc.php");?>