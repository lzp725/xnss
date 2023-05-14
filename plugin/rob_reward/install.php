<?php

/*
	Xiuno BBS 4.0 插件实例：TAG 插件安装
	admin/plugin-install-xn_tag.htm
*/

!defined('DEBUG') AND exit('Forbidden');

$tablepre = $db->tablepre;

$sql = "ALTER TABLE {$tablepre}user ADD COLUMN 
`rmbs` int unsigned default 0  not null comment '人民币'";
$r = db_exec($sql);
$sql = "ALTER TABLE {$tablepre}thread ADD COLUMN 
`rob_reward` int unsigned default 0  not null comment '悬赏人民币'";
$r = db_exec($sql);
$sql = "ALTER TABLE {$tablepre}thread ADD COLUMN 
`rob_reward_answer` int unsigned default 0  not null comment '答案id'";
$r = db_exec($sql);
?>
