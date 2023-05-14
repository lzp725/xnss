<?php
!defined('DEBUG') AND exit('Access Denied.');
$action = param(3);
if(empty($action)){
    if($method == 'GET')
        include _include(APP_PATH.'plugin/tt_auto_reg/setting.htm');
    elseif($method=='POST'){
        $content =param('content','');
        $content = str_replace("\r","",$content);
        $reg_arr = explode("\n",$content);
        foreach($reg_arr as $reg_usr){
            $reg_usr_arr = explode("|",$reg_usr);
            if(count($reg_usr_arr)!=2) continue;
            $reg_usr_username = $reg_usr_arr[0];
            $reg_usr_password = $reg_usr_arr[1];
            if($reg_usr=='') continue;
            if(!strpos($reg_usr,'|')) continue;
            $email = time().mt_rand(1000,9999).'@qq.com';
            $username = $reg_usr_username;
            $password = md5($reg_usr_password);
            $salt = xn_rand(16);
            $pwd = md5($password.$salt);
            $gid = 101;
            $_user = array (
                'username' => $username,
                'email' => $email,
                'password' => $pwd,
                'salt' => $salt,
                'gid' => $gid,
                'create_ip' => $longip,
                'create_date' => time(),
                'logins' => 1,
                'login_date' => time(),
                'login_ip' => $longip,
            );
            $uid = user_create($_user);
        }
        message(0,'注册成功！');
    }
}
?>