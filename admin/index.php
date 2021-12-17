<?php

session_start();

if (!isset($_SESSION['loggedin'])) {
	header('Location: login.php');
	exit;
}
?>
<?php include("nav-admin.inc.php"); ?>
<title>Lashes Brows and Aesthetics - Admin</title>
</head>
<?php






include '../php/connect.php';
// Connect to MySQL database




$product = "SELECT * FROM product";
$product = mysqli_query($db, $product);
$rowcount = mysqli_num_rows($product);




// Number of records to show on each page


// Prepare the SQL statement and get records from our products table, LIMIT will determine the page
$query = "SELECT * FROM details ORDER BY id";
$result = $db->query($query);
while ($row = $result->fetch_assoc()) {
	$id = $row['id'];
	$name = $row['business_name'];
	$telnum = $row['tel_num'];
	$email = $row['email'];
}



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

<body class="">

<section class="dashboard container">
<div class="dashboard-icon-wrapper">
		
				<p>Products</p>
				<i class="fas fa-tags dashboard-icon"></i>
				<p><?= $rowcount ?> items</p>
				<a href="price-list">View More</a>
		</div>
			
		
			<div class="dashboard-icon-wrapper">
			<p>User Profile</p>
				<i class="fas fa-user dashboard-icon"></i>
				<p><?= $_SESSION['name'] ?></p>
			<a href="edit-user.php?id=<?=$_SESSION['id']?>">Edit Profile</a>
			</div>
		
			<div class="dashboard-icon-wrapper">
			<p>Business Profile</p>
			<i class="fas fa-building dashboard-icon"></i>
			<p><?=$name ?> </p>
			<a href="edit-business-details.php?id=<?=$id?>">Edit Business Details</a>
			</div>


</section>
	<section class="navadmin container">
		<div>
			<h1>Welcome Back <?= $_SESSION['name'] ?></h1>

		</div>
	</section>
	<div class="container">
		<p>Your Profile</p>
		<div>
			
			<table>
				<tr>
					<td>Username:</td>
					<td><?= $_SESSION['name'] ?></td>
				</tr>
				
				<tr>
					<td>Email:</td>
					<td><?= $email ?></td>
				</tr>
			</table><br>
			<a href="edit-user.php?id=<?=$_SESSION['id']?>">Edit Profile</a>
		</div>
		

		


		

	</div>



	<div class="container">
		<h2>Business Details</h2>
		<div>
			<p>Your Business details are below:</p>
			<p>Ensure this information is up to date at all times</p>
			<table>
				<tr>
					<td>Name:</td>
					<td><?= $name ?></td>
				</tr>
				<tr>
					<td>Telephone Number:</td>
					<td><?= $telnum ?></td>
				</tr>
				<tr>
					<td>Email:</td>
					<td><?= $email ?></td>
				</tr>

			</table><br>
			<a href="edit-business-details.php?id=<?=$id?>">Edit Business Details</a>
		</div>
	</div>




	<?php include("footer-admin.inc.php"); ?>