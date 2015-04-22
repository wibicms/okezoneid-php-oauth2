<?php
/* PHP OAUTH 2.0 for OKEZONE ID
 * author : Adi Wibawa
 */

include 'Curl.php';

class Okezoneid extends Curl {
	var $oauth2_client_id;
	var $oauth2_secret;
	var $oauth2_redirect;
	var $oauth2_url;

	var $curl;

	public function __construct(){
		$this->curl = new Curl();
		$this->oauth2_client_id = '90115be9b31d99709292bbcf0a1ff801cfb6a844d0687076dd9e308e6ad9a89b'; 
		$this->oauth2_secret = '47a2090a38124a12649cbe84bb8c33059e95f6d2918c3f330cacde750d9253c8';
		$this->oauth2_redirect = 'http://phpdemo.okezone.com/okeid-php/login.php';
		$this->oauth2_url = "http://ssodev.okezone.com/";
		
	}

	public function get_oauth_url(){
		return $this->oauth2_url;
	}

	public function sso_get_login_url(){
		
		$params = array(
		    "response_type" => "code",
		    "client_id" => $this->oauth2_client_id,
		    "redirect_uri" => $this->oauth2_redirect
		    );
		 
		$request_to = $this->oauth2_url . 'oauth/authorize?' . http_build_query($params);

		return $request_to;
	}

	public function sso_get_logout_url(){
		$params = array('token_id' 	=> $this->sso_get_access_token(),
						'redirect_uri'  => $this->oauth2_redirect);

		$request_to = $this->oauth2_url . 'logout?' . http_build_query($params);

		return $request_to;
	}

	public function sso_set_token_callback($code){
		$params = array(
	        "code" => $code,
	        "client_id" => $this->oauth2_client_id,
	        "client_secret" => $this->oauth2_secret,
	        "redirect_uri" => $this->oauth2_redirect,
	        "grant_type" => "authorization_code"
    	);
	   
	    $this->curl->post($this->oauth2_url.'oauth/token', $params);
		setcookie('IDACCESS', $res->access_token, time() + (10 * 365 * 24 * 60 * 60));
		setcookie('IDSTATUS', 0, time() + (10 * 365 * 24 * 60 * 60));
		$this->sso_register_token();
	}

	public function sso_get_access_token(){
		$access_token = isset($_COOKIE['IDACCESS']) ? $_COOKIE['IDACCESS'] : '';
		return $access_token;
	}

	public function sso_get_ip_address(){
	    $ipaddress = '';
	    if (!empty($_SERVER['HTTP_CLIENT_IP']))
	        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
	    else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
	        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
	    else if(!empty($_SERVER['HTTP_X_FORWARDED']))
	        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
	    else if(!empty($_SERVER['HTTP_FORWARDED_FOR']))
	        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
	    else if(!empty($_SERVER['HTTP_FORWARDED']))
	        $ipaddress = $_SERVER['HTTP_FORWARDED'];
	    else if(!empty($_SERVER['REMOTE_ADDR']))
	        $ipaddress = $_SERVER['REMOTE_ADDR'];
	    else
	        $ipaddress = 'UNKNOWN';
	    return $ipaddress;
	}

	public function sso_get_current_url(){
	    $url = $this->ci->config->site_url($this->ci->uri->uri_string());
	    return $_SERVER['QUERY_STRING'] ? $url.'?'.$_SERVER['QUERY_STRING'] : $url;
	}

	private function sso_register_token(){
		$this->curl->post($this->oauth2_url.'api/v1/sessions', array('token_id' => $this->sso_get_access_token()));
	}


}