@extends('layouts.app')

@section('title')
兑换详情
@endsection


@section('content')

<div class="public_title">
    <img src="{{ asset('images/back.png') }}?t={{ time() }}" onclick="history.back();">
    兑换详情
</div>

<div class="weui-tab detail_box" style="padding-top: 44px;">
    <img class="de-banner" src="{{ asset('images/banner-de.png') }}?t={{ time() }}" alt="">

    <div class="de-step">
        <p class="de-s-ti">步骤兑换详情</p>
        <div class="product_content">
            {!! $product->content !!}
        </div>
    </div>




    <div class="zzc"></div>
    <div class="tcc">
        <img src="{{ asset('images/close.png') }}?t={{ time() }}" class="tc-hide" onclick="kefu_hide()">
        <p class="tc-ti">长按识别二维码添加好友</p>
        <p class="tc-wxcode"><img src="{{ asset('images/kefu.png') }}?t={{ time() }}"></p>
        <p class="tc-bank">积分兑换客服</p>
        <p class="tc-tips">客服工作时间：周一至周六</p>
        
        <p class="tc-tips">8：30 - 12:00&nbsp;&nbsp;&nbsp;&nbsp;13:00 - 21:00</p>
        <p class="tc-tips">非工作时间请耐心等待</p>
    </div>

    @if($product->change_type == '0')
    <div class="de-foot">
        <p class="de-fo" style="width: 100%">
            <a href="/points/sub/{{ request()->merchant }}/{{ request()->ident }}/{{ $product->id }}">立即报单</a>
        </p>
    </div>
    @else
    <div class="de-foot">
        <p class="de-ser" onclick="deform()">
            <img src="{{ asset('images/wx.png') }}?t={{ time() }}">
        </p><p class="de-fo">
            <a href="javascript:;" onclick="deform()">联系客服</a>
        </p>
    </div>
    @endif

</div>

@endsection


@section('scripts')
    <script type="text/javascript">
        $(function(){
            var orderNo = "";
        })

        function deform(){
            $('.zzc').show();
            $('.tcc').show();
        }

        function kefu_hide() {
            $('.zzc').hide();
            $('.tcc').hide();
        }
        
    </script>
@endsection
