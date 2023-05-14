<?php !defined('DEBUG') AND exit('Access Denied.');
$action = param(3);
if(empty($action)) {
    if ($method == 'GET')
        include _include(APP_PATH . 'plugin/tt_settime/setting.htm');
    elseif($method=='POST'){
        $tablepre=$db->tablepre;
        $update_lists2=param('Time_group',array(0));
        if(empty($update_lists2)){message(-1,'设置失败！');die();}
        $sql = 'UPDATE '.$tablepre.'group SET allowTime="0";';
        foreach($update_lists2 as $k => $v)
            $sql .= 'UPDATE '.$tablepre.'group SET allowTime="1" WHERE gid="'.$k.'";';
        $status=db_exec($sql);
        group_list_cache_delete();
        message(0,'设置成功！');
    }
}
?>