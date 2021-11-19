<?php include("nav-admin.inc.php"); ?>


<?php
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: login.php');
	exit;
}
include 'functions.php';
// Connect to MySQL database
$pdo = pdo_connect_mysql();
// Get the page via GET request (URL param: page), if non exists default the page to 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
// Number of records to show on each page
$records_per_page = 10;

// Prepare the SQL statement and get records from our products table, LIMIT will determine the page
$stmt = $pdo->prepare('SELECT * FROM product ORDER BY id LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the records so we can display them in our template.
$product = $stmt->fetchAll(PDO::FETCH_ASSOC);



// Get the total number of products, this is so we can determine whether there should be a next and previous button
$num_products = $pdo->query('SELECT COUNT(*) FROM product')->fetchColumn();
?>


<div class="container read">
	<h1>View Your Price List</h1><br>
	<a class="btn" href="create.php" class="create-contact" style="margin-bottom: 1rem;">Create Product</a><br><br>
	<table>
        <thead>
        <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th class="th-description">Description</th>
                    <th>Subtitle</th>
                    <th>Price</th>
                    <th>Extra</th>
                    <th>Edit</th>
                </tr>
        </thead>
        <tbody>
            <?php foreach ($product as $product): ?>
            <tr>
                <td><?=$product['id']?></td>
                <td><?=$product['name']?></td>
                <td><?=$product['description']?></td>
                <td><?=$product['subtitle']?></td>
                <td>£<?=$product['price']?></td>
                <td><script><?=$product['button']?></script></td>
                <td class="actions">
                    <a href="update.php?id=<?=$product['id']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="delete.php?id=<?=$product['id']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	<div class="pagination">
		<?php if ($page > 1): ?>
		<a href="price-list.php?page=<?=$page-1?>"><i class="far fa-hand-point-left"></i></a>
		<?php endif; ?>
		<?php if ($page*$records_per_page < $num_products): ?>
		<a href="price-list.php?page=<?=$page+1?>"><i class="far fa-hand-point-right"></i></a>
		<?php endif; ?>
	</div>
</div>


















<?php include("footer-admin.inc.php");?>