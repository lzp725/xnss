<?php exit;
if($group['allowTime']) {
    $time_check = param('time_check');
    if ($time_check == 'checked') {
        $time_input = param('time_input');
        $time_stamp = strtotime($time_input);
        db_update('post',array('pid'=>$pid), array('create_date' => $time_stamp));
        $post['create_date']=$time_stamp;
    }
}
?>