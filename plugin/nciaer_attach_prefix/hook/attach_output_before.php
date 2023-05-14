<?php exit;
$pconfig = kv_get('nciaer_attach_prefix');
if(!empty($pconfig['prefix'])) {
    $attach['orgfilename'] = $pconfig['prefix'].$attach['orgfilename'];
}
