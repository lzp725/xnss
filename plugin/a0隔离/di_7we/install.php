<?php

/*
	插件安装文件
*/

!defined('DEBUG') AND exit('Forbidden');

//初始化
if(empty(kv_get('7we')))  
	kv_set('7we',array(
	'key'=>'WWW7WENET，可自行更改必须与订阅号后台xiuno模块设置的一致',
	'startID'=>'与柒微订阅号后台的一致',
	'lead'=>'引导关注文字,例：扫描二维码关注公众号万能小精灵，回复 用户码 即可获取用户码',
	'QRcode'=>'公众号二维码图片链接地址，可以到柒微后台上传后获取',
	'reg_status'=>1,
));

$tablepre = $db->tablepre;
$sql = "ALTER TABLE ".$tablepre."user ADD fans_code CHAR(255) NOT NULL default '';";

db_exec($sql);
?>