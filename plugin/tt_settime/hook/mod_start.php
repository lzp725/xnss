<?php exit;
if($action == 'set_time') {
	if($method == 'GET')
		include _include(APP_PATH.'plugin/tt_settime/view/htm/mod_set_time.htm');
	 else {
		$time_start = param('start', '0');
		$time_end = param('end','0');
		$tidarr = param('tidarr', array(0));
		$rand_mode=0;
		empty($tidarr) AND message(-1, lang('please_choose_thread'));
		empty($time_start) AND message(-1, '请输入起始时间!');
		empty($time_start) AND message(-1, '请输入终止时间!');
		if(strlen($time_start)!=17) message(-1, '起始时间格式错误!');
		if(strlen($time_end)!=17) message(-1, '结束时间格式错误!');
		$time_start = strtotime($time_start);
		$time_end = strtotime($time_end);
		empty($uid) AND message(-1, '未登录!');
		(! $group['allowTime']) AND message(-1, '无权操作!');
		$count_num = count($tidarr);
		if($time_start!=$time_end ){
            if(abs($time_end- $time_start) < $count_num) {message(-1, '步长过少!');die();}
            if($time_start>$time_end)  {$t = $time_end; $time_end= $time_start;$time_start=$t; } //反了则交换
            $rand_mode=1;
        }
        rsort($tidarr);
		foreach($tidarr as $_tid) {
			if($rand_mode)  $time_end-= mt_rand(0,(int)(($time_end-$time_start)/$count_num));
			$count_num--;
			db_update('thread',array('tid'=>$_tid),array('create_date'=>$time_end));
			db_update('post',array('tid'=>$_tid,'isfirst'=>1),array('create_date'=>$time_end));
		}
		message(0, lang('set_completely'));
	}
}

?>