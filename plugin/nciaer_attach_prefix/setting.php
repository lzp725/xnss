<?php
!defined('DEBUG') AND exit('Access Denied.');
if ($method == 'GET') {
    $pconfig = kv_get('nciaer_attach_prefix');
    $prefix = $pconfig['prefix'];
    include _include(APP_PATH . 'plugin/nciaer_attach_prefix/setting.htm');
} else {
    $prefix = param('prefix', '');
    $pconfig = array();
    $pconfig['prefix'] = $prefix;
    kv_set('nciaer_attach_prefix', $pconfig);
    message(0, '提交成功！');
}
