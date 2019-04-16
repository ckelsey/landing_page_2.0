<?php include '../inc/config.php'; ?>
<?php include '../inc/template_start.php'; ?>
<?php include '../inc/page_head.php'; ?>

<section class="site-section site-section-light site-section-top themed-background-default">
    <div class="container">
        <h1 class="text-center animation-slideDown"><strong>Support</strong></h1>
        <h2 class="h3 text-center animation-slideUp">Create a Ticket</h2>
    </div>
</section>
<section class="site-content site-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-3 col-md-2 site-block">
                
            </div>
            <div class="col-sm-6 col-md-8 site-block">
                <h3 class="h3 site-heading"><strong>Submit a support ticket</strong> and we will get back to you soon.</h3>
                <form action="#" id="form-ticket">
                    <div class="form-group">
                        <label for="ticket-type">Create a Ticket</label>
                        <select id="ticket-type" name="ticket-type" class="form-control input-lg">
                            <option>Select a support category</option>
                            <option>Help with a Claim</option>
                            <option>Password Reset</option>
                            <option>Edit Account Details</option>
                            <option>Problems with Website</option>
                            <option>Other/Ask a Question</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="ticket-name">Name</label>
                        <input type="text" id="ticket-name" name="ticket-name" class="form-control input-lg" placeholder="Your name..">
                    </div>
                    <div class="form-group">
                        <label for="ticket-email">Email</label>
                        <input type="text" id="ticket-email" name="ticket-email" class="form-control input-lg" placeholder="Your email..">
                    </div>
                    <div class="form-group">
                        <label for="ticket-message">Message</label>
                        <textarea id="ticket-message" name="ticket-message" rows="10" class="form-control input-lg" placeholder="Let us know how we can assist.."></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-lg btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?php include '../inc/page_footer.php'; ?>
<?php include '../inc/template_scripts.php'; ?>
<script src="../js/pages/ticket.js"></script>
<script>$(function(){ Ticket.init(); });</script>
<?php include '../inc/template_end.php'; ?>