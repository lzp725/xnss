
	$html_login = '<p style="padding:16px;margin: 20px 0;border:2px dashed rgb(244 67 54/30%); text-align: center">此处有隐藏内容，请您<a href="'.url('user-login').'" target="_blank" style="font-weight:bold;">登录</a>后查看。</p>';
	$preg_login = preg_match_all('/\[login\](.*?)\[\/login\]/i',$first['message_fmt'],$array);
	if($preg_login){
		for($i=0;$i<count($array[0]);$i++){
			$a = $array[0][$i];
			$b = "<div style='padding:16px;margin: 20px 0;border:2px dashed rgb(244 67 54/30%);'>".$array[1][$i]."</div>";
			if($user){
				$first['message_fmt'] = str_replace($a,$b,$first['message_fmt']);
			}else{
				$first['message_fmt'] = str_replace($a,$html_login,$first['message_fmt']);
			}
		}
	}


	$preg_reply = preg_match_all('/\[reply\](.*?)\[\/reply\]/i',$first['message_fmt'],$array);
	$html_reply = '<p style="padding:16px;margin: 20px 0;border:2px dashed rgb(244 67 54/30%); text-align: center">此处有隐藏内容，请您<a href="'.url('post-create-'.$tid).'" style="font-weight:bold;">回复</a>后查看。</p>';
	$is_reply = db_find_one('post',array('uid'=>$uid,'tid'=>$tid));
	if($preg_reply){
		for($i=0;$i<count($array[0]);$i++){
			$a = $array[0][$i];
			$b = "<div style='padding:16px;margin: 20px 0;border:2px dashed rgb(244 67 54/30%); '>".$array[1][$i]."</div>";
			if($is_reply){
				$first['message_fmt'] = str_replace($a,$b,$first['message_fmt']);
			}else{
				$first['message_fmt'] = str_replace($a,$html_reply,$first['message_fmt']);
			}
		}
	}