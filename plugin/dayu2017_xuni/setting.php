<?php 
/**
*附件下载弹出
*/
error_reporting(0); 
!defined('DEBUG') AND exit('Access Denied.');
$action = param(3);


if(empty($action)){
	if($method == 'GET'){//设置页面
$beishu=file_get_contents(APP_PATH.'plugin/dayu2017_xuni/hook/beishu.htm');
		include _include(APP_PATH.'plugin/dayu2017_xuni/setting.htm');
	}else{

		file_put_contents(APP_PATH.'plugin/dayu2017_xuni/hook/beishu.htm',trim($_POST['beishu']));
		message(0, '完成');
		
	}
}
	?>