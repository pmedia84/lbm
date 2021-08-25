<!DOCTYPE html>
<html lang="en">

<head>
    <title>Lashes and Brows by Mandi</title>
    <?php include("php/nav.inc.php"); ?>



    <main>
        <section class="hero containerfw">
            <div class="container herogrid">
                <h2 class="herotitle">Eyelash Extensions</h2>
                <p class="herotext">Semi Permanent Eyelash Extensions Offering Beautiful Handmade Russian Volume and Classic Style Individual Lash Extensions.</p>

                <a href="#" class="btn herobtn">Find Out More</a>
            </div>
        </section>

        <section class="container">
            <div class="banner">
                <h1 class="bannertitle">Professional Eyelash Extensions</h1>
                <h3 class="bannersubtitle">I Love making you look and feel amazing...</h3>
                <p class="bannertext">Transform your Eyelashes to be fuller, longer and curlier for a sensational look...</p>
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
            <div class="banner">
                <h1 class="bannertitle">About Me</h1>
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
        <div class="banner">
            <h1 class="bannertitle">Some of my work...</h1>
        </div>
        <section class="mosaic">
            <?php include("php/mosaic.inc.php"); ?>
        </section>
    </main>

    <?php include("php/footer.inc.php"); ?>