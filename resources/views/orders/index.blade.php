@extends('default_users')
@section('contents')
    <h1>订单管理</h1>

    <table class="table table-striped table-hover">
        <tr class="warning">
            <th>订单id</th>
            <th>订单编号</th>
            <th>收货人姓名</th>
            <th>收货人电话</th>
            <th>收货人地址</th>
            <th>订单状态</th>
            <th>下单时间</th>
            <th>订单操作</th>
        </tr>
        @foreach($orders as $order)
            <tr>
                <td>{{$order->id}}</td>
                <td>{{$order->sn}}</td>
                <td>{{$order->name}}</td>
                <td>{{$order->tel}}</td>
                <td>{{$order->address}}</td>
                {{--<td>@if($order->status==-1)已取消@elseif($order->status==3)已发货@else待支付@endif</td>--}}
                <td>{{$order->status}}</td>
                <td>{{$order->created_at}}</td>
                <td>
                    <a href="{{route('orders.show',[$order])}}"><span
                                class="glyphicon glyphicon-eye-open"></span></a>
                    @if($order->status!=-1)
                        <a class="btn bg-success" href="{{route('cleanOrder',[$order])}}">取消订单</a>
                    @else
                        <a class="btn bg-success" href="{{route('sendOrder',[$order])}}">发货</a>
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
        <a href="{{route('CountOrder')}}" class="btn btn-success">本店订单统计</a>
    {{$orders->links()}}
@endsection

