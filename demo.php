<?php

include 'okezoneid/base.php';

$okeid = new Okezoneid();
$user = new SSOUser();
$activity = new SSOActivity();
$comment = new SSOComment();

echo '<a href="'.$okeid->sso_get_logout_url().'">Logout</a>';

/* Get curerent user's login data */
echo '<h1> Data User </h1>';
$res = $user->sso_get_current_user();
print_r($res);

echo '<hr />';
/*GET comment */
echo '<h1> Komentar </h1>';
$comment_params = array('content_id' => 1124540, 'limit' => 10, 'offset' => 0);
$res_comment = $comment->sso_get_comment($comment_params);
print_r($res_comment);

echo '<hr />';
/*POST komentar */
echo '<h1> Post Komentar </h1>';
?>
<form method="post" action="">
	<input type="hidden" name="okezone_id" value="<?php echo $res->userProfile[0]->okezone_id; ?>">
	Komentar: <input type="text" name="comment">
	<br />
	<input type="submit">
</form>

<?php

echo '<hr />';
/*POST komentar */
echo '<h1> Post Activity </h1>';

echo '<hr />';
/*POST komentar */
echo '<h1> Post Email </h1>';


?>