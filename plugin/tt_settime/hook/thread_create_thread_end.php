if($group['allowTime'] && $action == 'create') {
    $time_stamp = param('time_stamp'); $time_status=param('time_machine');
    if ($time_status&& isset($time_stamp)) {
        try{
            $time_stamp = strtotime($time_stamp);
            db_update('thread', array('tid' => $tid), array('create_date' => $time_stamp));
            db_update('post', array('tid' => $tid,'isfirst'=>1), array('create_date' => $time_stamp));
        } catch(Exception $e){
            message(-1,'时间戳格式不对!');
        }
    }
}