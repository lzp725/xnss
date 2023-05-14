<?php

!defined('DEBUG') AND exit('Access Denied.');

if ($method == 'GET') {
    $kv = kv_get('xiunobbs_cn_notice');
	$input['content'] = form_text('content',$kv['content']);
    include _include(APP_PATH.'plugin/xiunobbs_cn_notice/setting.htm');
} else {
    $kv = array();
    $kv['content'] = param('content');
	$kv['style'] = param('style');
    kv_set('xiunobbs_cn_notice', $kv);
    message(0,lang('save_successfully'));
}

?>