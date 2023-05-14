<?php
!defined('DEBUG') AND exit('Forbidden');
$tablepre = $db->tablepre;
$sql1 = "ALTER TABLE ".$tablepre."post ADD location_post CHAR(200) NOT NULL default '0';";
db_exec($sql1);
$sql2 = "ALTER TABLE ".$tablepre."thread ADD location_tr CHAR(200) NOT NULL default '0';";
db_exec($sql2);

?>