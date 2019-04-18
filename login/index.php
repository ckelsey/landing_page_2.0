<?php 
include '../inc/config.php'; 

$queryStr = parse_url($_SERVER["REQUEST_URI"], PHP_URL_QUERY);
$email = isset($queryStr) ? base64_decode($queryStr) : '';
?>
<?php include '../inc/template_start.php'; ?>
<?php include '../inc/page_head.php'; ?>

<section class="site-section site-section-light site-section-top themed-background-default">
    <div class="container">
        <h1 class="text-center animation-slideDown"><i class="fa fa-arrow-right"></i> <strong>Log In</strong></h1>
        <h2 class="h3 text-center animation-slideUp">Connect to find your claims</h2>
    </div>
</section>
<section class="site-content site-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3 col-lg-4 col-lg-offset-4 site-block">
                <div id="errorDisp" class="alert alert-danger mtn10 mb10 hidden"></div>
                <form id="form-log-in" class="form-horizontal">
                    <div class="form-group">
                        <div class="col-xs-12">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="gi gi-envelope"></i></span>
                                <input type="email" id="login-email" name="login-email" class="form-control input-lg" placeholder="Email" value="<?= $email ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group loginUI animation-pullDown">
                        <div class="col-xs-12">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="password" id="login-password" name="login-password" class="form-control input-lg" placeholder="Password">
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-actions">
                        <div class="col-xs-6">
                            <div class="loginUI animation-pullDown">
                                <label class="switch switch-primary">
                                    <input type="checkbox" id="login-remember-me" name="login-remember-me" checked><span></span>
                                </label>
                                <small>Remember me</small>
                            </div>
                        </div>
                        <div class="col-xs-6 text-right">
                            <button id="theButton" type="submit" class="btn btn-sm btn-primary"><i class="fa fa-arrow-right"></i> Login</button>
                            <input type="hidden" id="uiFlag" value="0">
                        </div>
                    </div>
                    <div class="form-group">

                    </div>
                </form>
                <div class="text-center">
                    <a href="/clarence/"><strong>Don't have an account?</strong></a>
                    <a id="reset-pass" href="javascript:void(0)" class="ml50 loginUI"><strong>Forgot password?</strong></a>
                    <a id="login-pass" href="javascript:void(0)" class="ml50 hidden resetUI"><strong>Login</strong></a>
                </div>
            </div>
        </div>
        <hr>
    </div>
</section>
<section class="site-content site-section">
    <div class="container">
        <div class="row row-items text-center">
            <div class="col-sm-6 animation-fadeIn">
                <a href="/ticket/" class="circle themed-background">
                    <i class="gi gi-life_preserver"></i>
                </a>
                <h4>Need <strong>Help</strong>?</h4>
            </div>
            <div class="col-sm-6 animation-fadeIn">
                <a href="/contact/" class="circle themed-background">
                    <i class="gi gi-envelope"></i>
                </a>
                <h4><strong>Contact</strong> Us</h4>
            </div>
        </div>
    </div>
</section>

<?php include '../inc/page_footer.php'; ?>
<?php include '../inc/template_scripts.php'; ?>
<script src="/js/pages/login.js"></script>
<script>$(function(){ Login.init(); });</script>
<?php include '../inc/template_end.php'; ?>