<?php
define('ROOT', __DIR__);

$template = array(
    'name'          => 'Class Action, Inc.',
    'author'        => 'Class Action, Inc.',
    'robots'        => '',
    'title'         => 'Class Action, Inc.',
    'description'   => 'Get Money You’re Owed From Class Action Lawsuits. Class Action, Inc. allows you to file more claims so you can collect more money. Claim What’s Yours.',
    // true             for a boxed layout
    // false            for a full width layout
    'boxed'         => false,
    'active_page'   => basename($_SERVER['PHP_SELF'])
);

/* Primary navigation array (the primary navigation will be created automatically based on this array) */
$primary_nav = array(
    array(
        'name'  => 'Home',
        'url'   => '/'
    ),
    array(
        'name'  => 'How it Works',
        'url'   => '/#howitworks'
    ),
    array(
        'name'  => 'Blog',
        'url'   => '/faq/'
    ),
    array(
        'name'  => 'Charity',
        'url'   => '/#charity'
    ),
    array(
        'name'  => 'Contact',
        'url'   => '/contact/'
    )
);

require_once(ROOT . "/functions.php");
require_once(ROOT . '/exceptions.php');
