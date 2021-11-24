<?php

if(!$_POST) {
	echo "<div style='text-align:center;font-size: 32px;font-weight:bold;'>403 Forbidden</div>";
	header($_SERVER['SERVER_PROTOCOL'].' 403 Forbidden');
	exit;
}

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require $_SERVER['DOCUMENT_ROOT'].'/includes/mailer/PHPMailer.php';
require $_SERVER['DOCUMENT_ROOT'].'/includes/mailer/SMTP.php';
require $_SERVER['DOCUMENT_ROOT'].'/includes/mailer/Exception.php';

//get post variables and filter
$validation = filter_var($_POST['validation'],FILTER_SANITIZE_STRING);
$name       = filter_var($_POST['name'],FILTER_SANITIZE_STRING);
$email      = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
$phone      = filter_var($_POST['phone'],FILTER_SANITIZE_SPECIAL_CHARS);
$message    = filter_var($_POST['message'],FILTER_SANITIZE_STRING);

//set variables
$from       = "jonathan@jonathanallen.org.uk";
$from_name  = "Jonathan Allen";

if(isset($validation) && !empty($validation)) {
    
	$secret = '6Ld5-0IUAAAAAISdV2074NIXlbs27CGFuJ_ZskKs';
	$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$validation);
	$responseData = json_decode($verifyResponse);
	if($responseData->success) {
        
		//success start
		// Email address verification.
		function isEmail($email) {
			return(preg_match("/^[-_.[:alnum:]]+@((([[:alnum:]]|[[:alnum:]][[:alnum:]-]*[[:alnum:]])\.)+(ad|ae|aero|af|ag|ai|al|am|an|ao|aq|ar|arpa|as|at|au|aw|az|ba|bb|bd|be|bf|bg|bh|bi|biz|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|com|coop|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|edu|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gh|gi|gl|gm|gn|gov|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|in|info|int|io|iq|ir|is|it|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|mg|mh|mil|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|museum|mv|mw|mx|my|mz|na|name|nc|ne|net|nf|ng|ni|nl|no|np|nr|nt|nu|nz|om|org|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|pro|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)$|(([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5])\.){3}([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5]))$/i",$email));
		}
		//define new line
		if (!defined("PHP_EOL")) {
			define("PHP_EOL", "\r\n");
		}
		//check values
		if(trim($name) == '') {
			echo '<div id="response">0</div><div class="error_message">You must enter your name. Please try again.</div>';
			exit();
		} else if(trim($email) == '') {
			echo '<div id="response">0</div><div class="error_message">You must enter your email. Please try again.</div><br>';
			exit();
		} else if(!isEmail($email)) {
			echo '<div id="response">0</div><div class="error_message">Invalid email address. Please try again.</div><br>';
			exit();
		} else if(trim($phone) == '') {
			echo '<div id="response">0</div><div class="error_message">You must enter your phone. Please try again.</div><br>';
			exit();
		} else if(trim($message) == '') {
			echo '<div id="response">0</div><div class="error_message">No message. Please try again.</div>';
			exit();
		}


        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

		//Enable SMTP debugging
		//SMTP::DEBUG_OFF = off (for production use)
		//SMTP::DEBUG_CLIENT = client messages
		//SMTP::DEBUG_SERVER = client and server messages
		$mail->SMTPDebug = SMTP::DEBUG_OFF;
		//Server settings
		$mail->isSMTP();                                            //Send using SMTP
		$mail->Host       = 'localhost';                     //Set the SMTP server to send through
		$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
		$mail->Username   = 'xxx';                     //SMTP username
		$mail->Password   = 'xxx';                               //SMTP password
		//security settings. uncomment below 2 lines for no TLS. Also comment out any other $mail->SMTPSecure lines and set Port to 25
		// $mail->SMTPAutoTLS = false;
		// $mail->SMTPSecure = false;
		//Set the encryption mechanism to use:
		// - PHPMailer::ENCRYPTION_SMTPS (implicit TLS on port 465) or
		// - PHPMailer::ENCRYPTION_STARTTLS (explicit TLS on port 587)
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
		//TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`. user 465 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;`.
		$mail->Port       = 465;

		//email to site owner
        try {
            //Recipients
            $mail->setFrom($from, $from_name);
            $mail->addAddress($from, $from_name);     //Add a recipient
            $mail->addReplyTo($email, $name);

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'You have been contacted by ' . $name . '.';
            $mail->Body    = "<h4>Dear $from_name,</h4>
            <p>You have been contacted by $name.</p>
            <p><strong>Message:</strong><br>$message</p>
            <p><strong>Name:</strong> $name<br>
            <strong>Email:</strong> $email <br>
            <strong>Phone:</strong> $phone <br></p>
            <p>Regards,<br><br><strong>Administrator</strong></p>";

            $mail->send();
            $sendstatus_owner = true;
        } catch (Exception $e) {
            //Email failed to send, echo error
			echo '<div id="response">0</div><div class="error_message">ERROR! Please call us for assistance.</div><br>';
			exit;
        }
		//clear previous
		$mail->clearAllRecipients( );
		$mail->clearReplyTos();
		//email to customer
		try {
            //Recipients
            $mail->setFrom($from, $from_name);
            $mail->addAddress($email, $name);     //Add a recipient
            $mail->addReplyTo($from, $from_name);

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'You have contacted ' . $from_name;
            $mail->Body    = "<h4>Dear $name,</h4>
            <p>We have recieved your request.</p>
            <p><strong>Message:</strong><br>$message</p>
            <p>Regards,<br><br><strong>$from_name</strong></p>";

            $mail->send();
            $sendstatus_cust = true;
        } catch (Exception $e) {
            //Email failed to send, echo error
			echo '<div id="response">0</div><div class="error_message">ERROR! Please call us for assistance.</div><br>';
			exit;
        }
		//emails sent echo success to page
		if ($sendstatus_owner == true && $sendstatus_cust == true) {
			echo "<fieldset>
				<div id='response'>1</div>
				<div id='success_page'>
					<p style='font-size:18px; color:#000;'>Email Sent Successfully.</p>
					<p style='font-size:12px; color:#000;'>Thank you <strong>$name</strong>, your message has been submitted to us.</p>
				</div>
			</fieldset>";
			exit;
		}

    } else {
        //validation present but failed
        echo '<div id="response">0</div><div class="error_message">Robot Verification failed! Please try again.</div><br>';
        exit;
    }
} else {
    //validation not present
    echo '<div id="response">0</div><div class="error_message">Robot Verification not recieved! Please try again.</div><br>';
    exit;
}
?>