<?php include("nav-admin.inc.php");?>

<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the user id exists, for example edit-user.php?id=1 will get the product with the id of 1
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $username = isset($_POST['username']) ? $_POST['username'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';

        // Update the record
        $stmt = $pdo->prepare('UPDATE accounts SET id = ?, username = ?, email = ? WHERE id = ?');
        $stmt->execute([$id, $username, $email, $_GET['id']]);
        $msg = 'Updated Successfully!, For the changes to take affect. Please Log Out and Log back in';
    
    
    }

    // Get the user from the user table
    $stmt = $pdo->prepare('SELECT * FROM accounts WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$user) {
        header('Location: price-list.php');
        exit('user doesn\'t exist with that ID!');
    }
} else {
    header('Location: index.php');
    exit('No ID specified!');
    
}
?>

<div class="container update">
	
    <form action="edit-user.php?id=<?=$user['id']?>" method="post">
    <a href="index">Home </a><br><a href="login">Reset Password</a><br><a href="registernewuser">Register a new user</a><br>
    <h2 class="p-b-1"><i style="font-size:1rem; color:darkgray;"class="fas fa-pencil-alt"></i> Edit Your Profile</h2><br>
    <p><?=$user['username']?></p><br>
    
    <div class="inputwrapper admin-wrapper hidden">
            <div class="input-prepend">
                <span class="input-prepend-text"><i class="fas fa-hashtag"></i></span>
            </div>
            <input class="text-input input" type="text" name="id" placeholder="26" value="<?=$user['id']?>" id="id" >
        </div>

    <label for="username">User Name:</label>
        <div class="inputwrapper admin-wrapper">
        
            <div class="input-prepend">
                <span class="input-prepend-text"><i class="far fa-user"></i></span>
            </div>
            
            <input class="text-input input" type="text" name="username" placeholder="Username" value="<?=$user['username']?>" id="username">
        </div>
        <label for="username">Email Address:</label>
        <div class="inputwrapper admin-wrapper">
            <div class="input-prepend">
                <span class="input-prepend-text"><i class="fas fa-at"></i></span>
            </div>
            <input class="text-input input" type="text" name="email" placeholder="email" value="<?=$user['email']?>" id="email">
        </div>

        <input type="submit" value="Save"><br>
        <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>

           



        </div>

   
       
   
   
   
   
   
   
       
   
   
   
       
    </form>
    
   
   
   
</div>

<?php include("footer-admin.inc.php");?>