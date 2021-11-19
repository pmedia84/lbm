<?php
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: login.php');
	exit;
}
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check that the contact ID exists
if (isset($_GET['id'])) {
    // Select the record that is going to be deleted
    $stmt = $pdo->prepare('SELECT * FROM product WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$product) {
        exit('product doesn\'t exist with that ID!');
    }
    // Make sure the user confirms beore deletion
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            // User clicked the "Yes" button, delete record
            $stmt = $pdo->prepare('DELETE FROM product WHERE id = ?');
            $stmt->execute([$_GET['id']]);
            $msg = 'You have deleted the product!';
        } else {
            // User clicked the "No" button, redirect them back to the read page
            header('Location: price-list.php');
            exit;
        }
    }
} else {
    exit('No ID specified!');
}
?>
<?php include("nav-admin.inc.php");?>
<div class="container delete">
	<h2 class="p-b-1">Delete Product #<?=$product['id']?></h2>
    <p><?=$product['name']?></p>
    <p><?=$product['description']?></p>
    <p>£<?=$product['price']?>.00</p>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php else: ?>
	<p>Are you sure you want to delete your Product <strong><?=$product['name']?>?</strong> </p>
    <div class="yesno">
        <a href="delete.php?id=<?=$product['id']?>&confirm=yes">Yes</a>
        <a href="delete.php?id=<?=$product['id']?>&confirm=no">No</a>
    </div>
    <?php endif; ?>
</div>

<?php include("footer-admin.inc.php");?>