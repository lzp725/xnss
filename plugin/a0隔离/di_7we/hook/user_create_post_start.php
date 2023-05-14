$_7we=kv_get('7we');
if($_7we['reg_status']==1){
	$fans_code = param('fans_code');
	empty($fans_code) AND message('fans_code', '用户码不能为空');

	$check_code=db_find_one('user',array('fans_code'=>$fans_code));
	!empty($check_code) AND message('fans_code', '该用户码已经被使用');

	include _include(APP_PATH.'plugin/di_7we/model/sign.fun.php');

	$data=array(
    'fans_code' =>$fans_code,
    'startID' =>$_7we['startID'],
    'timestamp' => time() ,
	);
	$secret=$_7we['key'];//通信密匙
	$data['sign'] = getSign($secret, $data);
	$r=http_post('http://wx.7we.net?open-checkCode-xiuno',$data);
	if($r !=1) message('fans_code', $r);
	
}
