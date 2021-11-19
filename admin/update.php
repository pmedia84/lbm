<?php include("nav-admin.inc.php");?>

<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the product id exists, for example update.php?id=1 will get the product with the id of 1
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $description = isset($_POST['description']) ? $_POST['description'] : '';
        $subtitle = isset($_POST['subtitle']) ? $_POST['subtitle'] : '';
        $price = isset($_POST['price']) ? $_POST['price'] : '';
        $button = isset($_POST['button']) ? $_POST['button'] : '';
        // Update the record
        $stmt = $pdo->prepare('UPDATE product SET id = ?, name = ?, description = ?, subtitle = ?, price = ?, button = ? WHERE id = ?');
        $stmt->execute([$id, $name, $description, $subtitle, $price, $button, $_GET['id']]);
        $msg = 'Updated Successfully!';
    
    
    }

    // Get the product from the product table
    $stmt = $pdo->prepare('SELECT * FROM product WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$product) {
        header('Location: price-list.php');
        exit('product doesn\'t exist with that ID!');
    }
} else {
    header('Location: index.php');
    exit('No ID specified!');
    
}
?>

<div class="container update">
	
    <form action="update.php?id=<?=$product['id']?>" method="post">
    <h2 class="p-b-1">Update Product #<?=$product['id']?></h2><br>
    <p><?=$product['name']?></p><br>
    
        <div class="inputwrapper admin-wrapper hidden">
            <div class="input-prepend">
                <span class="input-prepend-text"><i class="fas fa-hashtag"></i></span>
            </div>
            <input class="text-input input" type="text" name="id" placeholder="26" value="<?=$product['id']?>" id="id" >
        </div>


        <div class="inputwrapper admin-wrapper">
            <div class="input-prepend">
                <span class="input-prepend-text"><i class="fas fa-tag"></i></span>
            </div>

            <input class="text-input input" type="text" name="name" placeholder="Product Name" value="<?=$product['name']?>" id="name">
        </div>
        <div class="inputwrapper admin-wrapper">
            <div class="input-prepend">
                <span class="input-prepend-text"><i class="fas fa-scroll"></i></span>
            </div>
            <input class="text-input input" type="text" name="subtitle" placeholder="Subtitle" value="<?=$product['subtitle']?>" id="phone">
        </div>
        

        

        <div class="inputwrapper admin-wrapper">
            <div class="input-prepend">
                <span class="input-prepend-text"><i class="fas fa-pound-sign"></i></span>
            </div>
            <input class="text-input input" type="text" name="price" placeholder="Price" value="<?=$product['price']?>" id="title">
        </div>
        <div class="inputwrapper admin-wrapper">
            <div class="input-prepend textareapre">
                <span class="input-prepend-text"><i class="fas fa-code"></i></span>
            </div>
            <textarea class="input textarea" type="text" name="button" placeholder="Copy Button Script Here" value=""id="button"><?=$product['button'] = htmlentities($product['button'],ENT_QUOTES)?></textarea>
        </div>
        
        
        <div class="inputwrapper admin-wrapper">

        <div class="input-prepend textareapre">
                <span class="input-prepend-text"><i class="fas fa-file-word"></i></span>
            </div>
            <textarea class="input textarea" id="description" placeholder="Enter Product Description Here *"  spellcheck="true" autocomplete="off"><?=$product['description']?></textarea>
        </div>
   
   
        <input type="submit" value="Update">
   
   
   
   
   
   
       
   
   
   
        <?php include("product-navigation.inc.php");?>
    </form>
    
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
   
   
</div>

<?php include("footer-admin.inc.php");?>