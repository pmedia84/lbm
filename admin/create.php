

<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, we must check if the POST variables exist if not we can default them to blank
    $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $category = isset($_POST['category']) ? $_POST['category'] : '';
    $description = isset($_POST['description']) ? $_POST['description'] : '';
    $subtitle = isset($_POST['subtitle']) ? $_POST['subtitle'] : '';
    $price = isset($_POST['price']) ? $_POST['price'] : '';
    $button = isset($_POST['button']) ? $_POST['button'] : '';
    

    // Insert new record into the product table
    $stmt = $pdo->prepare('INSERT INTO product VALUES (?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute([$id, $name, $category, $description, $subtitle, $price, $button]);
    // Output message
    $msg = 'Created Successfully!';
    header('Location: price-list.php');
}
?>
<?php include("nav-admin.inc.php"); ?>
<div class="container update">
    
    <form action="create.php" method="post">
    <h2 class="p-bt-1">Create New Product</h2>
        <div class="inputwrapper admin-wrapper hidden">
            <div class="input-prepend">
                <span class="input-prepend-text"><i class="fas fa-hashtag"></i></span>
            </div>
            <input class="text-input input" type="text" name="id" placeholder="26" value="# (Auto)" id="id" disabled>
        </div>


        <div class="inputwrapper admin-wrapper">
            <div class="input-prepend">
                <span class="input-prepend-text"><i class="fas fa-tag"></i></span>
            </div>

            <input class="text-input input" type="text" name="name" placeholder="Product Name" id="name">
        </div>
        <div class="inputwrapper admin-wrapper">
            <div class="input-prepend">
                <span class="input-prepend-text"><i class="fas fa-scroll"></i></span>
            </div>
            <input class="text-input input" type="text" name="subtitle" placeholder="Subtitle" id="phone">
        </div>
        

        

        <div class="inputwrapper admin-wrapper">
            <div class="input-prepend">
                <span class="input-prepend-text"><i class="fas fa-pound-sign"></i></span>
            </div>
            <input class="text-input input" type="text" name="price" placeholder="Price" id="title">
        </div>
        <div class="inputwrapper admin-wrapper">
            <div class="input-prepend textareapre">
                <span class="input-prepend-text"><i class="fas fa-code"></i></span>
            </div>
            <textarea class="input textarea" type="text" name="button" placeholder="Copy Button Script Here" value=""id="button"></textarea>
        </div>
        <div class="inputwrapper admin-wrapper">

<div class="input-prepend textareapre">
        <span class="input-prepend-text"><i class="fas fa-file-word"></i></span>
    </div>
    <textarea class="input textarea" id="description" placeholder="Enter Product Description Here *"  spellcheck="true" autocomplete="off"></textarea>
</div>
<p>Product Category</p>
        <div class="select-form-wrapper">
            <select class="form-select" name="category" id="">
              
                <?php
            //db connection
            $query = $pdo->query('SELECT id, name from product_category order by id');
            
            // Loop through the query results, outputing the options one by one
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='" . $row['name'] ."'>" . $row['name'] ."</option>";
            
            }
            
            
            
            ?>
            </select>
        </div>
        <input type="submit" value="Create">
    </form>
    <?php if ($msg) : ?>
        <p><?= $msg ?></p>
    <?php endif; ?>
</div>

<?php include("footer-admin.inc.php");
