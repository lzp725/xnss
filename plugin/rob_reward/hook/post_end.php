<?php
exit;
elseif ($action == 'reward') {
    $pid = $_POST['pid'];
    $tid = $_POST['tid'];

    $thread = thread_read($tid);
    $thread['rob_reward'] *= 100;   //货币比例  1元=100
    $post = post_read($pid);
    $post_user = user_read($post['uid']);
    $money = $post_user['rmbs'] + $thread['rob_reward'];
    //禁止重复结贴
    $thread['rob_reward_answer'] AND message(1,'已经有答案了');
    //    只允许楼主或管理员结贴
    if($uid == $thread['uid'] || $uid == 1){
        thread__update($tid,array('rob_reward_answer'=>$pid));
        user__update($post['uid'],array('rmbs'=>$money));

        if(function_exists(notice_send)){
        $recvuid = $post_user["uid"];
        // 检查接收人是否存在
        $recvuid_check = user__read($recvuid);
        $recvuid_check === FALSE AND message('recvuid', lang('notice_admin_send_notice_user_empty'));
        $message = "<div class='comment-info'>你的<a class='mr-1 text-grey' href='"  . url("thread-$thread[tid]") . "#" . $post["pid"] . "'>帖子</a>已被选为答案<a href='" . url("thread-$thread[tid]") . "'>《 " . notice_substr($thread["subject"]) . "》<i style=\"color:green\">☑已解决</i></a></div><div class='single-comment'><a href='" .  url("thread-$thread[tid]") . "#" . $post["pid"] . "'>" . notice_substr($post["message"], 40, FALSE) . "</a></div>";

        notice_send($uid, $recvuid, $message, 3);
        }
        message(0,'结贴成功');

    }else{
        message(1,'抱歉，只允许楼主可以操作!');
    }
}
?>