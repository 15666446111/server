@extends('layouts.app')

@section('title')
积分兑换
@endsection


@section('content')

<div class="public_title">
    <img src="{{ asset('images/back.png') }}?t={{ time() }}" onclick="history.back();">
    积分兑换
</div>

<div class="weui-tab detail_box" style="background-color: #f0eff4; height: auto; min-height: 92.5vh;">


	@foreach($product as $p)

	<div class="c-goods">
        <div class="co-go-li">
            <a href="/points/details/{{ request()->merchant }}/{{ request()->ident }}/{{$p->id}}">
                <div class="co-li-t">
                    <p class="tl">{{ $p->title }}</p>
                    <p class="tr">去兑换<img src="{{ asset('images/convert-zhi.png') }}?t={{ time() }}"></p>
                </div>
                <ul class="co-li">
                    <li>兑换方式</li>
                    <li>起兑积分</li>
                    <li>兑换次数</li>
                    <li>积分价值</li>
                </ul>
                <ul class="co-li co-li-b">
                    <li class="active">{{ $p->getType() }}</li>
                    <li>{{ $p->need_points }}</li>
                    <li>{{ $p->change_count }}</li>
                    <li>{{ $p->getProductMoneyFormat() }}元</li>
                </ul>
                @if($p->recommand)
                <div class="tuijian">推荐</div>
                @endif
            </a>
        </div>
        <div class="co-num" data-start="100000" data-price="13.00">
            可兑：<span class="co-num-t">可兑金额在下方算一算</span>
        </div>
    </div>
    @endforeach


	<div class="co-compute">
        <div class="co-cin">
            <p class="co-c-img"><img src="{{ asset('images/jifen.png') }}?t={{ time() }}"></p>
            <p class="co-c-inte"><input type="number" name="integral" placeholder="请输入积分"></p>
            <p class="co-c-b" onclick="intQuery()">查询</p>
        </div>
    </div>


	<div class="co-qu">
        <div class="co-qu-ti">查询积分</div>
        <div class="co-qu-te">{{ $bank->select_type }}</div>
    </div>
</div>

@endsection


@section('scripts')

@endsection
