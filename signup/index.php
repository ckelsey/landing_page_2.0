<?php 
include '../inc/config.php'; 

$queryStr = parse_url($_SERVER["REQUEST_URI"], PHP_URL_QUERY);
$email = isset($queryStr) ? base64_decode($queryStr) : '';
?>
<?php include ROOT . '/template_start.php'; ?>
<?php include ROOT . '/page_head.php'; ?>

<section class="site-section site-section-light site-section-top themed-background-default">
    <div class="container">
        <h1 class="text-center animation-slideDown"><i class="fa fa-plus"></i> <strong>Sign Up</strong></h1>
        <h2 class="h3 text-center animation-slideUp">Start filing your claims in just a few seconds!</h2>
    </div>
</section>
<section class="site-content site-section">
    <div class="container">
        <div class="row pt30 pb60">
            <div class="col-sm-6 col-sm-offset-3 col-lg-4 col-lg-offset-4 site-block">
                <form id="form-sign-up" class="form-horizontal">
                    <div class="form-group">
                        <div class="col-xs-12 col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="gi gi-user"></i></span>
                                <input type="text" id="register-firstname" name="register-firstname" class="form-control input-lg" placeholder="First name">
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="gi gi-user"></i></span>
                                <input type="text" id="register-lastname" name="register-lastname" class="form-control input-lg" placeholder="Last name">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="gi gi-envelope"></i></span>
                                <input type="email" id="register-email" name="register-email" class="form-control input-lg" placeholder="Email" value="<?= $email ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="gi gi-asterisk"></i></span>
                                <input type="password" id="register-password" name="register-password" class="form-control input-lg" placeholder="Password">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="gi gi-asterisk"></i></span>
                                <input type="password" id="register-password-verify" name="register-password-verify" class="form-control input-lg" placeholder="Verify Password">
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-actions">
                        <div class="col-xs-6">
                            <label class="switch switch-primary" data-toggle="tooltip" title="Agree to the terms">
                                <input type="checkbox" id="register-terms" name="register-terms"><span></span>
                            </label>
                            <a href="#" id="signup-terms" class="register-terms"><small> View Terms</small></a>
                        </div>
                        <div class="col-xs-6 text-right">
                            <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Sign Up</button>
                        </div>
                    </div>
                </form>
                <div class="text-theme-dark-navy mt40">
                    Already have an account?
                    <a href="/login/?<?= $queryStr ?>"><strong> Login Here</strong></a>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="site-content site-section themed-background-default">
    <div class="container">
        <div class="row" id="counters">
            <div class="col-sm-4">
                <div class="counter site-block">
                    <span data-toggle="countTo" data-to="150" data-after="K+"></span>
                    <small>Claims Filed</small>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="counter site-block">
                    <span data-toggle="countTo" data-before="$" data-to="2.5" data-decimals="1" data-after="M+"></span>
                    <small>Client Money Found</small>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="counter site-block">
                    <span data-toggle="countTo" data-to="500" data-after="K+"></span>
                    <small>Bear Hugs Given</small>
                </div>
            </div>
        </div>
    </div>
</section>
<div id="signup-terms-modal" class="modal fade mt5" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg mt5">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h2 id="legal-terms-title" class="modal-title display-inline text-primary"><strong>Agent &amp; Assignee Agreements</strong></h2>
            </div>
            <div class="modal-body" id="signupTermsBody">
                <p>We need your <strong>permission</strong> to find and collect payments for you. That means being your 
                <span class="dashed-underline enable-popover" data-title="What is an 'Agent'?" data-content="An '<strong>agent</strong>' is someone who works on your behalf. In this context, it lets us <strong>file your claims</strong>, and <strong>keep an eye on any court activity</strong> that might affect you.">
                <strong>agent</strong>
                </span> and 
                <span class="dashed-underline enable-popover" data-title="What is an 'Assignee'?" data-content="An '<strong>assignee</strong>' is someone you designate to receive something. In this case, it gives <em>Class Action, Inc.</em> the legal right to <strong>collect payments for you</strong>. Without this part, we'd have to charge a signup or subscription fee, and we'd never know if you'd received payment!">
                <strong>assignee</strong>
                </span> - is that okay with you?</p>
                <div class="form-group ml20">
                    <div class="checkbox">
                        <label for="agree-agent" class="control-label">
                            <input type="checkbox" id="agent-agree" name="agent-agree" value="agent">
                            I agree to allow <em>Class Action, Inc.</em> act on my behalf as my authorized
                            <span class="dashed-underline enable-popover" data-title="What is an 'Agent'?" data-content="An '<strong>agent</strong>' is someone who works on your behalf. In this context, it lets us <strong>file your claims</strong>, and <strong>keep an eye on any court activity</strong> that might affect you.">
                            <strong>agent</strong>
                            </span>
                        </label>
                    </div>
                    <div class="checkbox mt20">
                        <label for="agree-agent" class="control-label">
                            <input type="checkbox" id="assignee-agree" name="assignee-agree" value="agent">
                            I agree to allow <em>Class Action, Inc.</em> be my 
                            <span class="dashed-underline enable-popover" data-title="What is an 'Assignee'?" data-content="An '<strong>assignee</strong>' is someone you designate to receive something. In this case, it gives <em>Class Action, Inc.</em> the legal right to <strong>collect payments for you</strong>. Without this part, we'd have to charge a signup or subscription fee, and we'd never know if you'd received payment!">
                            <strong>assignee</strong>
                            </span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-primary"><strong>Save</strong></button>
                <button type="button" class="btn btn-sm btn-info" data-dismiss="modal"><strong>Cancel<strong></button>
            </div>
        </div>
    </div>
</div>
<?php include ROOT . '/page_footer.php'; ?>
<?php include ROOT . '/template_scripts.php'; ?>

<script src="../js/pages/signup.js?v=<?= microtime(true) ?>"></script>
<script>$(function(){ Signup.init(); });</script>

<?php include ROOT . '/template_end.php'; ?>