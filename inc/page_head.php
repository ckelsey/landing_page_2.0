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
                                <a href="/ticket/">ZenDesk Ticket</a>
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
                        <a href="/clarence/" class="btn btn-success btn-alt">Sign Up</a>
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
