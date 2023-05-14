<?php
!defined('DEBUG') AND exit('Forbidden');


$tablepre = $db->tablepre;
$sql_delete_post = "UPDATE ".$tablepre."post SET `location_post` = '0' WHERE 1;";
db_exec($sql_delete_post);

$sql_delete_thread = "UPDATE ".$tablepre."thread SET `location_tr` = '0' WHERE 1;";
db_exec($sql_delete_thread);


?>

