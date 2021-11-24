<?php 
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: login.php');
	exit;
}

include('nav-admin.inc.php');
?>



<div id="login" class="login">
			<h1>Register</h1>
            <p style="text-align: center;">Register a new user for your admin console</p>
			<form action="register.php" method="post" autocomplete="off">

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
				<div class="inputwrapper admin-wrapper">

					<div class="input-prepend">
						<i class="fas fa-at"></i>
					</div>

					<input class="text-input input" type="email" name="email" placeholder="Email" id="email" required>
				</div>

				<input type="submit" value="Register">



			</form>

		</div>

        <?php include('footer-admin.inc.php');?>