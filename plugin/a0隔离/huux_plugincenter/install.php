<?php
/*
	Xiuno BBS 4.0 大白插件
	http://www.huux.cc
*/

!defined('DEBUG') AND exit('Forbidden');

$kv = kv_get('huux_plugincenter_ak');
if(!$kv) {
	kv_set('huux_plugincenter_ak', '');
}

?>