<?php

/*
Xiuno BBS 4.0 大白插件中心
 */

!defined('DEBUG') and exit('Access Denied.');

define('PLUGIN_HUUX_URL', 'https://www.huux.cc/');

$filename    = APP_PATH . 'model/plugin.func.php'; //需要改的文件
$filecontent = file_get_contents($filename);
$r           = xn_is_writable($filename);
!$r and message(-1, '没有读写权限，请手动修改 model/plugin.func.php 文件权限为 777');

$action = param(3);

if (empty($action) || $method == 'GET') {

    //读取插件信息（插件模板使用）
    $jsonfile      = APP_PATH . 'plugin/huux_plugincenter/conf.json';
    $plugin        = xn_json_decode(file_get_contents($jsonfile));
    $plugin_rtmenu = is_array(plugin_rtmenu()) ? plugin_rtmenu() : array();

    $ak          = kv_get('huux_plugincenter_ak');
    $in          = strpos($filecontent, 'http://plugin.xiuno.com/') !== false ? 0 : 1;
    $input       = array();
    $input['in'] = form_select('in', array(0 => '官方插件', 1 => '大白插件'), $in);
    $input['ak'] = form_text('ak', '');

    $all_plguin = plugin_huux_list_cache();
    $all_plguin = arrlist_cond_orderby($all_plguin, array(), array('last_date' => -1), 1, 50);

    include _include(APP_PATH . 'plugin/huux_plugincenter/setting.htm');

} elseif ($action == 'ak') {

    $ak = param('ak');
    empty($ak) and message('ak', '请输入卡号');
    $r = plugin_check_ak($ak);
    $r == false and message('ak', '卡号无效');
    kv_set('huux_plugincenter_ak', $ak);
    message(0, '绑定成功');

} elseif ($action == 'in') {

    $in = param('in');
    $a  = 'http://plugin.xiuno.com/';
    $b  = PLUGIN_HUUX_URL;
    if ($in && strpos($filecontent, $a) !== false) {
        file_put_contents($filename, str_replace($a, $b, $filecontent));
    } elseif ($in == 0 && strpos($filecontent, $b) !== false) {
        file_put_contents($filename, str_replace($b, $a, $filecontent));
    }
    message(0, '设置成功');

}

function plugin_check_ak($ak)
{
    global $conf;
    $siteid  = plugin_siteid();
    $appurl  = http_url_path();
    $appurl  = xn_urlencode($appurl);
    $authkey = $conf['auth_key'];
    if (empty($ak)) {
        return false;
    }

    $url = PLUGIN_HUUX_URL . "plugin-check_ak-$ak-$siteid-$appurl-$authkey.htm"; //autkey唯一识别
    $s   = http_get($url);
    $arr = xn_json_decode($s);
    if (empty($arr)) {
        return false;
    }

    if ($arr['code'] == 0) {
        return true;
    } else {
        return false;
    }
}

function plugin_huux_list_cache()
{
    $s = DEBUG == 3 ? null : cache_get('plugin_huux_list');
    if ($s === null) {
        $url = PLUGIN_HUUX_URL . "plugin-all-4.htm"; // 获取所有的插件，匹配到3.0以上的。
        $s   = http_get($url);

        // 检查返回值是否正确
        if (empty($s)) {
            return xn_error(-1, '从大白官方获取插件数据失败。');
        }

        $r = xn_json_decode($s);
        if (empty($r)) {
            return xn_error(-1, '从大白官方获取插件数据格式不对。');
        }

        $s = $r;
        cache_set('plugin_huux_list', $s, 3600); // 缓存时间 1 小时。
    }
    return $s;
}

function plugin_rtmenu()
{
    $ak  = kv_get('huux_plugincenter_ak');
    $url = PLUGIN_HUUX_URL . "plugin-rtmenu-$ak.htm";
    $s   = http_get($url);
    $arr = xn_json_decode($s);
    if ($arr['code'] == 0) {
        return $arr['message'];
    } else {
        return array();
    }
}
