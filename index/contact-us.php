<?php 

// Declare the global array
global $contact_info;

$sql = "SELECT * FROM contact_info";
$result = mysqli_query($conn, $sql);

// Fetch the data and store it in the global array
if ($result) {
    $contact_info = mysqli_fetch_assoc($result);
} else {
    // Handle the error if query fails
    $contact_info = [];
}

// Now, $contact_info is available globally
?>

<section class="contact-us  " style="background-color: #F6F7FC; color:#1B1B1E" id="contact">
        <div class="container">
            <!-- Desktop/Laptop View -->
            <div class="row d-flex justify-content-between align-items-start desktop-version d-none d-sm-none d-md-none d-lg-flex "
                style="display: flex;">

                <!-- First Column: Text Section -->
                <div class="col-md-6 contact-info">
                    <h3 class="contact-title">Contact Us</h3>
                    <p class="contact-description pt-2" style="display: inline;color:#666;">
                        Email, call, or complete the form to learn <br> how
                    <h5 style="display: inline;"><span class="color-hi-tech">Hi</span><span
                            class="color-sky">Sky</span><span class="color-hi-tech">Tech</span></h5> <p style="color:#666;display: inline;">can elevate.</p>
                    </p>
              <p class="contact-email pt-2">
    <a href="mailto:<?=$contact_info['email']?>" style="color: #666;"><?=$contact_info['email']?></a>
</p>

                    <p class="contact-phone pt-2"><?= $contact_info['number']?></p>

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
                                Interested in our training programs? Contact us at <a href="mailto:<?= $contact_info['courses_email']?>" style="color: #666;"><?= $contact_info['courses_email']?></a> for more
                                details.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Second Column: Form Section -->
                <div class="col-md-6 contact-form-container">
                <form id="contactForm" class="contact-form mx-5" style="width: 430px; height: auto;" method="POST">
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
            <input type="email" name="email" class="form-control custom-input" placeholder="&#xf0e0; Your Email" required>
        </div>
        <div class="mb-2">
            <input type="tel" name="phone_number" class="form-control custom-input" placeholder="&#xf095; Phone Number" required>
        </div>
        <div class="mb-3">
            <textarea name="message" class="form-control custom-textarea" placeholder="How Can I Help You?" required></textarea>
        </div>
        <div class="response"></div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>
<div class="response"></div> 


                </div>
            </div>

            <!-- Mobile/Tablet View -->
            <!-- Mobile/Tablet View -->
            <div class="row d-flex align-items-start mobile-version d-lg-none" style="display: none;" id="contact">
                <!-- First Div -->
                <div class="col-12 contact-info" style="
        width: 289px;
       
        gap: 24px;
    ">
                    <h3 style="
      font-family: Roboto, sans-serif;
      font-size: 24px;
      font-weight: bold;
      margin-bottom: 16px;
      color:#1B1B1E !important;
  ">Contact Us</h3>
                    <p style="
font-family: Roboto, sans-serif;
font-size: 16px;
font-weight: 400;
line-height: 24px;
margin-top: 8px;
width: 289px;
color:#666;
">
                        Email, call, or complete the form to learn how
                        <span style="
    font-family: Roboto, sans-serif;
    font-size: 16px;
    font-weight: 500;
    display: inline;
    margin: 0;
">
                            <span style="color: #0056b3">Hi</span>
                            <span style="color: rgb(55, 182, 191);">Sky</span>
                            <span style="color: #0056b3">Tech</span>
                        </span>
                        can elevate.
                    </p>

                    <p style="
      font-family: Roboto, sans-serif;
      font-size: 16px;
      font-weight: 500;
      margin-bottom: 8px;
  "><a href="mailto:<?=$contact_info['email']?>" style="color: #666;"><?=$contact_info['email']?></a></p>
                    <p style="
      font-family: Roboto, sans-serif;
      font-size: 16px;
      font-weight: 500;
      margin-bottom: 8px;
  "><?= $contact_info['number']?></p>
                    <h5 class=" custom-heading" style="font-size: 16px;">Customer Support</h5>
                    <div style="
      display: flex;
      flex-wrap: wrap;
      width: 289px;
      gap: 16px;
  ">
                        <div style="
          flex: 1;
          min-width: 50%;
      ">
                            <h6 style="
              font-family: Roboto, sans-serif;
              font-size: 20px;
              font-weight: 700;
              margin-bottom: 8px;
          ">Customer Support</h6>
                            <p style="
              font-family: Roboto, sans-serif;
              font-size: 16px;
              font-weight: 400;
              color: #666;
          ">
                                Our support team is available <br>
                                24/7 to address any concerns <br>
                                or queries you may have about <br> our services or courses.
                            </p>
                        </div>
                        <div style="
          flex: 1;
          min-width: 50%;
      ">
                            <h6 style="
              font-family: Roboto, sans-serif;
              font-size: 20px;
              font-weight: 700;
              margin-bottom: 8px;
          ">Training and Course Inquiries</h6>
                            <p style="
              font-family: Roboto, sans-serif;
              font-size: 16px;
              font-weight: 400;
              color: #666;
          ">
                                Interested in our training programs? <br>
                                Contact us at <a href="mailto:<?=$contact_info['courses_email']?>" style="color: #666;"><?=$contact_info['courses_email']?></a> <br>
                                for more details.
                            </p>
                        </div>
                    </div>

                </div>

                <!-- Second Div -->
                <div class="col-12 contact-form-container" style="
    
   
    gap: 0;
    border-radius: 8px ;
    background-color: #f9f9f9;
    padding: 16px;
">
                    <form class="contact-form" style="width: 100%; padding: 16px;">
    <h4 class="form-title" style="font-family: Roboto, sans-serif; font-size: 17px; font-weight: 700; line-height: 22px; letter-spacing: 0.38px; text-align: left; text-underline-position: from-font; text-decoration-skip-ink: none; margin-bottom: 8px;">Get in Touch</h4>
    <p class="form-description" style="font-family: Roboto, sans-serif; font-size: 15px; font-weight: 400; line-height: 18px; letter-spacing: 0.38px; text-underline-position: from-font; text-decoration-skip-ink: none; margin-bottom: 16px;">You can reach us anytime.</p>
    <div>
        <div class="form-row" style="display: flex; gap: 16px;">
            <div class="mb-2" style="flex: 1;">
                <input type="text" name="first_name" class="form-control" placeholder="First Name" required style="font-family: Roboto, sans-serif; font-size: 15px; font-weight: 400; line-height: 20px; letter-spacing: 0.38px; text-underline-position: from-font; text-decoration-skip-ink: none; width: 100%; height: 40px; border: 1px solid #ccc; border-radius: 4px;">
            </div>
            <div class="mb-2" style="flex: 1;">
                <input type="text" name="last_name" class="form-control" placeholder="Last Name" required style="font-family: Roboto, sans-serif; font-size: 15px; font-weight: 400; line-height: 20px; letter-spacing: 0.38px; text-underline-position: from-font; text-decoration-skip-ink: none; width: 100%; height: 40px; border: 1px solid #ccc; border-radius: 4px;">
            </div>
        </div>

        <div class="mb-2">
            <input type="email" name="email" class="form-control" placeholder="Your Email" required style="font-family: Roboto, sans-serif; font-size: 15px; font-weight: 400; line-height: 20px; letter-spacing: 0.38px; text-underline-position: from-font; text-decoration-skip-ink: none; width: 100%; height: 40px; border: 1px solid #ccc; border-radius: 4px;">
        </div>
        <div class="mb-2">
            <input type="tel" name="phone_number" class="form-control" placeholder="Phone Number" required style="font-family: Roboto, sans-serif; font-size: 15px; font-weight: 400; line-height: 20px; letter-spacing: 0.38px; text-underline-position: from-font; text-decoration-skip-ink: none; width: 100%; height: 40px; border: 1px solid #ccc; border-radius: 4px;">
        </div>
        <div class="mb-3">
            <textarea name="message" class="form-control" placeholder="How Can I Help You?" required style="font-family: Roboto, sans-serif; font-size: 15px; font-weight: 400; line-height: 20px; letter-spacing: 0.38px; text-underline-position: from-font; text-decoration-skip-ink: none; width: 100%; height: 80px; border: 1px solid #ccc; border-radius: 4px;"></textarea>
        </div>
        <div class="response"></div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary" style="width: 311px; height: 40px; padding: 8px 10px; gap: 10px; border-radius: 8px; opacity: 1; background-color: #0A3A8F; color: #fff; border: none;">Submit</button>
        </div>
    </div>
</form>

                </div>

            </div>

        </div>
    </section>
