<?php
/*
* Template Name: Login Page
*/
session_start();
get_header();

require_once('Facebook/autoload.php');

$fb = new Facebook\Facebook([
    'app_id' => '1585710164895398', // Replace {app-id} with your app id
    'app_secret' => 'dab5724cdd35196e0d3b7375e509379c',
    'default_graph_version' => 'v3.2',
]);
$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // Optional permissions
$loginUrl = $helper->getLoginUrl('http://localhost/wp-content/themes/airi-child/callback.php', $permissions);

echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';

get_footer();
?>
