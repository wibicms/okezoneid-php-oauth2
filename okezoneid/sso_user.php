<?php

class SSOUser{

	var $okeid;
	var $api_url; 

	public function __construct(){
		$this->okeid = new Okezoneid();
		$this->curl = new Curl();
		$this->api_url = $this->okeid->get_oauth_url().'api/v1/okezone_id/';
	}

	public function sso_get_current_user(){
		$this->curl->setHeader('Authorization', 'Bearer '.$this->okeid->sso_get_access_token());
		$this->curl->get($this->api_url.'detail/current_user');
		if ($this->curl->error) {
			$res = $this->curl->response->error;
    	}else{
    		$res = $this->curl->response;
    	}
		return $res;
	}

	public function sso_get_user_by_id($id){
		$this->curl->setHeader('Authorization', 'Bearer '.$this->okeid->sso_get_access_token());
		$this->curl->get($this->api_url.'detail/d/'+$id);
		if ($this->curl->error) {
			$res = $this->curl->response->error;
    	}else{
    		$res = $this->curl->response;
    	}
		return $res;
	}

	public function sso_get_user_by_username($username){
		$this->curl->setHeader('Authorization', 'Bearer '.$this->okeid->sso_get_access_token());
		$this->curl->get($this->api_url.'detail/username/'+$username);
		if ($this->curl->error) {
			$res = $this->curl->response->error;
    	}else{
    		$res = $this->curl->response;
    	}
		return $res;
	}

	public function sso_get_user_by_okezone_id($okezone_id){
		$this->curl->setHeader('Authorization', 'Bearer '.$this->okeid->sso_get_access_token());
		$this->curl->get($this->api_url.'detail/okezone_id/'+$okezone_id);
		if ($this->curl->error) {
			$res = $this->curl->response->error;
    	}else{
    		$res = $this->curl->response;
    	}
		return $res;
	}



}