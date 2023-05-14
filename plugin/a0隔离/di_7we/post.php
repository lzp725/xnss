<?php 
!defined('DEBUG') AND exit('Access Denied.');
/*
1.最新帖子 newThread
2.热门帖子 hotThread
3.搜索帖子 searchTreath
4.我的帖子 mythread
5.我的回复 myReply

 */
$page=1;
$size=10;//默认回复10条

//最新帖子 newThread
if(param('action')=="newThread"){
	$list=db_find('thread', array(),array('create_date'=>-1),$page,$size);
	echo json_encode($list,JSON_UNESCAPED_UNICODE);
}

//热门帖子
if(param('action')=="hotThread"){
	$list=db_find('thread', array(),array('views'=>-1),$page,$size);
	echo json_encode($list,JSON_UNESCAPED_UNICODE);
}

//我的帖子
if(param('action')=="myThread"){
	$fans_code=param('fans_code');
	$r=db_find_one('user',array('fans_code'=>$fans_code));
	$list=db_find('thread', array('uid'=>$r['uid']),array('create_date'=>-1),$page,$size);
	echo json_encode($list,JSON_UNESCAPED_UNICODE);
}

//我的回复
if(param('action')=="myReply"){
	$fans_code=param('fans_code');
	$r=db_find_one('user',array('fans_code'=>$fans_code));
	$list=db_find('thread', array('uid'=>$r['uid']),array('time'=>-1),$page,$size);
	echo json_encode($list,JSON_UNESCAPED_UNICODE);
}

/*//搜索帖子
if(param('action')=="search"){
	$content=urldecode(param('content'));
	$list=db_find('thread', array(),array('subject'=>array('LIKE'=>$content)));
	echo json_encode($list,JSON_UNESCAPED_UNICODE);
}
*/



 ?>
