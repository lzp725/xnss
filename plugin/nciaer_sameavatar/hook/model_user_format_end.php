<?php exit;
$pconfig = kv_get('nciaer_sameavatar');
if(!empty($pconfig['avatar'])) {
    $user['avatar_url'] = $pconfig['avatar'];
    $user['avatar_path'] = $pconfig['avatar'];
}
