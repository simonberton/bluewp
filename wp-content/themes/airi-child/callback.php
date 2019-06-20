<?php
session_start();

$path = preg_replace('/wp-content.*$/','',__DIR__);
include_once($path.'wp-load.php');

require_once('Facebook/autoload.php');

$fb = new Facebook\Facebook([
    'app_id' => '1585710164895398', // Replace {app-id} with your app id
    'app_secret' => 'dab5724cdd35196e0d3b7375e509379c',
    'default_graph_version' => 'v3.2',
]);

$helper = $fb->getRedirectLoginHelper();

try {
    $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}

if (! isset($accessToken)) {
    if ($helper->getError()) {
        header('HTTP/1.0 401 Unauthorized');
        echo "Error: " . $helper->getError() . "\n";
        echo "Error Code: " . $helper->getErrorCode() . "\n";
        echo "Error Reason: " . $helper->getErrorReason() . "\n";
        echo "Error Description: " . $helper->getErrorDescription() . "\n";
    } else {
        header('HTTP/1.0 400 Bad Request');
        echo 'Bad request';
    }
    exit;
}

// The OAuth 2.0 client handler helps us manage access tokens
$oAuth2Client = $fb->getOAuth2Client();

try {
    // Returns a `Facebook\FacebookResponse` object
    $response = $fb->get('/me?fields=id,name,email', $accessToken);
} catch(Facebook\Exceptions\FacebookResponseException $e) {
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}

try {
    $user = $response->getGraphUser();
    $email = $user['email'];
    $users = json_decode(file_get_contents("users.json"));

    if( null == username_exists($email)) {
        $password = wp_generate_password(12, false );
        $user_id = wp_create_user( $email, $password, $email);

        $user = new WP_User($user_id);
        $user->set_role( 'contributor' );

        foreach ($users->users as $adminEmail) {
            if ($adminEmail == $email) {
                $user->set_role( 'administrator' );
            }
        }
    } else {
        $user = new WP_User(username_exists($email));
    }
    wp_set_auth_cookie($user->ID, true, false);
    do_action('wp_login', $user->user_login);

} catch (Exception $e) {
    var_dump($e->getMessage());
    die;
}

$_SESSION['fb_access_token'] = (string) $accessToken;

?>
<h4>Facebook Login Callback</h4>
<h5>Redirecting to homepage</h5>
<script>
window.setTimeout( function(){
    window.location = "/";
    }, 2000 );
</script>
