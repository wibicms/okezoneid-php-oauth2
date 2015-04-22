<?php

class SSOActivity{
	var $okeid;
	var $curl;
	var $api_activity_url;

	public function __construct(){
		$this->okeid = new Okezoneid();
		$this->curl = new Curl();
		$this->api_activity_url = $this->okeid->get_oauth_url().'api/v1/activities/';
	}

	public function sso_post_activity($params){
		$this->curl->setHeader('Authorization', 'Bearer '.$this->okeid->sso_get_access_token());
		$activity = array( 'request_url' => $params['request_url'],
						   'okezone_id'  => $params['okezone_id'],
						   'ip_address'	 => $this->okeid->sso_get_ip_address(),
						   'browser'	 => $_SERVER['HTTP_USER_AGENT'],
						   'log_type'	 => $params['log_type'],
						   'refferer'	 => $params['refferer'],
						   'author'		 => $params['author'],
						   'editor'		 => $params['editor'],
						   'published'	 => $params['published']);

		$this->curl->post($this->api_activity_url, $activity);

	}
}