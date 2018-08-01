@extends('default_users')
@section('contents')
    <h1>查看订单信息</h1>
    {{--<a class="btn bg-info" href="{{route('countOrder',[$order])}}">订单统计</a>--}}
    <table class="table table-bordered table-responsive">
        <tr class="success">
            <th>订单id</th>
            <th>订单编号</th>
            <th>收货人</th>
            <th>收货人电话</th>
            <th>收货人详细地址</th>
            <th>订单总价(元)</th>
            <th>订单状态</th>
            <th>订单生成时间</th>
        </tr>
        <tr>
            <td>{{$order->id}}</td>
            <td>{{$order->sn}}</td>
            <td>{{$order->name}}</td>
            <td>{{$order->tel}}</td>
            <td>{{$order->address}}</td>
            <td>{{$order->total}}</td>
            <td>{{$order->status}}</td>
            <td>{{$order->created_at}}</td>
        </tr>
    </table>
    <h1>商品信息</h1>
    <table class="table table-bordered table-responsive">
        <tr class="success">
            <th>商品id</th>
            <th>商品名字</th>
            <th>商品价格</th>
            <th>商品数量</th>
            <th>商品图片</th>
        </tr>
        @foreach($ordergoods as $good)
            <tr>
                <td>{{$good->id}}</td>
                <td>{{$good->goods_name}}</td>
                <td>{{$good->goods_price}}</td>
                <td>{{$good->amount}}</td>
                <td><img width="100px;" src="{{$good->goods_img}}" ></td>
            </tr>
        @endforeach
    </table>
    @if($order->status!=-1)
        <a class="btn bg-success" href="{{route('cleanOrder',[$order])}}">取消订单</a>
    @else
        <a class="btn bg-success" href="{{route('sendOrder',[$order])}}">发货</a>
    @endif
@endsection
