<!DOCTYPE html>
<html lang="en">

<head>
    <title>Lashes, Brows and Aesthetics: Price List</title>
    <meta name="description" content="My Price List">
    <?php include("php/nav.inc.php"); ?>
    
    <header>
        <section class="pricehero hero containerfw ">
            <div class="container herogrid">
                <h1 class="herotitle">Price List</h1>
                <p class="herotext">These are my current prices.</p>
            </div>
        </section>
    </header>


    <div class="container">
        <div class="banner p-bt-1">
            <h1 class="bannertitle">Price List</h1>
            <h3 class="bannersubtitle">These are my most popular treatments</h3>
            <p class="bannertext">If there is something you want and it is not shown here, please contact me to discuss your requirements</p>
        </div>

        <section class="pricelist">
        <script id="timelyScript" src="//book.gettimely.com/widget/book-button-v1.5.js"></script>
        <?php 
    $db = new mysqli("localhost", "lashesbr_admin", "LBA_2021!", "lashesbr_price_list",);


    $query = "SELECT id, name, description, subtitle, price, button FROM product ORDER BY id";
    $result = $db->query($query);
    while ($row = $result->fetch_assoc()) {
        $id = $row['id'];
        $name = $row['name'];
        $description = $row['description'];
        $price = $row['price'];
        $subtitle = $row['subtitle'];
        $button = $row['button'];
        echo "
        
        
        <div class='pricecard'>
                <div class='pricecard-title'>
                    <h1>$name</h1>
                </div>
                <div class='pricecard-body'>
                    <h1 class='pricecard-price'>£$price</h1>
                    <p class='pricecard-price-subtitle'>$subtitle</p>
                    <p class='pricecard-text'>$description</p>
                    <p class='pricecard-text'>$button</p>
                </div>
            </div>
        
        
        
        
        \n";
    }

    

    ?>
        
     
           

        </section>
    </div>
    <div class="container">
        <div class="banner p-bt-1">
           
            
            <p class="bannertext mt-b-1">Infills to be done within 3 weeks of having a full set and over 50% of lashes remaining</p>
            <p class="bannertext">A £25 non refundable booking fee, is taken on the day of your patch test, but it is taken off the cost on the day of your treatment.</p>
        </div>
    </div>
    <?php include("php/footer.inc.php"); ?>