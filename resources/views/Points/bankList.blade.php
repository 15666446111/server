@extends('layouts.app')

@section('title')
积分兑换
@endsection


@section('content')
<div class="public_title">
    <img src="{{ asset('images/back.png') }}?t={{ time() }}" onclick="history.back();">
    积分兑换
</div>

<div class="weui-tab" style="width: 96%; margin: 0 auto;">
    <!--Plug-->
    <div class="swiper-container" style="width: 96%;">
        <div class="swiper-wrapper">
            
            <div class="swiper-slide">
                <img style="width: 100%; height: 200px;" src="https://ss2.bdstatic.com/70cFvnSh_Q1YnxGkpoWK1HF6hhy/it/u=2307511656,3386189028&fm=26&gp=0.jpg" alt="申请信用卡">
            </div>
            
            <div class="swiper-slide">
                <img style="width: 100%; height: 200px;" src="https://ss0.bdstatic.com/70cFuHSh_Q1YnxGkpoWK1HF6hhy/it/u=2515911597,1913645471&fm=26&gp=0.jpg" alt="申请信用卡">
            </div>

        </div>
    </div>

	<div class="weui-flex page_title">
	  	<h2>支持银行<i class="fa fa-fire" aria-hidden="true"></i></h2>
	</div>


	<div class="weui-grids">

		@foreach($list as $li)
	  	<a href="/points/porduct/{{request()->merchant}}/{{request()->ident}}/{{$li->id}}" class="weui-grid js_grid">
	    	<div class="weui-grid__icon"> <img src="{{ $li->getIcon() }}" alt="{{ $li->title }}"> </div>
	    	<p class="weui-grid__label bold"> {{ $li->title }} </p>
	    	<p class="weui-grid__label"> <code>{{ $li->getFirstLigHeight() }}</code> </p>
	    	<p class="weui-grid__label liheight"> {{ $li->pip }}</p>
	    	<p class="weui-grid__label price">{{ $li->getMoneyFormat() }}元/1万积分</p>
	    	@if($li->recommand == '1')
	    	<p class="recommand"> 推荐 </p>
	    	@endif
	  	</a>
	  	@endforeach
	</div>

</div>
@endsection


@section('scripts')

@endsection
