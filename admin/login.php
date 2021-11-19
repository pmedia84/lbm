<?php include("nav-login.inc.php"); ?>

<div class="login container">
	<h1>Login</h1>
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



<?php include("footer-admin.inc.php"); ?>