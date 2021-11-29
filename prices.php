<!DOCTYPE html>
<html lang="en">

<head>
    <title>Lashes, Brows and Aesthetics: Price List</title>
    <meta name="description" content="My Price List">
    <?php include("php/nav.inc.php"); ?>
    <script id="timelyScript" src="//book.gettimely.com/widget/book-button-v1.5.js"></script>
    <header>
        <section class="pricehero hero containerfw ">
            <div class="container herogrid">
                <h1 class="herotitle">Price List</h1>
                <p class="herotext">These are my current prices.</p>
            </div>
        </section>
    </header>


    <div class="container p-bt-0">
        <div class="banner p-bt-0">
            <h1 class="bannertitle">Price List</h1>
            <h3 class="bannersubtitle">These are my most popular treatments</h3>
            <p class="bannertext">If there is something you would like and it is not shown here, please contact me to discuss your requirements</p>
        </div>


    </div>







    <script id="timelyScript" src="//book.gettimely.com/widget/book-button-v1.5.js"></script>
    <?php

    include("php/connect.php")
    ?>

    <div class="container">
        <!-- Tab links -->
        <div class="tab">
            <button class="tablinks" onclick="openCity(event, 'lashes')" id="defaultOpen">Lashes</button>
            <button class="tablinks" onclick="openCity(event, 'brows')">Brows</button>
            <button class="tablinks" onclick="openCity(event, 'aesthetics')">Aesthetics</button>
            <button class="tablinks" onclick="openCity(event, 'other')">Other</button>
        </div>
        <!-- Tab content -->
        <div id="lashes" class="tabcontent pricelist">


            <div class="pricelist">
                <?php




                $query = "SELECT id, name, description, subtitle, price, button, category FROM product where category ='lashes'  ORDER BY id";
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
                        <p>$name</p>
                    </div>
                    <div class='pricecard-body'>
                        <p class='pricecard-price'>£$price</p>
                        <p class='pricecard-price-subtitle'>$subtitle</p>
                        <p class='pricecard-text'>$description</p>
                        <p class='pricecard-text'>$button</p>
                    </div>
                </div>
            
            
            
            
            \n";
                }



                ?>


            </div>

            <p class="bannertext mt-b-1">Infills to be done within 3 weeks of having a full set and over 50% of lashes remaining</p>
            <p class="bannertext">A £25 non refundable booking fee, is taken on the day of your patch test, but it is taken off the cost on the day of your treatment.</p>
        </div>

        <div id="brows" class="tabcontent">
            <div class="pricelist">

                <?php




                $query = "SELECT id, name, description, subtitle, price, button, category FROM product where category ='brows'  ORDER BY id";
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
            <p>$name</p>
        </div>
        <div class='pricecard-body'>
            <p class='pricecard-price'>£$price</p>
            <p class='pricecard-price-subtitle'>$subtitle</p>
            <p class='pricecard-text'>$description</p>
            <p class='pricecard-text'>$button</p>
        </div>
    </div>
        
        
        
        
        \n";
                }



                ?>




            </div>
        </div>

        <div id="other" class="tabcontent pricelist">
            <div class="pricelist">

                <?php
                 $query = "SELECT id, name, description, subtitle, price, button, category FROM product where category ='other'  ORDER BY id";
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
                <p>$name</p>
            </div>
            <div class='pricecard-body'>
                <p class='pricecard-price'>£$price</p>
                <p class='pricecard-price-subtitle'>$subtitle</p>
                <p class='pricecard-text'>$description</p>
                <p class='pricecard-text'>$button</p>
            </div>
        </div>
        
        
        
        
            \n";
                }

                ?>


            </div>



        </div>

           <div id="aesthetics" class="tabcontent pricelist">
            <div class="pricelist">

                <?php





                $query = "SELECT id, name, description, subtitle, price, button, category FROM product where category ='aesthetics'  ORDER BY id";
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
                <p>$name</p>
            </div>
            <div class='pricecard-body'>
                <p class='pricecard-price'>£$price</p>
                <p class='pricecard-price-subtitle'>$subtitle</p>
                <p class='pricecard-text'>$description</p>
                <p class='pricecard-text'>$button</p>
            </div>
        </div>
        
        
        
        
            \n";
                }

                ?>


            </div>



        </div>
    </div>




    <script src="js/tabs.js"></script>



    <?php include("php/footer.inc.php"); ?>