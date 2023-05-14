<?php

!defined('DEBUG') AND exit('Access Denied.');

if ($method == 'GET') {
    $config = setting_get('rob_reward');
    $config = json_decode($config, true);
    include_once _include(APP_PATH.'plugin/rob_reward/setting.htm');
} else {
    $config = json_encode($_POST);
    setting_set('rob_reward', $config);
    echo json_encode(array("code" => 1));
}