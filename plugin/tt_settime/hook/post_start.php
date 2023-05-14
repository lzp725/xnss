<?php exit;
if($action == 'tt_settime_p') {
    if ($method == 'GET')
        include _include(APP_PATH . 'plugin/tt_settime/view/htm/tt_settime_p.htm');
    elseif ($method == 'POST') {
        $stamp = param('stamp');
        $pid = param('pid');
        $_tid = param('tid');
        if (empty($stamp) || empty($_tid) || empty($pid)) {message(-1,'ERROR');die();}
        if(strlen($stamp)!=17) {message(-1,'时间戳格式异常');die();}
        $stamp=strtotime($stamp);
        db_update('post', array('pid' => $pid), array('create_date' => $stamp));
        $_thread = db_find_one('thread', array('tid' => $_tid));
        if ($_thread['lastpid'] == $pid)
            db_update('thread', array('tid' => $_thread['tid']), array('last_date' => $stamp));
        message(0, '更新成功!');
    }
}elseif($action=='tt_settime_f'){
    if ($method == 'GET')
        include _include(APP_PATH . 'plugin/tt_settime/view/htm/tt_settime_f.htm');
    elseif ($method == 'POST') {
        $stamp = param('stamp'); $_see_count = param('views'); $_down_count = param('down_count');
        $_tid = param('tid');
        if (empty($stamp) || empty($_tid) || empty($_see_count) ) die('ERROR');
        if(strlen($stamp)!=17) {message(-1,'时间戳格式异常');die();}
        $stamp=strtotime($stamp);
        db_update('post', array('tid' => $_tid,'isfirst'=>1 ), array('create_date' => $stamp));
        db_update('thread',array('tid'=>$_tid),array('create_date'=>$stamp,'views'=>$_see_count));
        if($_down_count !='0') db_update('attach',array('tid'=>$_tid),array('downloads'=>$_down_count));
        message(0, '更新成功!');
    }
}
?>