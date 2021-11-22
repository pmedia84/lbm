<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: login.php');
	exit;
}
?>
<?php include("nav-admin.inc.php"); ?>
    <title>Lashes Brows and Aesthetics - Admin</title>

    
</head>






<?php
// We need to use sessions, so you should always start sessions using the below code.

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'admin';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
// We don't have the password or email info stored in sessions so instead we can get the results from the database.
$stmt = $con->prepare('SELECT password, email FROM accounts WHERE id = ?');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($password, $email);
$stmt->fetch();
$stmt->close();
?>

<body class="loggedin">
		<section class="navadmin container">
			<div>
				<h1>Your Account Details: <?=$_SESSION['name']?></h1>
				
			</div>
</section>
		<div class="container">
			<h2>User Profile</h2>
			<div>
				<p>Your account details are below:</p>
				<table>
					<tr>
						<td>Username:</td>
						<td><?=$_SESSION['name']?></td>
					</tr>
					<tr>
						<td>Password:</td>
						<td><?=$password?></td>
					</tr>
					<tr>
						<td>Email:</td>
						<td><?=$email?></td>
					</tr>
				</table>
			</div>
		</div>


<?php



include 'functions.php';
// Connect to MySQL database


// Number of records to show on each page


// Prepare the SQL statement and get records from our products table, LIMIT will determine the page
$query = "SELECT *FROM details ORDER BY id";
$result = $con->query($query);
while ($row = $result->fetch_assoc()) {
$id = $row['id'];
$name = $row['business_name'];
$telnum = $row['tel_num'];
$email = $row['email'];

}
?>
<div class="container">
			<h2>Business Details</h2>
			<div>
				<p>Your Business details are below:</p>
				<p>Ensure this information is up to date at all times</p>
				<table>
					<tr>
						<td>Username:</td>
						<td><?=$name?></td>
					</tr>
					<tr>
						<td>Password:</td>
						<td><?=$telnum?></td>
					</tr>
					<tr>
						<td>Email:</td>
						<td><?=$email?></td>
					</tr>
					
				</table>
			</div>
		</div>



<?php include("footer-admin.inc.php");?>