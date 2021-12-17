<?php include("nav-admin.inc.php");?>

<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the business id exists, for example edit-business-details.php?id=1 will get the product with the id of 1
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
       
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $business_name = isset($_POST['business_name']) ? $_POST['business_name'] : '';
        $tel_num = isset($_POST['tel_num']) ? $_POST['tel_num'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $address = isset($_POST['address']) ? $_POST['address'] : '';
        $postcode = isset($_POST['postcode']) ? $_POST['postcode'] : '';

        // Update the record
        $stmt = $pdo->prepare('UPDATE details SET id = ?, business_name = ?, tel_num = ?, email = ?, address = ?, postcode = ? WHERE id = ?');
        $stmt->execute([$id, $business_name, $tel_num, $email, $address, $postcode, $_GET['id']]);
        $msg = 'Updated Successfully!';
    
    
    }

    // Get the business details from the user table
    $stmt = $pdo->prepare('SELECT * FROM details WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $details = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$details) {
        header('Location: index.php');
        exit('user doesn\'t exist with that ID!');
    }
} else {
    header('Location: index.php');
    exit('No ID specified!');
    
}
?>

<div class="container update">
	
    <form action="edit-business-details.php?id=<?=$details['id']?>" method="post">
    <a href="index">Home </a><br>
    <h2 class="p-b-1"><i style="font-size:1rem; color:darkgray;"class="fas fa-pencil-alt"></i> Edit Your Business Details</h2><br>
    <p><?=$details['business_name']?></p><br>
    
    <div class="inputwrapper admin-wrapper hidden">
            <div class="input-prepend">
                <span class="input-prepend-text"><i class="fas fa-hashtag"></i></span>
            </div>
            <input class="text-input input" type="text" name="id" placeholder="26" value="<?=$details['id']?>" id="id" >
        </div>

    <label for="business_name">Business Name:</label>
        <div class="inputwrapper admin-wrapper">
        
            <div class="input-prepend">
                <span class="input-prepend-text"><i class="fas fa-building"></i></span>
            </div>
            
            <input class="text-input input" type="text" name="business_name" placeholder="business_name" value="<?=$details['business_name']?>" id="business_name">
        </div>

        <label for="address">Address:</label>
        <div class="inputwrapper admin-wrapper">

<div class="input-prepend textareapre">
        <span class="input-prepend-text"><i class="fas fa-map-marker-alt"></i></i></span>
    </div>
    <textarea class="input textarea" id="address" placeholder="Address *"  spellcheck="true" autocomplete="off" name="address"><?=$details['address']?></textarea>
</div>

<label for="business_name">Post Code:</label>
        <div class="inputwrapper admin-wrapper">
            <div class="input-prepend">
                <span class="input-prepend-text"><i class="fas fa-map-pin"></i></span>
            </div>
            <input class="text-input input" type="text" name="postcode" placeholder="Post Code" value="<?=$details['postcode']?>" id="postcode">
           
        </div>

        <label for="business_name">Email Address:</label>
        <div class="inputwrapper admin-wrapper">
            <div class="input-prepend">
                <span class="input-prepend-text"><i class="fas fa-at"></i></span>
            </div>
            <input class="text-input input" type="text" name="email" placeholder="email" value="<?=$details['email']?>" id="email">
        </div>

        <label for="business_name">Phone Number:</label>
        <div class="inputwrapper admin-wrapper">
            <div class="input-prepend">
                <span class="input-prepend-text"><i class="fas fa-phone"></i></span>
            </div>
            <input class="text-input input" type="text" name="tel_num" placeholder="tel_num" value="<?=$details['tel_num']?>" id="tel_num">
        </div>

        <input type="submit" value="Save"><br>
        <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>

           



        </div>

   
       
   
   
   
   
   
   
       
   
   
   
       
    </form>
    
   
   
   
</div>

<?php include("footer-admin.inc.php");?>