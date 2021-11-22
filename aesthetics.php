<!DOCTYPE html>
<html lang="en">

<head>
    <title>Lashes, Brows and Aesthetics: About Me</title>
    <meta name="description" content="About me, I love to transform your look with my amazing Treatments.">
    <?php include("php/nav.inc.php");
    include("php/connect.php") ?>

    <header>
        <section class="aestheticshero hero containerfw ">
            <div class="container herogrid">
                <h1 class="herotitle">Aesthetics</h1>
            </div>
        </section>
    </header>
<section class="container banner">
    <h1 class="bannertitle m-b-1">Title here for aesthics</h1>
    <p class="bannertext m-b-0">Subtitle here</p>
</section>
   



<section class="container p-top-0 p-bt-0 full-width">
    
        <div class="gridcontainer">
            <img class="seconditem img-fit" src="img/hybridlashes.jpg" alt="">
            <div class="p-1 firstitem textbox">
                <h2 class="mt-b-1 textbox-title">Aesthetics</h2>
                <p class="content mp-b-1 textbox-subtitle">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea, voluptate!</p>
                <p class="content mp-b-1 textbox-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur minus harum temporibus ullam assumenda pariatur quis odio error? Labore, quia!
</p>
                <ul class="fa-ul content">
                    <li><span class="fa-li"><i class="fas fa-check"></i></span>Lorem, ipsum dolor.</li>
                    <li><span class="fa-li"><i class="fas fa-check"></i></span>Lorem, ipsum dolor.</li>
                    <li><span class="fa-li"><i class="fas fa-check"></i></span>Lorem, ipsum dolor.</li>
                </ul>
            </div>
        </div>

    
</section>
<div class="container banner">
        <h2>Our Price List for Aesthetics</h2>
    </div>
<section class="pricelist container">
    
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
            
            
</section>

    <?php include("php/footer.inc.php"); ?>