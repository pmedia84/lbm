<?php

if(!$_POST) {
	echo "<div style='text-align:center;font-size: 32px;font-weight:bold;'>403 Forbidden</div>";
	header($_SERVER['SERVER_PROTOCOL'].' 403 Forbidden');
	exit;
}

if(isset($_POST['validation']) && !empty($_POST['validation'])) {
	$secret = '6LfvLVMcAAAAAIA3NRIco65JJJZ6qJ7XnHFURBID';
	$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['validation']);
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
		//filter values
		$name     = filter_var($_POST['name'],FILTER_SANITIZE_STRING);
		$email    = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
		$phone    = filter_var($_POST['phone'],FILTER_SANITIZE_SPECIAL_CHARS);
		$message  = filter_var($_POST['message'],FILTER_SANITIZE_STRING);
		// define extra fields for an auto reply to customer
		$visitoremail    = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
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


		// Configuration options
		// Enter the email address that you want emails to be sent to.
		$address = "mandi@lashesandbrowsbymandi.co.uk";
		

		//email subject
		$e_subject = 'You have been contacted by ' . $name . '.';
		

		// compose email body
		$msg = "<h4>Dear Mandi,</h4>
		<p>You have been contacted by $name.</p>
		<p><strong>Message:</strong><br>$message</p>
		<p><strong>Name:</strong> $name<br>
		<strong>Email:</strong> $email <br>
		<strong>Phone:</strong> $phone <br></p>
		<p>Regards,<br><br><strong>Administrator</strong></p>";

		// Auto Reply email Body
		$armsg = "<h4>Dear $name,</h4>
		<p>Thank you for contacting Apex Personal Training.</p>
		<p>We will be in touch very soon</p>
		<p>You asked us :<strong>Message:</strong><br>$message</p>
		<br>
		<p>Regards,<br><br><strong>Apex Personal Training</strong></p>";

		//email headers
		$headers = "From: Lashes and Brows by Mandi <admin@lashesandbrowsbymandi.co.uk>" . PHP_EOL;
		$headers .= "Return-Path: Lashes and Brows by Mandi <admin@lashesandbrowsbymandi.co.uk>" . PHP_EOL;
		$headers .= "Reply-To: $name <$email>" . PHP_EOL;
		$headers .= "MIME-Version: 1.0" . PHP_EOL;
		$headers .= "Content-type: text/html; charset=iso-8859-1" . PHP_EOL;
		$headers .= "Content-Transfer-Encoding: quoted-printable" . PHP_EOL;

		

		//send email
		if(mail($address, $e_subject, $msg, $headers)) {
			// Email has sent successfully, echo a success page
			echo "<fieldset>
					<div id='response'>1</div>
					<div id='success_page'>
						<p>Email Sent Successfully.</p>
						<p>Thank you <strong>$name</strong>, your message has been submitted to us.</p>
					</div>
				</fieldset>";
				

				
			
			exit;
		} else {
			//Email failed to send, echo error
			echo '<div id="response">0</div><div class="error_message">ERROR! Please call us for assistance.</div><br>';
			exit;
		}
	//success end

	} else {
		//validation present but failed
		echo '<div id="response">0</div><div class="error_message">Robot Verification failed! Please try again.</div><br>';
		exit;
	}
} else {
	//validation not present
	echo '<div id="response">0</div><div class="error_message">Robot Verification failed! Please try again.</div><br>';
	exit;
}