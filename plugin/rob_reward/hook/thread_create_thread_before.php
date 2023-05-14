$config = setting_get('rob_reward');$config = json_decode($config,true); if( !empty($config['fid-' . $fid])){
$money = intval(param("reward"));
$money != param("reward") AND message(-1, "金额必须为整数");
param("reward") < 5 AND message(-1, "金额必须大于5 ");
$thread['rob_reward'] = param("reward");
$user = user_read($uid);
$rmb = $user['rmbs'] - $thread['rob_reward'] * 100;
$rmb < 0 AND message(-1, "人民币不足！");
user_update($uid,array('rmbs'=>$rmb));
}