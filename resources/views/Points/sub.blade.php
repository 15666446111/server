@extends('layouts.app')

@section('title')
填写报单
@endsection


@section('content')

<div class="public_title">
    <img src="{{ asset('images/back.png') }}?t={{ time() }}" onclick="history.back();">
    填写报单
</div>

<div class="weui-tab detail_box" style="background-color: #f0eff4;">

    <div class="fo-ti">产品类别</div>

    <div class="fo-type-list">
        <ul class="fo-type-ul">
            @foreach($productList as $pl)
            <li class="fo-type-li">
                <p>
                    <input type="radio" class="fo-redio" name="goods" value="{{ $pl->id }}">{{ $pl->title }}
                </p>
            </li>
            @endforeach
        </ul>
    </div>

    @if($product->demo != "")
    <div class="fo-ti">截图示范</div>
    <div class="fo-cash">
        <!-- <img src="/public/zhangsucai/image/cash.png" class="fo-picture"> -->
        <img src="{{ $product->getDemo() }}" class="fo-picture">
    </div>

    <div class="fo-cash-big" style="display: none;">
        <img src="{{ $product->getDemo() }}" class="fo-picture-big">
    </div>
    @endif

    <div class="fo-ti">上传截图</div>
    <div class="fo-cash">
        <div class="z_photo">
            <div class="z_file" data-value="3">
                <input type="file" name="voucher" id="voucher" class="file" value="" accept="image/*" onchange="imgChange('z_photo','0',this);">
                <img src="{{ asset('images/z_add.png') }}?t={{ time() }}" class="photo" data-value="0">
            </div>
        </div>
    </div>

    <div class="fo-foot">
        <div class="fo-foot-ti">兑换码</div>
        <div class="fo-text">
            <textarea name="code" placeholder="输入订单号后8位"></textarea>
        </div>
        <div class="fo-foot-ti">备注</div>
        <div class="fo-text fo-remarks">
            <input type="text" name="msg" placeholder="无特殊需求请勿填写">
        </div>
        <button class="fo-submit">提 交</button>
    </div>
</div>

@endsection


@section('scripts')
<script type="text/javascript">
$(function(){
    var radio = $('input[type="radio"]'),   
        picture = $('.fo-picture'),         //样例
        cash = $('.fo-cash-big')
    radio.on('change', function(){
        $('.fo-type-li p').removeClass('fo-active');
        $(this).parent().addClass('fo-active');
    })
    // 样例
    picture.on('click', function(){
        var src = $(this).attr('src');
        $('.fo-picture-big').attr('src', src);
        cash.show();
    })
    cash.on('click', function(){
        cash.hide();
    });

    $(".fo-submit").click(function(){
        $.showLoading();
        //$(thi).attr('disabled', true);
        var goods   = $('input[name="goods"]:checked').val();
        var code    = $('textarea[name="code"]').val();
        var msg     = $('input[name="msg"]').val();

        if (goods == undefined) {
            $.hideLoading();
            $.toast("请选择产品类别", "text");
            //$(thi).removeAttr('disabled', true);
            return false;
        }
        if (code == '') {
            $.hideLoading();
            $.toast("请输入兑换码", "text");
            //$(thi).removeAttr('disabled', true);
            return false;
        }
        // console.log(code);return false;
        formData.append('product', goods);
        formData.append('code', code);
        formData.append('msg', msg);
        formData.append('merchant', "{{ request()->merchant }}");
        formData.append('ident', "{{ request()->ident }}");
        $.ajax({
            type : 'POST',
            url  : "/points/sub-order",
            cache: false,
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success : function(result) {
                console.log(result.code)
                if(result.code != 10000){
                    $.hideLoading();
                    $.toast(result.message, "text");
                    return false;  
                }

                $.modal({
                    title: "报单成功!",
                    text: "是否继续报单?",
                    buttons: [
                        { text: "继续", onClick: function(){ location.reload(); } },
                        { text: "取消", className: "default", onClick: function(){ history.go(-1) }},
                    ]
                });
            }
        })   
    })
})


    function imgChange(obj1, obj2, obj, e) {
        //获取点击的文本框
        // var file = document.getElementById("file");
        var file = $('.file');
        //存放图片的父级元素
        var imgContainer = document.getElementsByClassName(obj1)[0];
        //获取的图片文件
        var fileList = file[obj2].files;
        //文本框的父级元素
        var imgArr = [];
        var dataValue = '';

        //遍历获取到得图片文件
        for (var i = 0; i < fileList.length; i++) {
            var imgUrl = window.URL.createObjectURL(file[obj2].files[i]);
            imgArr.push(imgUrl);

            $(".z_file img").eq(obj2).attr({
                'src'       : imgArr[i],
                'data-value': '1'
            });
            $(".z_file input").eq(obj2).css({
                'background-color' : 'rgba(0,0,0,0)'
            });
        };
        // n++;
        e = e || window.event;
    　　if(typeof FileReader==='undefined'){
        　　return alert('你的浏览器不支持上传图片哟!');
    　　}
    　　var files=e.target.files;
        // console.log(e);
    　　if(files.length>0){
            imgResize(files[0],callback,obj);
    　　}
    };

    function imgResize(file,callback,obj){
        // 加载动画
        $('.main').css('display','block');
        $('.loading_zzc').css('display','block');
        // setTimeout("tishi('文件正在读取中..')",2000);
        var fileReader=new FileReader();
        fileReader.onload=function(){
            $('.main').css('display','none');
            $('.loading_zzc').css('display','none');
            var IMG=new Image();
            IMG.onload=function(){
                var initSize = IMG.src.length;
                var width=this.naturalWidth,height=this.naturalHeight,resizeW=0,resizeH=0;
                //    用于压缩图片的canvas
                var canvas=document.createElement('canvas'),
                ctx=canvas.getContext('2d');

                //    瓦片canvas
                var tCanvas = document.createElement("canvas");
                var tctx = tCanvas.getContext("2d");
                //如果图片大于四百万像素，计算压缩比并将大小压至400万以下
                var ratio;
                if ((ratio = width * height / 4000000) > 1) {
                  ratio = Math.sqrt(ratio);
                  width /= ratio;
                  height /= ratio;
                } else {
                  ratio = 1;
                }

                canvas.width = width;
                canvas.height = height;

                //铺底色
                ctx.fillStyle = "#fff";
                ctx.fillRect(0, 0, canvas.width, canvas.height);

                //如果图片像素大于100万则使用瓦片绘制
                var count;
                if ((count = width * height / 1000000) > 1) {
                  count = ~~(Math.sqrt(count) + 1); //计算要分成多少块瓦片

                //计算每块瓦片的宽和高
                  var nw = ~~(width / count);
                  var nh = ~~(height / count);

                  tCanvas.width = nw;
                  tCanvas.height = nh;

                  for (var i = 0; i < count; i++) {
                    for (var j = 0; j < count; j++) {
                      tctx.drawImage(IMG, i * nw * ratio, j * nh * ratio, nw * ratio, nh * ratio, 0, 0, nw, nh);

                      ctx.drawImage(tCanvas, i * nw, j * nh, nw, nh);
                    }
                  }
                } else {
                  ctx.drawImage(IMG, 0, 0, width, height);
                }

                //进行最小压缩
                var ndata = canvas.toDataURL('image/jpeg', 0.2);

                tCanvas.width = tCanvas.height = canvas.width = canvas.height = 0;
                convertBlob(window.atob(ndata.split(',')[1]),callback,obj,file);
            }
            IMG.src=this.result;
        }
        fileReader.readAsDataURL(file);
　　 }

    // 安卓手机不支持Blob构造方法
　　function convertBlob(base64,callback,obj,file){
        var buffer=new Uint8Array(base64.length);
    　　 for(var i=0;i<base64.length;i++){
            buffer[i]=base64.charCodeAt(i)
    　　 }

    　　 var blob;
    　　 try{
            blob=new Blob([buffer],{type:'image/jpeg'});
    　　 }catch(e){
        　　 window.BlobBuilder=window.BlobBuilder||window.WebKitBlobBuilder||window.MozBlobBuilder||window.MSBlobBuilder;
        　　 if(e.name==='TypeError'&&window.BlobBuilder){
            　　 var blobBuilder=new BlobBuilder();
            　　 blobBuilder.append(buffer);
                blob=blobBuilder.getBlob('image/jpeg');
        　　 }
    　　 }
        callback(blob,obj,file)
　　 }

    var formData = new FormData();
    
    function callback(fileResize,obj,file){
        var id = obj.id;
        formData.append(id, fileResize, file['name']);
　　 }


    $(".photo").click(function(){
        $("#voucher").click();
    }); 

</script>
@endsection
