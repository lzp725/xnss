/**
 * 获取ip归属地
 *
 * @param string $ip
 * @return string
 */
function get_ip_city_post($pid,$ip) {
    if ($ip == '0') {
        $location_db="未知";
        post__update($pid, array('location_post'=>$location_db));
        return $location_db;
        }
    else {
    $ch = curl_init();
    $url = 'https://whois.pconline.com.cn/ipJson.jsp?ip=' . long2ip($ip);
    //用curl发送接收数据
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //请求为https
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    $location = curl_exec($ch);
    curl_close($ch);
    //转码
    $location = mb_convert_encoding($location, 'utf-8', 'GB2312');
    //var_dump($location);
    //截取{}中的字符串
    $location = substr($location, strlen('({') + strpos($location, '({'), (strlen($location) - strpos($location, '})')) * (-1));
    //将截取的字符串$location中的‘，’替换成‘&’   将字符串中的‘：‘替换成‘=’
    $location = str_replace('"', "", str_replace(":", "=", str_replace(",", "&", $location)));
    //php内置函数，将处理成类似于url参数的格式的字符串  转换成数组
    parse_str($location, $ip_location);
    if ($ip_location['proCode'] != '999999') {
        $location_db=$ip_location['pro'];
        
    } else  {
        
        $location_db=$ip_location['addr'];
        
    }
    
    post__update($pid, array('location_post'=>$location_db));
    return $location_db;
}
}
