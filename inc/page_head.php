<?php
/**
 * page_head.php
 *
 * Author: pixelcave
 *
 * Header of each page
 *
 */
?>

<script async src="//www.googletagmanager.com/gtag/js?id=UA-99628832-5"></script>
<script>window.dataLayer = window.dataLayer || [];function gtag(){dataLayer.push(arguments);}gtag('js', new Date());gtag('config', 'UA-99628832-5', { 'send_page_view': false, 'anonymize_ip': true });</script>
<script id="mcjs">!function(c,h,i,m,p){m=c.createElement(h),p=c.getElementsByTagName(h)[0],m.async=1,m.src=i,p.parentNode.insertBefore(m,p)}(document,"script","https://chimpstatic.com/mcjs-connected/js/users/db9cb1341159e67cd255c5f22/2b8777ff31190e1390c3ae53d.js");</script>
<script>
    function uuidv4() {
        if(crypto) {
            return ([1e7]+-1e3+-4e3+-8e3+-1e11).replace(/[018]/g, c =>
                (c ^ crypto.getRandomValues(new Uint8Array(1))[0] & 15 >> c / 4).toString(16)
            );
        } else {
            return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
                var r = Math.random() * 16 | 0, v = c == 'x' ? r : (r & 0x3 | 0x8);
                return v.toString(16);
            });
        }
    }

    var cai_uuid = uuidv4();
    console.log(cai_uuid);

    var uid = sessionStorage.getItem("uid");
    if(uid===undefined || uid =='' || uid==null)
    {
        sessionStorage.setItem("uid",cai_uuid)
        uid = sessionStorage.getItem("uid");
    }
    console.log(uid);
    

    async function getIP() {
        try {
            const resp = await window.fetch("https://ipinfo.io/json?token=d3923202237e4d");
            let result = {};
            if(resp) {
                result = await resp.json();
            }

            let postData = {
                url: encodeURI(window.location.href),
                ip: result,
                cai_uuid: uid,
                userAgent: navigator.userAgent
            };
            
            x = new XMLHttpRequest();
            x.open('POST', 'https://webhooks.mongodb-stitch.com/api/client/v2.0/app/cai_auth-tgtyd/service/cai_svc_external/incoming_webhook/trafficGatekeeper?secret=7e5937bcf7cd23fd17e4');
            x.send(JSON.stringify(postData));
            x.onreadystatechange = function() {
                if (x.readyState != 4) return;
                console.log(x.status);
            }
        } catch(err) {
            console.log(err);
        }
    }

    if(!navigator.userAgent.match(/bot|spider/i)) {
        getIP();
    }
    </script>
    <!-- Bing UET -->
    <script>(function(w,d,t,r,u){var f,n,i;w[u]=w[u]||[],f=function(){var o={ti:"25042834"};o.q=w[u],w[u]=new UET(o),w[u].push("pageLoad")},n=d.createElement(t),n.src=r,n.async=1,n.onload=n.onreadystatechange=function(){var s=this.readyState;s&&s!=="loaded"&&s!=="complete"||(f(),n.onload=n.onreadystatechange=null)},i=d.getElementsByTagName(t)[0],i.parentNode.insertBefore(n,i)})(window,document,"script","//bat.bing.com/bat.js","uetq");</script>
    <!-- Facebook Pixel Code -->
    <script>
    !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
    n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
    document,'script','https://connect.facebook.net/en_US/fbevents.js');
    
    fbq('init', '1565099903534179');
    fbq('track', "PageView");</script>
    <noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=1565099903534179&ev=PageView&noscript=1"
    /></noscript>
    <!-- End Facebook Pixel Code -->
    <!-- Facebook Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '2223345544657552');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
        src="https://www.facebook.com/tr?id=2223345544657552&ev=PageView&noscript=1"
    /></noscript>
    <!-- End Facebook Pixel Code -->
    <script>
        fbq('track', 'ViewContent', {
        value: 0,
        currency: 'USD',
        });
    </script>
    <!-- DO NOT MODIFY -->
    <!-- Quora Pixel Code (JS Helper) -->
    <script>
    !function(q,e,v,n,t,s){if(q.qp) return; n=q.qp=function(){n.qp?n.qp.apply(n,arguments):n.queue.push(arguments);}; n.queue=[];t=document.createElement(e);t.async=!0;t.src=v; s=document.getElementsByTagName(e)[0]; s.parentNode.insertBefore(t,s);}(window, 'script', 'https://a.quora.com/qevents.js');
    qp('init', 'f8e9573a85dd404b98f4cf2c60afeb37');
    qp('track', 'ViewContent');
    </script>
    <noscript><img height="1" width="1" style="display:none" src="https://q.quora.com/_/ad/f8e9573a85dd404b98f4cf2c60afeb37/pixel?tag=ViewContent&noscript=1"/></noscript>
    <!-- End of Quora Pixel Code -->


<!-- Page Container -->
<!-- In the PHP version you can set the following options from inc/config file -->
<!-- 'boxed' class for a boxed layout -->
<div id="page-container"<?php if ( $template['boxed'] ) { echo ' class="boxed"'; } ?>>
    <!-- Site Header -->
    <header>
        <div class="container">
            <!-- Site Logo -->
            <a href="/" class="site-logo mw-300">
                <img src="/img/cai_hdr_logo.png" class="full-width">
            </a>
            <!-- Site Logo -->

            <!-- Site Navigation -->
            <nav>
                <!-- Menu Toggle -->
                <!-- Toggles menu on small screens -->
                <a href="javascript:void(0)" class="btn btn-default site-menu-toggle visible-xs visible-sm">
                    <i class="fa fa-bars"></i>
                </a>
                <!-- END Menu Toggle -->

                <!-- Main Menu -->
                <?php if ($primary_nav) { ?>
                <ul class="site-nav">
                    <!-- Toggles menu on small screens -->
                    <li class="visible-xs visible-sm">
                        <a href="javascript:void(0)" class="site-menu-toggle text-center">
                            <i class="fa fa-times"></i>
                        </a>
                    </li>
                    <!-- END Menu Toggle -->
                    <?php foreach( $primary_nav as $key => $link ) {
                        $link_class = '';
                        $li_active  = '';
                        $menu_link  = '';

                        // Get 1st level link's vital info
                        $url        = (isset($link['url']) && $link['url']) ? $link['url'] : 'javascript:void(0)';
                        $active     = (isset($link['url']) && ($template['active_page'] == $link['url'])) ? 'active' : '';

                        // Check if the link has a submenu
                        if (isset($link['sub']) && $link['sub']) {
                            // Since it has a submenu, we need to check if we have to add the class active
                            // to its parent li element (only if a 2nd level link is active)
                            foreach ($link['sub'] as $sub_link) {
                                if (in_array($template['active_page'], $sub_link)) {
                                    $li_active = ' class="active"';
                                    break;
                                }
                            }

                            $menu_link = 'site-nav-sub';
                        }

                        // Create the class attribute for our link
                        if ($menu_link && $active) {
                            $link_class = ' class="'. $menu_link . ' ' . $active .'"';
                        } else if ($menu_link) {
                            $link_class = ' class="'. $menu_link .'"';
                        } else if ($active) {
                            $link_class = ' class="'. $active .'"';
                        }
                    ?>
                    <li<?php echo $li_active; ?>>
                        <a href="<?php echo $url; ?>"<?php echo $link_class; ?>><?php if (isset($link['sub']) && $link['sub']) { // if the link has a submenu ?><i class="fa fa-angle-down site-nav-arrow"></i><?php } echo $link['name']; ?></a>
                        <?php if (isset($link['sub']) && $link['sub']) { // if the link has a submenu ?>
                        <ul>
                            <?php foreach ($link['sub'] as $sub_link) {
                                $link_class = '';
                                $li_active = '';
                                echo $sub_link;
                                // Get 2nd level link's vital info
                                $url        = (isset($sub_link['url']) && $sub_link['url']) ? $sub_link['url'] : '#';
                                $active     = (isset($sub_link['url']) && ($template['active_page'] == $sub_link['url'])) ? 'active' : '';

                                if ($active) {
                                    $link_class = ' class="'. $active .'"';
                                }
                            ?>
                            <li<?php echo $li_active; ?>>
                                <a href="<?php echo $url; ?>"<?php echo $link_class; ?>><?php echo $sub_link['name']; ?></a>
                            </li>
                            <?php } ?>
                        </ul>
                        <?php } ?>
                    </li>
                    <?php } 
                    
                    ?>
                    <li>
                    <a href="javascript:void(0)" class="site-nav-sub">Support<i class="fa fa-angle-down site-nav-arrow"></i></a>
                        <ul>
                            <li>
                                <a href="/faq/">FAQ</a>
                            </li>
                            <li>
                                <a href="/ticket/">Support Ticket</a>
                            </li>
                        </ul>
                    </li>   
                    <?php
                    if(!isset($sessionActive)) {
                    ?>
                    <li>
                        <a href="/login/" class="btn btn-primary">Log In</a>
                    </li>
                    <li>
                        <a href="/clarence/" class="btn btn-success btn-start">Sign Up</a>
                    </li>
                    <?php } else { ?>
                    <li>
                        <?php
                        if(isset($_SESSION['FULLNAME'])) {
                        ?>
                        <a href="javascript:void(0)" class="site-nav-sub"><?= $_SESSION['FULLNAME'] ?><i class="fa fa-angle-down site-nav-arrow"></i></a>
                        <ul>
                            <li>
                                <a href="/clarence/?<?= base64_encode("bptkn=" . $_SESSION['TOKEN']) ?>">Find Settlements</a>
                            </li>
                            <li>
                                <a href="/claims/listing/">My Claims</a>
                            </li>
                            <li>    
                                <a href="/logout/">Logout</a>    
                            </li>
                        </ul>
                        <?php } else { ?>
                            <a href="/logout/">Logout</a>
                        <?php } ?>
                    </li>
                    <?php } ?>
                </ul>
                <?php } ?>
                <!-- END Main Menu -->
            </nav>
            <!-- END Site Navigation -->
        </div>
    </header>
    <!-- END Site Header -->
