<!DOCTYPE html>
<html lang="en">

<head>
    <title>Lashes, Brows and Aesthetics: About Me</title>
    <meta name="description" content="About me, I love to transform your look with my amazing Treatments.">
    <?php include("php/nav.inc.php");
    include("php/connect.php") ?>
<script id="timelyScript" src="//book.gettimely.com/widget/book-button-v1.5.js"></script>
    <header>
        <section class="aestheticshero hero containerfw ">
            <div class="container herogrid">
                <h1 class="herotitle">Aesthetics</h1>
            </div>
        </section>
    </header>
    <section class="container banner">
        <h1 class="bannertitle m-b-1">Outstanding Results With Aesthetics</h1>
        <p class="bannertext m-b-0">I am now fully trained and qualified and delighted to offer Aesthetics to all my clients</p>
    </section>




    <section class="container p-top-0 p-bt-0 full-width">

        <div class="gridcontainer">
            <img class="seconditem img-fit" src="img/dermal.jpg" alt="Dermal Filler Treatment from Lashes, Brows and Aesthetics">
            <div class="firstitem textbox">
                <h2 class="mt-b-1 textbox-title">Dermal Fillers</h2>
                <p class="content mp-b-1 textbox-subtitle">Gain immediate and visible results</p>
                <p class="content mp-b-1 textbox-text">Are a Hyaluronic Acid, which is found in the skin , in the eyes and joints, it’s mixed with other ingredients to make it into a gel.
                    It’s used to add plumpness and enhance the areas that loose elasticity as we get older. <br><br>Currently I’m offering Dermal Filler for the lips, Marionette lines (running from mouth to chin) and Nasolabial Lines (laughter lines running from the nose to the mouth)
                </p>

            </div>
        </div>


        <div class="gridcontainer">
            <img class="firstitem img-fit" src="img/anti-wrinkle.jpg" alt="Anti Wrinkle Treatments from Lashes, Brows and Aesthetics">
            <div class="seconditem textbox">
                <h2 class="mt-b-1 textbox-title">Anti Wrinkle Treatments</h2>
                <p class="content mp-b-1 textbox-subtitle">Dramatically reduce visible signs of aging, fine lines & wrinkles</p>
                <p class="content mp-b-1 textbox-text">This can last from 3 up to 12 months, depending on the area treated.
                    I currently offer up to 3 areas on the face (See Price List Below)

                </p>

            </div>
        </div>

        <div class="gridcontainer">
            <img class="seconditem img-fit" src="img/b12.jpg" alt="Dermal Filler Treatment from Lashes, Brows and Aesthetics">
            <div class="firstitem textbox">
                <h2 class="mt-b-1 textbox-title">Vitamin B12</h2>
                <p class="content mp-b-1 textbox-subtitle">Increases energy levels and concentration and many other benefits!</p>
                <p class="content mp-b-1 textbox-text">The benefits of this are endless, B12 helps with Fatigue, energy levels, boosts the immune system, aids sleep patterns, menopause, lack of iron, improves metabolism and can aid weight loss, these are just a few of what this wonderful vitamin can do.
                </p>

            </div>
        </div>

        <div class="gridcontainer">
            <img class="firstitem img-fit" src="img/skin-peel.jpg" alt="Skin Peel Treatments from Lashes, Brows and Aesthetics">
            <div class="seconditem textbox">
                <h2 class="mt-b-1 textbox-title">Skin Peel</h2>
                <p class="content mp-b-1 textbox-subtitle">Improve your skin tone</p>
                <p class="content mp-b-1 textbox-text">Tailored to your own skin type, they even out skin tone, lighten pigmented skin (age spots) acne, scarring, fine wrinkles and lines.
                    After the peel, your skin grows back, producing more collagen and elastin, so starting to diminish the signs of ageing.


                </p>

            </div>
        </div>

        <div class="gridcontainer">
            <img class="seconditem img-fit" src="img/micro-needling.jpg" alt="Micro Needling Treatments from Lashes, Brows and Aesthetics">
            <div class="firstitem textbox">
                <h2 class="mt-b-1 textbox-title">Micro Needling</h2>
                <p class="content mp-b-1 textbox-subtitle">Reduce the appearance of your skin straight away!</p>
                <p class="content mp-b-1 textbox-text">Also known as collagen induction therapy, it’s a treatment using a dermapen with a needle cartridge, this causes trauma to the skin, the process of healing starts straight away and renews the skin cells. As it repairs the skin produces collagen and elastin and this gives an immediate plumping effect.
                    Again the benefits to this are amazing, reducing the appearance of fine lines and wrinkles, keloid scarring, sun damage, ageing, shrinks large pores, reduces rosacea and improves acne.
                    The treatment continues to boost the appearance of your complexion, for months afterwards.
                    For maximum results and improvement, this treatment is better done in a course of at least one every four weeks for three months.

                </p>

            </div>
        </div>

        <div class="gridcontainer">
            <img class="firstitem img-fit" src="img/light-therapy.jpg" alt="Steam Induction and Light Therapy Treatments from Lashes, Brows and Aesthetics.">
            <div class="seconditem textbox">
                <h2 class="mt-b-1 textbox-title">Steam Induction and Light Therapy</h2>
                <p class="content mp-b-1 textbox-subtitle">Repair and rejuvinate your skin!</p>
                <p class="content mp-b-1 textbox-text">This can be done on its own as a facial or with the peel and microneedling. This innovative treatment uses a variety of colour wavelengths of visible light, which have their own specific benefit. The skin uses the light as an energy source to start to repair and rejuvenate itself, fixing damaged cells and getting rid of bacteria. The light energy also boosts circulation, tissue repair and the production of collagen and elastin. 
The benefits of a steam facial include extra cleansing, it promotes circulation, releases acne causing bacteria and cells, it releases trapped sebum, it’s hydrating, it helps your skin absorb skin care products, it promotes collagen and elastin and it’s very soothing.



                </p>

            </div>
        </div>
    </section>
    <div class="container banner p-bt-0">
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