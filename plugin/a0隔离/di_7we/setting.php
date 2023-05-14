<?php

/*
	插件配置文件 (无配置则不需要此文件)
*/

!defined('DEBUG') AND exit('Access Denied.');

if($method == 'GET') {
	$kv = kv_get('7we');
	$input = array();
	$input['startID'] = form_text('startID', $kv['startID']);
	$input['key'] = form_text('key', $kv['key']);
	$input['lead'] = form_textarea('lead', $kv['lead']);
	$input['QRcode'] = form_text('QRcode', $kv['QRcode']);
	$input['reg_status'] = form_radio_yes_no('reg_status', $kv['reg_status']);
//	$input['login_status'] = form_radio_yes_no('login_status', $kv['login_status']);

	include _include(APP_PATH.'plugin/di_7we/setting.htm'); // 这里包含一个插件配置界面文件

} else {

		kv_set('7we',$_POST);
		message(0,'修改成功');


}

?>
