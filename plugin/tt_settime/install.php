<?php
!defined('DEBUG') AND exit('Forbidden');
$tablepre = $db->tablepre;
$sql = "ALTER TABLE ".$tablepre."group ADD allowTime INT(10) NOT NULL default '0';";
db_exec($sql);
group_list_cache_delete();
?>