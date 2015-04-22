<?php

class SSOComment{

	var $okeid;
	var $curl;
	var $api_comment_url;

	public function __construct(){
		$this->okeid = new Okezoneid();
		$this->curl = new Curl();
		$this->api_comment_url = $this->okeid->get_oauth_url().'api/v1/comments/';
	}

	public function sso_post_comment($params){
		$comment = array('content_id' 	=> $params['content_id'],
						 'okezone_id'	=> $params['okezone_id'],
						 'channel_id' 	=> $params['channel_id'],
						 'title' 	  	=> $params['title'],
						 'date_created' => $params['date_created'],
						 'from_name' 	=> $params['from_name'],
						 'request_url'	=> $this->okeid->sso_get_current_url(),
						 'comment' 		=> $params['comment'],
						 'parent_id' 	=> $params['parent_id'],
						 'source' 		=> $params['source']);

		$this->curl->post($this->api_comment_url, $comment);

		if ($this->curl->error) {
			$res = $this->curl->response->error;
    	}else{
    		$res = $this->curl->response;
    	}
		return $res;
	}

	public function sso_get_comment($params){
		$comment = array('content_id' 	=> $params['content_id'],
						 'offset'		=> $params['offset'],
						 'limit' 		=> $params['limit']);

		$this->curl->get($this->api_comment_url, $comment);
		
		if ($this->curl->error) {
			echo $this->curl->response;
			exit;
    	}else{
    		$res = $this->curl->response;
    	}
		return $res;
	}
}