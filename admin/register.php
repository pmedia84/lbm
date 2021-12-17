<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require $_SERVER['DOCUMENT_ROOT'].'/lbm/mailer/PHPMailer.php';
require $_SERVER['DOCUMENT_ROOT'].'/lbm/mailer/SMTP.php';
require $_SERVER['DOCUMENT_ROOT'].'/lbm/mailer/Exception.php';
include("nav-login.inc.php");
include('../php/connect.php');
// Try and connect using the info above.
$db = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}


// Now we check if the data was submitted, isset() function will check if the data exists.
if (!isset($_POST['username'], $_POST['password'], $_POST['email'])) {
	// Could not get the data that should have been sent.
	exit('<div class="container"><p>Please complete the registration form</p></div>
    
    <footer>




    <div class="container footer-admin">

        
    
    

     
        
        </div>
        
    </div>

   








</footer>

<script src="../js/nav.js"></script>
</body>

</html>
    
    
    ');
    
}

// Make sure the submitted registration values are not empty.
if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email'])) {
	// One or more values are empty.
	exit('

            <div class="container"><p>Please complete the registration form</p></div>
            <footer>
            <div class="container footer-admin">
                </div>
                
            </div>
        </footer>
        <script src="../js/nav.js"></script>
        </body>
        </html>');
            include('footer-admin.inc.php');
}

// We need to check if the account with that username exists.
if ($stmt = $db->prepare('SELECT id, password FROM accounts WHERE username = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), hash the password using the PHP password_hash function.
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	$stmt->store_result();
	// Store the result so we can check if the account exists in the database.
	if ($stmt->num_rows > 0) {
		// Username already exists
		echo '<div class="container"><p>Username already exists, please try again</p></div>
       ';
	} else {
		// Username doesnt exist, insert new account
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            exit('<div class="container"><p>Invalid Email address</p></div>
            <footer>
            <div class="container footer-admin">
                </div>
                
            </div>
        </footer>
        <script src="../js/nav.js"></script>
        </body>
        </html>');
        }
        if (preg_match('/^[a-zA-Z0-9]+$/', $_POST['username']) == 0) {
            exit('<div class="container"><p>Invalid username</p></div>
            <footer>
            <div class="container footer-admin">
                </div>
                
            </div>
        </footer>
        <script src="../js/nav.js"></script>
        </body>
        </html>');
        }
        if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
            exit('<div class="container"><p>Password must be between 5 and 20 characters long!</p></div>
            <footer>
            <div class="container footer-admin">
                </div>
                
            </div>
        </footer>
        <script src="../js/nav.js"></script>
        </body>
        </html>');
        }
        if ($stmt = $db->prepare('INSERT INTO accounts (username, password, email, activation_code) VALUES (?, ?, ?, ?)')) {
	// We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in.
	$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
	$uniqid = uniqid();
    $stmt->bind_param('ssss', $_POST['username'], $password, $_POST['email'], $uniqid);

	$stmt->execute();
	$fromserver    = 'noreply@yourdomain.com';
$subject = 'Account Activation Required';

// Update the activation variable below
$activate_link = 'http://localhost/lbm/admin/activate.php?email=' . $_POST['email'] . '&code=' . $uniqid;
$body = '<p>Please click the following link to activate your account: <a href="' . $activate_link . '">' . $activate_link . '</a></p>';

$email_to = $_POST['email'];
///////new
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
	
	<div class='error container'>
   <h1>Thank you</h1>
<p style='text-align:center;'>Check your email for instructions how to reset your password.</p>
</div><br /><br /><br />";
	

}


/////new


            ;
} else {
	// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
	echo 'Could not prepare statement!';
}
	}
	$stmt->close();
} else {
	// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
	echo 'Could not prepare statement!';
}
$db->close();






?>


<?php include("footer-admin.inc.php");?>


