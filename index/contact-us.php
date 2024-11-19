  <section class="contact py-5" style="background-color: #F6F7FC;">
        <div class="container">
            <div class="row d-flex align-items-start">
            <?php
    if(!empty($msg)){
        echo $msg;
    }
    ?>
                <!-- First Column: Text Section -->
                <div class="col-md-6 contact-info">
                    <h3 class="contact-title">Contact Us</h3>
                    <p class="contact-description pt-2" style="display: inline; ">
                        Email, call, or complete the form to learn <br> how
                    <h5 style="display: inline;"><span class="color-hi-tech">Hi</span><span
                            class="color-sky">Sky</span><span class="color-hi-tech">Tech</span></h5> can elevate.
                    </p>
                    <p class="contact-email pt-2">contact@hiskytech.com</p>
                    <p class="contact-phone pt-2">+92 318 6362759</p>

                    <h5 class="support-heading custom-heading">Customer Support</h5>
                    <div class="row g-0 mt-2">
                        <div class="col-md-6">
                            <h6 class="support-title">Customer Support</h6>
                            <p class="support-description">
                                Our support team is available 24/7 to address any concerns or queries you may have about
                                our services or courses.
                            </p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="inquiries-title">Training and Course Inquiries</h6>
                            <p class="inquiries-description">
                                Interested in our training programs? Contact us at courses@hiskytech.com for more
                                details.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Second Column: Form Section -->
                <div class="col-md-6 contact-form-container">
                    <form id="contactForm" class="contact-form mx-5" style="width: 430px; height: auto;" method="POST" >
                        <h4 class="form-title">Get in Touch</h4>
                        <p class="form-description">You can reach us anytime.</p>
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <input type="text" name="first_name" class="form-control custom-input1" placeholder="First Name" required>
                            </div>
                            <div class="col-md-6 mb-2">
                                <input type="text" name="last_name" class="form-control custom-input1" placeholder="Last Name" required>
                            </div>
                            <div class="mb-2">
                                <input type="email" name="email" class="form-control custom-input" placeholder="Your Email" required>
                            </div>
                            <div class="mb-2">
                                <input type="tel" name="phone" class="form-control custom-input" placeholder="Phone Number" required>
                            </div>
                            <div class="mb-3">
                                <textarea name="message" class="form-control custom-textarea" placeholder="How Can I Help You?" required></textarea>
                            </div>
                            <div id="responseMessage"></div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </section>