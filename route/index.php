<?php

/*
* Copyright (C) 2015 xiuno.com
*/

!defined('DEBUG') AND exit('Access Denied.');

// hook index_start.php

$page = param(1, 1);

/*找到 route\index.php 文件。把大概第12行的 $order = $conf['order_default']; 改为 $order = 'tid';
再把大概第31行等号后面改为'tid'。*/
/*$order = $conf['order_default'];*/
$order = 'tid';
$order != 'tid' AND $order = 'lastpid';
$pagesize = $conf['pagesize'];
$active = 'default';

// 从默认的地方读取主题列表
$thread_list_from_default = 1;

// hook index_thread_list_before.php
if($thread_list_from_default) {
	$fids = arrlist_values($forumlist_show, 'fid');
	$threads = arrlist_sum($forumlist_show, 'threads');
	$pagination = pagination(url("$route-{page}"), $threads, $page, $pagesize);
	
	// hook thread_find_by_fids_before.php
	$threadlist = thread_find_by_fids($fids, $page, $pagesize, $order, $threads);
}

// 查找置顶帖
/*if($order == $conf['order_default'] && $page == 1) {   备份*/
if($order == 'tid' && $page == 1) {
	$toplist3 = thread_top_find(0);
	$threadlist = $toplist3 + $threadlist;
}

// 过滤没有权限访问的主题 / filter no permission thread
thread_list_access_filter($threadlist, $gid);

// SEO
$header['title'] = $conf['sitename']; 				// site title
$header['keywords'] = ''; 					// site keyword
$header['description'] = $conf['sitebrief']; 			// site description
$_SESSION['fid'] = 0;

// hook index_end.php

include _include(APP_PATH.'view/htm/index.htm');

?>