<?php
/*
1、只统计显示文字内容图片个数不会统计附件 
2、支持原创正版www.432k.cn
3、使用盗版会严重带来风险损失
4、由迷途制作,作者所属
*/

function picnum($tid){
	$arr = db_find_one('post', array('tid'=>$tid));
	$str= $arr['message_fmt'];
	preg_match_all("/<img.*src=[\'|\"](.*)[\'|\"]\s*.*>/iU", $str, $img);
	$imgall = $img[1];
	$num = count($imgall);
	return $num;
	
}


?>