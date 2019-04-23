<?php include '../inc/config.php'; ?>
<?php include '../inc/template_start.php'; ?>
<?php include '../inc/page_head.php'; ?>

<section class="site-section site-section-light site-section-top themed-background-default">
    <div class="container">
        <h1 class="text-center animation-slideDown"><i class="fa fa-envelope"></i> <strong>Contact Us</strong></h1>
        <h2 class="h3 text-center animation-slideUp">We will be happy to answer all your questions!</h2>
    </div>
</section>
<section class="site-content site-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-4 site-block">
                <div class="site-block">
                    <h3 class="h2 site-heading"><strong>Class Action</strong> Inc</h3>
                    <address>
                        2777 Alvarado Street, Suite E<br>
                        San Leandro, California<br>
                        94577<br><br>
                        <i class="fa fa-envelope-o"></i> <a href="mailto:support@classactioninc.com">support@classactioninc.com</a>
                    </address>
                </div>
                <div class="site-block">
                    <h3 class="h2 site-heading"><strong>About</strong> Us</h3>
                    <p class="remove-margin">
                    Clarence has gathered a small and passionate team of humans from across the globe! We all believe in restoring balance and getting consumers what they’re owed.
                    </p>
                </div>
            </div>
            <div class="col-sm-6 col-md-8 site-block" id="message">
                <h3 class="h2 site-heading"><strong>Contact</strong> Form</h3>
                <form action="#" id="form-contact">
                    <div class="form-group">
                        <label for="contact-name">Name</label>
                        <input type="text" id="contact-name" name="contact-name" class="form-control input-lg" placeholder="Your name..">
                    </div>
                    <div class="form-group">
                        <label for="contact-email">Email</label>
                        <input type="text" id="contact-email" name="contact-email" class="form-control input-lg" placeholder="Your email..">
                    </div>
                    <div class="form-group">
                        <label for="contact-message">Message</label>
                        <textarea id="contact-message" name="contact-message" rows="10" class="form-control input-lg" placeholder="Let us know how we can assist.."></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-lg btn-primary">Send Message</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?php include '../inc/page_footer.php'; ?>
<?php include '../inc/template_scripts.php'; ?>
<script src="../js/pages/contact.js"></script>
<script>$(function(){ Contact.init(); });</script>
<?php include '../inc/template_end.php'; ?>