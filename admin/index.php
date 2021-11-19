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

<p>Welcome back, <?=$_SESSION['name']?>!</p>
<body>

<?php include("footer-admin.inc.php");?>