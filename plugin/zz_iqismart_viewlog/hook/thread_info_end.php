<?php exit;
// 插入访客信息
if($user['uid']) {
    $logid = db_find_one('zz_iqismart_viewlog', array('uid' => $user['uid'], 'tid' => $tid));
    if($logid) {
        db_update('zz_iqismart_viewlog', array('uid' => $user['uid'], 'tid' => $tid), array('dateline' => $time));
    } else {
        db_insert('zz_iqismart_viewlog', array('uid' => $user['uid'], 'username' => $user['username'], 'tid' => $tid, 'dateline' => $time));
    }
}

$viewlog = kv_get('zz_iqismart_viewlog');
if($viewlog['days']) {
    $deletetime = $time - $viewlog['days'] * 86400;
    $tablepre = $db->tablepre;
    db_exec('delete from '.$tablepre.'zz_iqismart_viewlog where dateline <='.$deletetime);
}
$logs = db_find('zz_iqismart_viewlog', array('tid' => $tid), array('dateline' => -1), 1, $viewlog['maxnum']);
$logs_count = db_count('zz_iqismart_viewlog', array('tid' => $tid));
