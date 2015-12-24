var liupload = {
        options : {
            browse_button: '',
            url: 'upload.php',
            multi_selection: false,
            flash_swf_url : '/assets/js/pl/Moxie.swf',
            silverlight_xap_url : '/assets/js/pl/Moxie.xap'
        },
        count : 0,
        upload : {},
        uploadPl : {},
        init : function(options){
            var _this = this;

            $.extend(this.options,options)
            _this.upload = $(".liupload");
            _this.count = this.upload.length;

            _this.upload.each(function(i){
                var target = 'liupload_'+i;
                $(this).addClass(target);
                $(this).after('<div class="btn-upload"><a class="btn btn-default" href="#" role="button" id="'+target+'" data-target="'+target+'">上传</a><span class="alert"></span></div>');

                _this.options.browse_button=target;

                _this.uploadPl[i] = new plupload.Uploader(_this.options);
                _this.uploadPl[i].init();
                _this.uploadPl[i].bind('FilesAdded', function(up, files) {
                    _this.uploadPl[i].start();
                });
                _this.uploadPl[i].bind('UploadProgress', function(up, files) {
                    $(_this.upload[i]).siblings(".alert").text("上传中...");
                });
                _this.uploadPl[i].bind('FileUploaded', function(up, files, res) {
                    var json = jQuery.parseJSON(res.response);
                    if(json.error == 1)
                    {
                        $(_this.upload[i]).siblings(".alert").text("上传失败");
                    }
                    else
                    {
                        $("."+$('#liupload_'+i).attr("data-target")).val(json.file);
                        $(_this.upload[i]).siblings(".alert").text("上传成功");
                    }
                });
            });
        }
    };