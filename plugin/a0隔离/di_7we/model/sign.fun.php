<?php 

// 获取sign
function getSign($secret, $data) {
    // 对数组的值按key排序
    ksort($data);
    // 生成url的形式
    $params = http_build_query($data);
    // 生成sign
    $sign = md5($params . $secret);
    return $sign;
}



 ?>