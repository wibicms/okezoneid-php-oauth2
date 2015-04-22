<?php
include 'okezoneid/okezoneid.php';

$okeid = new Okezoneid();

$response_code = isset($_GET['code']) ? $_GET['code'] : '';

echo '<a href="'.$okeid->sso_get_login_url().'">Login</a>';

if(!empty($response_code)){
	$okeid->sso_set_token_callback($response_code);
	header('Location: demo.php');
}

?>