<?php

!defined('DEBUG') AND exit('Access Denied.');

$act = param(1);
$ax_friends = kv_get('ax_friends');
$tips = $ax_friends['friends_tips'];

if($act == 'del'){
	$id = param(2);
	if(!empty($user)){
		$fr_pic =  db_find_one('ax_friends', array('friendsid'=>$id));
		$r = db_delete('ax_friends', array('friendsid'=>$id));
		if($r === FALSE) {
			echo "删除失败";
		} else {
			@unlink($fr_pic['friends_pic']); 
			message(7, jump('删除成功！', url('friends'), 1));  
		}		
	}
}
		
if($act == 'add'){
	$uid = param('uid');
	$message = param('message');
	$iconarr = param('icon');
	$time = time();
	if(!$user){
		message(2,'请登录！');exit;
	}
	if($message == ''){
		message(3,'亲，请输入内容！');exit;
	}
	$r = db_create('ax_friends', array('uid'=>$uid,'create_date'=>$time,'message'=>$message));

	if(!empty($iconarr)) {
		$data = substr($iconarr, strpos($iconarr, ',') + 1);
		$data = base64_decode($data);
		$path = 'upload/friends/';
		!is_dir($path) AND (mkdir($path, 0777, TRUE) OR message(-2, lang('directory_create_failed')));
		$iconfile = "upload/friends/$time.png";
		file_put_contents($iconfile, $data);
		db_update('ax_friends', array('friendsid'=>$r), array('friends_pic'=>$iconfile));
	}

	message(0,'发布成功！');
}else{

	$friends_num =  db_count('ax_friends');
	$page = param(1,1);
	if($ax_friends['friends_num']){
		$pagesize = $ax_friends['friends_num'];
	}else{
		$pagesize = 20;
	}
	$friends_list =  db_find('ax_friends',array('friendsid'=>array('!='=>0)), array('friendsid'=>-1), $page, $pagesize);	
	$pagination = pagination(url("friends-{page}"), $friends_num, $page, $pagesize);


}


include _include(APP_PATH.'plugin/ax_friends/view/htm/friends.htm');
?>