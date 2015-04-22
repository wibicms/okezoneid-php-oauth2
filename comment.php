<?php
include 'okezoneid/base.php';

$okeid = new Okezoneid();
$comment = new SSOComment();

$params = ('okezone_id'	=> $_POST['okezone_id'],
		 'content_id'	=> 1001
	 	 'channel_id' 	=> 100,
		 'title' 	  	=> "Okezone Test",
		 'date_created' => date('Y-m-d'),
		 'from_name' 	=> 'adi sukma',
		 'request_url'	=> $this->okeid->sso_get_current_url(),
		 'comment' 		=> $_POST['comment'];,
		 'parent_id' 	=> 0,
		 'source' 		=> 'SSO TEST');

$res = $this->comment->sso_post_comment($params);
print_r($res);



?>
