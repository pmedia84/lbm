<!DOCTYPE html>
<html lang="en">

<head>
    <title>Lashes and Brows by Mandi : Contact Us</title>

    <?php include("php/nav.inc.php"); ?>

    <header>
        <section class="contacthero hero containerfw ">
            <div class="container herogrid">
                <h1 class="herotitle">Contact Me</h1>
            </div>
        </section>
    </header>
<section class="container banner">
    <h1 class="bannertitle m-b-1">Please feel free to get on touch with me</h1>
    <p class="bannertext m-b-0">I Love To Hear from you...</p>
</section>
    <section id="contact" class="contact container p-top-0">


        <div id="contactdiv">
            <!-- =========== -->
            <!-- custom styling for inputs -->
            <!-- =========== -->
            <!-- Prepend all inputs with an icon helper -->
            <form id="contactForm" action="contactscript.php" name="contactForm">

                
                    <div class="formrow">
                        <div class="formcolumn">
                            <div class="inputwrapper">
                                <!-- flex container -->
                                <div class="input-prepend">
                                    <!-- flex item -->
                                    <span class="input-prepend-text"><i class="fa fa-user-o"></i></span>
                                </div>
                                <!-- Flex Item -->
                                <input class="text-input input" type="text" id="name" placeholder="Your Name *" autocomplete="off" required="" maxlength="45"><small class="form-text text-danger flex-grow-1 help-block lead"></small>
                            </div>
                            <div class="inputwrapper">
                                <!-- flex container -->
                                <div class="input-prepend">
                                    <!-- Flex Item -->
                                    <span class="input-prepend-text"><i class="fa fa-envelope-o"></i></span>
                                </div>
                                <input class="email-input input" type="email" id="email" placeholder="Your Email *" autocomplete="off" required="" maxlength="75"><small class="form-text text-danger help-block lead"></small>
                            </div>
                            <div class="inputwrapper">
                                <!-- flex container -->
                                <div class="input-prepend">
                                    <!-- Flex Item -->
                                    <span class="input-prepend-text"><i class="fas fa-mobile-alt"></i></span>
                                </div>
                                <input class="text-input input" type="tel" id="phone" placeholder="Your Phone No. *" autocomplete="off" required="" maxlength="45"><small class="form-text text-danger help-block lead"></small>
                            </div>
                        </div>
                        <div class="formcolumn">
                            <textarea class="input textarea" id="message" placeholder="Your Message *" required="" spellcheck="true" autocomplete="off"></textarea><small class="form-text text-danger help-block lead"></small>
                        </div>
                    </div>

                    <div id="button-section">
                        <div class="formrow formsubmit">
                            <div class="formcolumn">
                                <!-- recaptcha -->
                                <div id="validation" class="g-recaptcha text-center" data-sitekey="6Lc1c4MbAAAAAAx3fQiavVV7ZXbbbxHnRZexFO9l"></div>
                                <div id="success"></div>
                                <div id="submit">
                                    <button class="btn" id="sendMessageButton" type="submit">Send Message</button>
                                </div>
                            </div>
                            <!-- success - for status messages -->
                        </div>
                    </div>
                
            </form>
        </div>








    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <script type="text/javascript">
        //set vars for checking status of recaptcha
        var recaptchaCheck = false;
        var recaptchaRequired = false;
        //function to load recaptcha
        function recaptchaLoad() {
            $.getScript("https://www.google.com/recaptcha/api.js").done(function(script, textStatus) {
                console.log(textStatus); // Success
                console.log("Load was performed.");
                recaptchaCheck = true;
                $(validation).css("margin-bottom", "1rem");
            });
        }
        //monitor user entering form
        $("#contactForm").click(function() {
            //check if recaptcha is already loaded
            if (recaptchaCheck == false) {
                //load recaptcha from function
                recaptchaLoad();
            }
        });
        //monitor entering information in form
        $("#contactForm").keydown(function() {
            //check if recaptcha is set to required
            if (recaptchaRequired == false) {
                //get dom element for recaptcha form field
                var $recaptcha = document.querySelector('#g-recaptcha-response');
                if ($recaptcha) {
                    //set recaptcha field to required
                    $recaptcha.setAttribute("required", "required");
                    console.log("required set");
                    recaptchaRequired = true;
                } else {
                    //log if recaptcha wasn't found and therefore not set as required
                    console.log("required not set");
                }
            }
        });
    </script>
    <script>
        (function($) {
            "use strict";
            //monitor clicks on form submit button
            $("#sendMessageButton").click(function() {
                //validate form information
                if ($('#name').val() != '' & $('#email').is(":valid") & $('#phone').val() != '' & $('#message').val() != '') {
                    //form information passed, check recaptcha
                    if ($('.g-recaptcha-response').val() == "") {
                        //update page with error, recaptcha not completed
                        var warningmsg = "<div id='response'>0</div><div class='error_message'>Please complete the captcha before submitting form!</div>";
                        document.getElementById('success').innerHTML = warningmsg;
                        $('#success').hide();
                        $('#success').slideDown('slow');
                    }
                } else {
                    //form information didn't pass validation
                    var warningmsg = "<div id='response'>0</div><div class='error_message'>Please verify your details in the form!</div>";
                    document.getElementById('success').innerHTML = warningmsg;
                    $('#success').hide();
                    $('#success').slideDown('slow');
                }
            });

            jQuery(document).ready(function() {
                //form submit
                $('#contactForm').submit(function() {
                    //get page to submit to
                    var action = $("#contactForm").attr('action');
                    //temporarily hide forms messages, recaptcha and button, proceed with ajax request
                    $("#button-section").slideUp(50, function() {
                        $('#button-section').hide();
                        //ajax request
                        $.post(action, {
                                //collect form fields to post
                                name: $('#name').val(),
                                email: $('#email').val(),
                                phone: $('#phone').val(),
                                message: $('#message').val(),
                                validation: $('.g-recaptcha-response').val()
                            },
                            //ajax complete
                            function(data) {
                                //set contact.php response to success element for user to read
                                document.getElementById('success').innerHTML = data;
                                //get status, 0 for error, 1 for pass
                                var responseType = document.getElementById('response').innerHTML;
                                if (responseType == 0 || responseType == "") {
                                    //response error, reset recaptcha and show section for messages, recaptcha and button
                                    $('.g-recaptcha-response').val("");
                                    grecaptcha.reset();
                                    $('#button-section').slideDown('slow');
                                } else {
                                    //response pass, hid recaptcha and button, show section for messages
                                    $('#validation').hide();
                                    $('#submit').hide();
                                    $('#button-section').slideDown('slow');
                                }
                            }
                        );

                    });

                    return false;

                });

            });
        }(jQuery));
    </script>

    <?php include("php/footer.inc.php"); ?>