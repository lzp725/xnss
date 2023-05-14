<?php
!defined('DEBUG') AND exit('Access Denied.');
if ($method == 'GET') {
    $viewlog = kv_get('zz_iqismart_viewlog');
    $title = $viewlog['title'];
    $maxnum = intval($viewlog['maxnum']);
    $days = intval($viewlog['days']);
    include _include(APP_PATH . 'plugin/zz_iqismart_viewlog/setting.htm');
} else {
    $title = param('title');
    $maxnum = param('maxnum', 10);
    $days = param('days', 0);
    $viewlog = array();
    $viewlog['title'] = $title;
    $viewlog['maxnum'] = $maxnum;
    $viewlog['days'] = $days;
    kv_set('zz_iqismart_viewlog', $viewlog);
    message(0, '提交成功！');
}
