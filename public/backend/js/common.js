(function($, win){    
    if(typeof $ == "undefined") return false;

    //动态Modal 隐藏后设空
    var layerIndex = 0;
    $('#php-ajax-modal,#php-ajax-modal-small').on('hidden.bs.modal',function(){
        $(this).find('.modal-content').html("");
    }).on('show.bs.modal',function(){
        layerIndex = layer.load();
    }).on('shown.bs.modal', function(){
        layer.close(layerIndex);
    });
    //静态Modal 重置form
    $('#local-modal').on('hidden.bs.modal',function(){
        $(this).find('form').trigger('reset');
    });

    // 系统配置
    var config = {
        dictURL: '/admin/dictionaries/hasmanydictionaries' //获取字典下拉数据
        , fileUploadURL: '/admin/attachment/upload' //文件上传接口
        , fileSWFURL: '/vendor/webuploader-0.1.5/Uploader.swf' // 上传插件需要的 swf 文件
    };
    // 数据缓存
    var cache = {

    };

    // 系统方法
    var pv = {
        /**
         * 初始化系统全局方法
         * @return {[type]} [description]
         */
        init: function(){
            pv.rendre.renderDict();
        },
        /**
         * 公共的 ajax 请求
         * @param  {[type]}   opts     ajax 请求配置参数
         * @param  {[type]}   loading  是否请求显示 loading 状态，默认为 true
         * @return {[type]}            [description]
         */
        ajax: function(opts,loading){
            var loading = loading || true;
            var index = null;
            var opts_def = {};
            var def = {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name=_token]').attr('content')
                }
            }

            if(loading) (typeof layer != "undefined") && (index = layer.load());

            opts_def = $.extend({},def, opts,true);
        
            $.ajax(opts_def).always(function(){
                if(index != null) layer && layer.close(index);
            });
        },
        /**
         * 页面 dom 常用公共事件监听
         * @type {Object}
         */
        events: {
        },
        /**
         * 页面dom常用渲染库
         * @type {Object}
         */
        rendre: {
            /**
             * 通用 select option 渲染
             * @param  {[type]} el   [description]
             * @param  {[type]} data [description]
             * @param  {[type]} opts [description]
             * @return {[type]}      [description]
             */
            optionFn: function(el, data, opts){
                if(el == undefined || el.length <= 0) return;

                var def_cfg = {
                    name: 'name',
                    value: 'value'
                }
                var buff  = '';
                var opt = $.extend({}, def_cfg, opts, true);

                for(var i = 0; i < data.length; i++){
                    var d = data[i];
                    buff += '<option value="'+d[opt.name]+'">'+d[opt.value]+'</option>'
                }
                el.html(buff);
            },
            /**
             * 渲染需要使用字典库的 select
             * @param  {[type]} el [description]
             * @return {[type]}    [description]
             */
            renderDict: function(el){
                var params = [];
                var el = el || $(document);
                el.find('select[data-dict]').each(function(){
                    params.push($(this).attr("data-dict"));
                });
                pv.getDict(params, el);
            }
        },
        /**
         * 获取字典库数据
         * @param  {[type]} arrParams [description]
         * @param  {[type]} el        [description]
         * @return {[type]}           [description]
         */
        getDict: function(arrParams, el){
            if(arrParams == undefined || arrParams.length <=0) return false;
            var el = el || $(document);
            var renderSelectFn = function(data){
                for(var i in data){
                    var ele = $('select[data-dict="'+i+'"]',el);
                    var val = ele.attr("data-value");
                    var option = '';

                    for(var j = 0; j < data[i].length; j++){
                        var d = data[i][j];
                        var selected = d.id == val ? 'selected' : '';
                        option += '<option value="'+d.id+'" ' + selected + ' >'+d.sub_chinese+'</option>';
                    }
                    ele.html(option);
                }
            }
            pv.ajax({
                url: config.dictURL,
                type: 'GET',
                data: {
                    chinese : arrParams
                },
                success: function(resp){
                    if(resp.result){
                        renderSelectFn(resp.data);
                    }
                }
            })  
        },
        /**
         * 文件上传功能
         * @param  {[type]}   el       [description]
         * @param  {[type]}   opts     [description]
         * @param  {Object} callbackOpts [description]
         * @return {[type]}            [description]
         */
        uploadFile: function(el,opts,callbackOpts){
            if(typeof WebUploader == "undefined") return ;
            var selectInput = $('#file-upload-element');
            if(selectInput.length >0){
                selectInput.hide();
            }else{
                selectInput = $('<div id="file-upload-element"></div>').appendTo($('body')).hide();
            }
            // 上传成功后的配置
            var callback_cfg = {
                callback:{},
                // 上传成功回调写入 dom 的数据点
                opts:{
                     "file": 'input[type=file]', // 选中文件的input
                     "value": 'input[name=file_id]', // 回调写入文件id的隐藏input 
                    // "other":[{  //需要存储的其他文件信息格式为
                    //   ele: "", //页面 dom sel
                    //   key: "" //文件返回的数据字段
                    // }] 
                }
            }
            //上传插件配置
            var cfg = {
                server: config.fileUploadURL,
                swf: config.fileSWFURL,
                method: 'POST',
                chunked: false ,// 分片上传关闭
                paste: document.body,
                formData: {
                    _token: $('meta[name=_token]').attr('content')
                },
                accept:{
                    extensions: '',//允许的文件后缀
                    mimeTypes: '*',//允许的文件类型
                },
                pick: {
                    id: '#file-upload-element',
                    label: '点击选择图片'
                }
            }

            var opt = $.extend({}, cfg, opts || {}, true);
            var cOpt = $.extend({}, callback_cfg, callbackOpts || {}, true);

            var callback = cOpt.callback;
            var cOption = cOpt.opts;

            var uploader = WebUploader.create(opt);
            
            //上传进度
            uploader.onUploadProgress = function(){
                console.log(arguments);
            }
            // 开始上传
            uploader.onStartUpload = function(){
                if(callback && callback.startUpload){
                    callback.startUpload.apply(this,arguments);
                }else{
                    layer.msg("开始上传文件！");
                }
            };
            //上传暂停
            uploader.onStopUpload = function(){
                if(callback && callback.stopUpload){
                    callback.stopUpload.apply(this,arguments);
                }else{
                    layer.msg("文件上传暂停！");
                }
            };
            //上传进度
            uploader.onUploadProgress = function(file, percentage){
                if(callback && callback.uploadProgress){
                    callback.uploadProgress.apply(this,arguments);
                }else{
                    console.log(percentage);   
                }
            };
            //上传结束
            uploader.onUploadFinished = function(){
                if(callback && callback.uploadFinished){
                    callback.uploadFinished.apply(this,arguments);
                }
            };
            // 上传成功
            uploader.onUploadSuccess = function(file, resp){
                if(callback && callback.uploadSuccess){
                    callback.uploadSuccess.apply(this,arguments);
                }else{
                    layer.msg("文件上传成功！");
                    console.log(resp);
                }
            }
            return {
                uploader: uploader,
                upload: function(callback, file){
                    if(typeof file !== "undefined"){
                        uploader.addFile(file);
                    }else{
                        var file = $(cOption.file,el);
                        if(file.length >0){
                            uploader.reset();
                            uploader.addFile(file[0].files);
                            uploader.upload();
                            if(callback){
                                // 上传成功
                                uploader.onUploadSuccess = function(file, resp){
                                    callback.apply(this,arguments);
                                }
                            }
                        }else{
                            console.log("未找到对应的file标签!");
                        }
                    }
                }
            };
        },
        /**
         * 原始资料分类
         * @param  {[type]} el  [description]
         * @param  {[type]} url [description]
         * @return {[type]}     [description]
         */
        jsTree: function(el, url){
            if(el.length <= 0) return false;
            return el.jstree({
                "core" : {
                    "multiple": false,
                    "themes" : {
                        "responsive": false
                    },
                    'data' : [
                        {
                            "text" : "上市前药品相关资料", "id": "1","state" : {"opened" : true }, "children" : [
                                { "text" : "通用名A", "id": "1-1", "children": [
                                    { "text": "临床一期", "id": "1-1-1"},
                                    { "text": "临床二期", "id": "1-1-2"},
                                    { "text": "临床三期", "id": "1-1-3"},
                                ]},
                                { "text" : "通用名B", "id": "1-2", "children": [
                                    { "text": "临床一期", "id": "1-2-1"},
                                    { "text": "临床二期", "id": "1-2-2"},
                                    { "text": "临床三期", "id": "1-2-3"},
                                ]},
                            ]
                        },{
                            "text" : "上市后药品相关资料", "id": "2","state" : {"opened" : true }, "children" : [
                                { "text" : "通用名A", "id": "2-1", "children": [
                                    { "text": "临床一期", "id": "2-1-1"},
                                    { "text": "临床二期", "id": "2-1-2"},
                                    { "text": "临床三期", "id": "2-1-3"},
                                ]},
                                { "text" : "通用名B", "id": "2-2", "children": [
                                    { "text": "临床一期", "id": "2-2-1"},
                                    { "text": "临床二期", "id": "2-2-2"},
                                    { "text": "临床三期", "id": "2-2-3"},
                                ]},
                            ]
                        }
                    ]        
                },
                "types" : {
                    "default" : {
                        "icon" : "fa fa-folder icon-state-warning icon-lg"
                    },
                    "file" : {
                        "icon" : "fa fa-file icon-state-warning icon-lg"
                    }
                },
                "plugins": ["types"]
            });
        },
        /**
         * datatable 公共 js 实现方法  
         * @param  {Element} el   datatable el
         * @param  {[type]} opts [description]
         * @param  {[type]} form [description]
         * @return {[type]}      [description]
         *  table class => table table-striped table-bordered table-hover dataTable no-footer white-space-nowrap
         *  
         */
        datatable: function(el, opts,form){
            var cfg = {
                processing: true,
                serverSide: true,
                pagingType: "bootstrap_extended", 
                autoWidth: false, 
                dom: "<'table-responsive't><'row'<'col-md-12 col-sm-12'il<'table-group-actions pull-right'p>>>", 
                language: {
                    url: '/vendor/datatables/lang/zh_CN.json'
                },
                bStateSave:  true,
                drawCallback: function(){
                    PVJs.tableInit.apply(this,arguments);
                }
            }
            var options = $.extend({},cfg,opts,true);
            var table = el.DataTable(options);
            
            if(form){
                form.find('.pv-search-event').click(function(){
                    table.ajax.reload();
                });
            }
            
            return table;
        },
        /**
         * datatable action init
         * @return {[type]} [description]
         */
        tableInit: function(){
            var el = $(this);
            pv.tooltip(el);
            pv.tableAction(el);
            pv.modal(el);
        },
        /**
         * 激活 tooltip 插件
         * @param  {[type]} el 需要激活的 tooltip 范围
         * @return {[type]}    [description]
         */
        tooltip: function(el){
            var el = el || $(document);
            $('[data-toggle*="tooltip"]',el).tooltip({container:'body'});
        },
        /**
         * 激活 modal 插件
         * @param  {[type]} el  el 需要激活的 modal 范围
         * @return {[type]}    [description]
         */
        modal: function(el){
            var el = el || $(document);
            $('[data-toggle*="modal"]',el).each(function(){
                var that = $(this);
                var target = that.attr('data-target');
                var url = that.attr("href");
                if(target.indexOf('php-ajax-modal') > 0){
                    var modalEl = $(target);

                    that.click(function(e){
                        e.stopPropagation();
                        e.preventDefault();
                        console.log(1);
                        var m = modalEl.modal({
                            remote: url,
                            show: true
                        });
                        // $.get(url,function(resp){
                        //     modalEl.find('.modal-content').html(resp);
                        //     m.modal('show');
                        // });
                    })
                }
            })
        },
        /**
         * datatable 内按钮操作
         * @param  {Element}   el      元素范围
         * @param  {Function} callback 操作结束后的回调方法
         * @return {[type]}            [description]
         */
        tableAction: function(el, callback){
            el.find('[data-method="delete"],[data-method="post"],[data-method="get"],[data-method="put"]').each(function(){
                var that = $(this);
                
                var method = that.attr('data-method');
                var url = that.attr('data-url');
                var type = that.attr('data-type');
                var confirm = that.attr('data-confirm');
                var reload = that.attr('data-reload');
                var title = that.attr('title') || that.attr('data-original-title');
                var loading = that.attr('data-loading');
                var elCallback = that.attr('data-callback');// callback 的规则为 page.function


                var ajax = function(){
                    pv.ajax({
                        url: url,
                        type: method,
                        dataType: type,
                        success: function(resp){
                            if(resp.result){
                                layer.msg(resp.message);
                                if(reload){
                                    window.location.reload();
                                }
                                callback && callback.apply(that,[resp,that]);
                               
                                if(elCallback){
                                    var arr_callback = elCallback.split('.');
                                    window[arr_callback[0]][arr_callback[1]](that,arguments);
                                }
                            }
                        }
                    },loading);
                }

                that.click(function(){
                    $('[data-toggle*="tooltip"]').tooltip('hide');
                    if(confirm == undefined){
                        ajax();
                    }else{
                        if(confirm.length >0){
                            layer.confirm(confirm,{
                                btn:["确定", "取消"]
                            },ajax);
                        }else{
                            layer.confirm("您确定执行 [ " + title + " ] 操作！",{
                                btn:["确定", "取消"]
                            },ajax);
                        }
                    }
                });
            });
        },
        /**
         * 轻轻等待loading
         * @param  {String} el Element select
         * @return {[type]}    [description]
         */
        backUI: function(el){
            App.blockUI({
                target: el,
                animate: true
            });
        },
        /**
         * 清除请求等待 如果没有 el 则清楚全部的
         * @param  {String} el Element Select
         * @return {[type]}    [description]
         */
        clearBackUI: function(el){
            if(el){
               App.unblockUI(el); 
            }else{
                $.unblockUI();
            }
        },
        /**
         * 公共的默认激活事件
         * @return {[type]} [description]
         */
        commonEventInit: function(){
            $('button[type="submit"]').click(function(){
                pv.backUI($(this).parents('.form-fit'));
            })
        }
    };

    win.PVJs = pv;
    PVJs.init(); // 初始化系统全局方法
    

})(jQuery,window);