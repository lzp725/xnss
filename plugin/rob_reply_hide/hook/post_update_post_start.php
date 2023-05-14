        param("rob-hiddenreplie") == 'on' ? $rep_hide = true : $rep_hide = false;
        $r = db_update('post', array('pid'=>$pid),array('reply_hide'=>$rep_hide));
        $r === FALSE AND message(-1, lang('create_post_failed'));