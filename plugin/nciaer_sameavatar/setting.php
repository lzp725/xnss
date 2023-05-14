<?php
!defined('DEBUG') AND exit('Access Denied.');
if ($method == 'GET') {
    $pconfig = kv_get('nciaer_sameavatar');
    $avatar = $pconfig['avatar'];
    include _include(APP_PATH . 'plugin/nciaer_sameavatar/setting.htm');
} else {
    $avatar = param('avatar', '');
    $pconfig = array();
    $pconfig['avatar'] = $avatar;
    kv_set('nciaer_sameavatar', $pconfig);
    message(0, '提交成功！');
}
