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


include("../php/connect.php");

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

<body class="loggedin">
	<section class="navadmin container">
		<div>
			<h1>Your Account Details: <?= $_SESSION['name'] ?></h1>

		</div>
	</section>
	<div class="container">
		<h2>Your Profile</h2>
		<div>
			<p>Your account details are below:</p>
			<table>
				<tr>
					<td>Username:</td>
					<td><?= $_SESSION['name'] ?></td>
				</tr>
				
				<tr>
					<td>Email:</td>
					<td><?= $email ?></td>
				</tr>
			</table>
		</div>
		<a href="registernewuser">Register a new user</a><br>

		<p>Need to reset your password? You can do that <a href="login" >Here</a></p>


		

	</div>


	<?php



	include '../php/connect.php';
	// Connect to MySQL database


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

	?>
	<div class="container">
		<h2>Business Details</h2>
		<div>
			<p>Your Business details are below:</p>
			<p>Ensure this information is up to date at all times</p>
			<table>
				<tr>
					<td>Username:</td>
					<td><?= $name ?></td>
				</tr>
				<tr>
					<td>Password:</td>
					<td><?= $telnum ?></td>
				</tr>
				<tr>
					<td>Email:</td>
					<td><?= $email ?></td>
				</tr>

			</table>
		</div>
	</div>


	<div class="container">
		<?php



		$product = "SELECT * FROM product";
		$product = mysqli_query($db, $product);
		$rowcount = mysqli_num_rows($product);


		?>

		<h2>Your Price List</h2>
		<p>You have <?= $rowcount ?> items in your price list.</p>
		<a href="price-list">You can manage you price list here.</a>


		<div class="index-price-table">
			<table>
				<thead>
					<tr>

						<th class="name">Name</th>

						<th>Description</th>
						<th class="price">Price</th>


					</tr>
				</thead>
				<tbody>
					<?php foreach ($product as $product) : ?>
						<tr>

							<td><?= $product['name'] ?></td>

							<td><?= $product['description'] ?></td>
							<td>£<?= $product['price'] ?></td>


						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>


	<?php include("footer-admin.inc.php"); ?>