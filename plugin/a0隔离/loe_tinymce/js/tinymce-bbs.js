tinymce.init({
    selector: '#message',
    language: 'zh_CN',
    plugins: 'contextmenu print preview searchreplace autolink directionality visualblocks visualchars fullscreen image link media template code codesample table charmap hr pagebreak nonbreaking anchor insertdatetime advlist lists wordcount imagetools textpattern emoticons autosave bdmap indent2em lineheight  axupimgs',
    toolbar1: 'code | forecolor backcolor bold italic underline strikethrough anchor link |  blockquote subscript superscript removeformat | formatselect | alignleft aligncenter alignright alignjustify outdent indent indent2em |bullist numlist |image media| hr pagebreak |fullscreen',
    // toolbar2: 'emoticons| bdmap lineheight axupimgs ',
    // 段落 styleselect |
    // 字体 fontselect
    // 字体大小 fontsizeselect
    // formatpainter
    contextmenu: "paste | codesample | link image inserttable | cell row column deletetable",
    height: 650,
    min_height: 400,
    content_style: 'img {max-width:100% !important }',
    fontsize_formats: '12px 14px 16px 18px 24px 36px 48px 56px 72px',
    font_formats: '微软雅黑=Microsoft YaHei,Helvetica Neue,PingFang SC,sans-serif;苹果苹方=PingFang SC,Microsoft YaHei,sans-serif;宋体=simsun,serif;仿宋体=FangSong,serif;黑体=SimHei,sans-serif;Arial=arial,helvetica,sans-serif;Arial Black=arial black,avant garde;Book Antiqua=book antiqua,palatino;',
    link_list: [{
            title: '预置链接1',
            value: 'http://www.tinymce.com'
        },
        {
            title: '预置链接2',
            value: 'http://tinymce.ax-z.cn'
        }
    ],
    image_list: [{
            title: '预置图片1',
            value: 'https://www.tiny.cloud/images/glyph-tinymce@2x.png'
        },
        {
            title: '预置图片2',
            value: 'https://www.baidu.com/img/bd_logo1.png'
        }
    ],
    image_class_list: [{
            title: 'None',
            value: ''
        },
        {
            title: 'Some class',
            value: 'class-name'
        }
    ],
    importcss_append: true,
    //自定义文件选择器的回调内容
    file_picker_callback: function(callback, value, meta) {
        if (meta.filetype === 'file') {
            callback('https://www.baidu.com/img/bd_logo1.png', {
                text: 'My text'
            });
        }
        if (meta.filetype === 'image') {
            callback('https://www.baidu.com/img/bd_logo1.png', {
                alt: 'My alt text'
            });
        }
        if (meta.filetype === 'media') {
            callback('movie.mp4', {
                source2: 'alt.ogg',
                poster: 'https://www.baidu.com/img/bd_logo1.png'
            });
        }
    },
    autosave_ask_before_unload: false,

});