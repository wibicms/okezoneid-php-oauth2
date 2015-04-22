<?php

class SSOEmail{
	var $okeid;
	var $curl;
	var $api_email_url;

	public function __construct(){
		$this->okeid = new Okezoneid();
		$this->curl = new Curl();
		$this->api_email_url = $this->okeid->get_oauth_url().'api/v1/email/';
	}

	public function sso_post_email($params){
		$this->curl->setHeader('Authorization', 'Bearer '.$this->okeid->sso_get_access_token());
		$params = array('to' 		=> $params['to'],
						'subject'	=> $params['subject'],
						'message'	=> $params['message'],
						'from'		=> $params['from'],
						'cc'		=> !empty($params['cc']) ? $params['cc'] : '');

		$this->curl->post($this->api_email_url, $params);
		if ($this->curl->error) {
			$res = $this->curl->response->error;
    	}else{
    		$res = $this->curl->response;
    	}
		return $res;
	}
}