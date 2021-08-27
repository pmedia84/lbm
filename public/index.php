<!DOCTYPE html>
<html lang="en">

<head>
    <title>Lashes and Brows by Mandi</title>
    <?php include("php/nav.inc.php"); ?>



    <header>
        <section class="hero containerfw">
            <div class="container herogrid">
                <h2 class="herotitle">Eyelash Extensions</h2>
                <p class="herotext">Semi Permanent Eyelash Extensions Offering Beautiful Handmade Russian Volume and Classic Style Individual Lash Extensions.</p>

                <a href="#" class="btn herobtn">Find Out More</a>
            </div>
        </section>
    </header>
        <main>
        <section class="container">
            <div class="banner">
                <h1 class="bannertitle m-b-1">Professional Eyelash Extensions</h1>
                <h3 class="bannersubtitle m-b-1">I Love making you look and feel amazing...</h3>
                <p class="bannertext m-b-1">Transform your Eyelashes to be fuller, longer and curlier for a sensational look...</p>
            </div>

            <div class="cardcontainer">
                <div class="card">
                    <img src="img/lash-extensions.jpg" alt="" class="card-img">
                    <div class="cardtext">
                        <h3 class="card-title">Lashes</h3>
                        <p class="card-text">Lorem ipsum dolor sit amet..</p>
                    </div>
                </div>
                <div class="card">
                    <img src="img/eyebrows.jpg" alt="" class="card-img">
                    <div class="cardtext">
                        <h3 class="card-title">Brows</h3>
                        <p class="card-text">Lorem ipsum dolor sit amet...</p>
                    </div>
                </div>
                <div class="card">
                    <img src="img/skincare.jpg" alt="" class="card-img">
                    <div class="cardtext">
                        <h3 class="card-title">Dermaplaning</h3>
                        <p class="card-text">Lorem ipsum dolor sit amet..</p>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="banner container p-top-0">
                <h1 class="bannertitle m-b-0">About Me</h1>
            </div>
            <div class="containerfw pinkbg">
                <div class="container">
                    <div class="staff-container">
                        <img class="staff-img" src="img/staff1.jpg" alt="image of Mandi Saville">
                        <div class="staff-details">
                            <h1 class="staff-name">Mandi Saville</h1>
                            <p class="staff-jobtitle">Business Owner</p>
                            <p class="staff-text">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Esse, et dolorem odio veniam temporibus maxime quod officia dolore expedita quisquam!</p>
                            
                        </div>
                        <div class="social staff-social">
                        <?php include("php/socials.inc.php"); ?>
                        </div>
                    </div>
                </div>
            </div>

        </section>

        <section>
        <div class="container banner p-top-1">
            <h1 class="bannertitle m-b-0">Some of my work...</h1>
        </div>
        
            <?php include("php/mosaic.inc.php"); ?>
        </section>


        <section class="container">
            <div class="banner p-bt-1">
                <h1 class="bannertitle">Testimonials</h1>
            </div>

            <?php include("php/testimonials.inc.php");?>

        </section>

    </main>

    <?php include("php/footer.inc.php"); ?>