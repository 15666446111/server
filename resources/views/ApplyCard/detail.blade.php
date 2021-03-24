@extends('layouts.app')

@section('title')
信用卡申请_卡片详情
@endsection


@section('content')

<div class="public_title">
    <img src="{{ asset('images/back.png') }}?t={{ time() }}" onclick="history.back();">
    信用卡申请
</div>

<div class="weui-tab detail_box">

	<!-- <div class="detail_head">
		<h2> <img src="{{ $card->getIcon() }}" title="{{ $card->title }}" class="detail_head_img" /> {{ $card->title }}</h2>
	</div> -->

	<div class="cl-ti">卡片信息</div>

	<div class="bank-detail-item">
        <a href="" data-pagename="event_card_hhr_list">                    
            <img src="{{ $card->getCardImages() }}" alt="{{ $card->title }}">
            <div class="t">
                <p class="bank-detail-title">{{ $card->title }}</p>
                @if($showprice == 'y')
                <p class="bank-detail-pip">{{ $card->getPip() }} 奖励 <span class="text-red">{{ $card->getMoneyFormat() }}</span>元</p>
                @endif
                <p class="bank-detail-ligheight">
                	@foreach($card->getLigHeight() as $h)
                    <span class="bor">{{ $h }}</span>
                    @endforeach
                </p>
            </div>
        </a>
    </div>

    <div class="cl-ti">详情说明</div>

	<div class="bank-detail-content">
		{!! $card->content !!}
	</div>

</div>

<a href="#" class="cl-sh-b">立即申请</a>



<div class="mask">
    <div class="modal apply-modal">
        <div class="icon close">
        	<i class="fa fa-close" style="color: #a8a8a8"></i>
        </div>
        <div class="title">前置资料</div>
        <div class="body">
            <div class="tip text text-red">
                确保后续填写的申卡表单与当前填写的资料一致,请仔细检查确认，如资料不一致, 将无法结算订单
            </div>
            <!-- 联合登录和opencard不展示以下信息 -->
            <div class="tip text text-red">
                严禁冒用他人身份信息进行信用卡申请操作，畅伙伴将有权追究违法违规合伙人的责任
            </div>
                  
            <div class="info-box">
            	<div class="weui-cells weui-cells_form">
				  	<div class="weui-cell">
				    	<div class="weui-cell__hd"><label class="weui-label">姓名</label></div>
				    	<div class="weui-cell__bd">
				      		<input class="weui-input" type="text" name='name' placeholder="填写要申请人的真实姓名">
				    	</div>
				  	</div>

				  	<div class="weui-cell">
				    	<div class="weui-cell__hd"><label class="weui-label">手机号</label></div>
				    	<div class="weui-cell__bd">
				      		<input class="weui-input" type="number" name='phone' placeholder="此处填写预留手机号">
				    	</div>
				  	</div>

				  	<div class="weui-cell">
				    	<div class="weui-cell__hd"><label class="weui-label">身份证</label></div>
				    	<div class="weui-cell__bd">
				      		<input class="weui-input" type="text" name='idcard' placeholder="填写要申请人身份证号">
				    	</div>
				  	</div>
            	</div>
            </div>

            <a href="javascript:;" class="subForm">
                <div class="btn">下一步</div>
            </a>
        </div>
    </div>
</div>
@endsection


@section('scripts')
<script type="text/javascript">
	$(".subForm").click(function(){
		var name  = $("input[name=name]").val();
		var phone = $("input[name=phone]").val();
		var idcard= $("input[name=idcard]").val();
		if(name == "" || phone == "" || idcard == ""){
			$.alert("请填写资料", "");
			return false;
		}
		$.ajax({
			url: "/ApplyCard/apply/{{ $info['merchant'] }}/{{ $info['ident'] }}/",
			type: "post",
			data: {cardId: "{{ $card->id }}", name: name, phone: phone, idcard: idcard},
			dataType: "json",
			success:function(data){
				data.code != 10000 ? $.alert(data.message, "") : window.location.href="{{ $card->apply_url }}"
			}
		})
	})

	// 关闭弹窗
	$(".fa-close").click(function(){
		$(".mask").css('display', 'none');
	})

	// 展示弹窗
	$(".cl-sh-b").click(function(){
		$(".mask").css('display', 'block');
	})
</script>
@endsection
