<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.php');
	exit;
}
include '../php/connect.php';
if (mysqli_connect_errno()) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
// We don't have the password or email info stored in sessions so instead we can get the results from the database.
$stmt = $db->prepare('SELECT password, email FROM accounts WHERE id = ?');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($password, $email);
$stmt->fetch();
$stmt->close();
?>
<?php include("nav-admin.inc.php"); ?>
<body class="loggedin">
		<section class="navadmin container">
			<div>
				<h1>Your Account Details: <?=$_SESSION['name']?></h1>
				
			</div>
</section>
		<div class="container">
			<h2>Profile Page</h2>
			<div>
				<p>Your account details are below:</p>
				<table>
					<tr>
						<td>Username:</td>
						<td><?=$_SESSION['name']?></td>
					</tr>
					
					<tr>
						<td>Email:</td>
						<td><?=$email?></td>
					</tr>
				</table>
			</div>
			<p><a href="edit-user.php?id=<?=$_SESSION['id']?>">Edit Profile</a></p>
			<p><a href="registernewuser">Register a new user</a></p>

<p>Need to reset your password? You can do that <a href="login" >Here</a></p>
		</div>

        <?php include("footer-admin.inc.php");?>