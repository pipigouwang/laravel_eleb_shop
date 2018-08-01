@extends('default_users')
@section('contents')
    <h2>菜品详情</h2>
    @include('_errors')
    <br>
    <br>
        <table class="table table-bordered">
            <tr>
                <td style="font-weight: bold">名称</td>
                <td>{{$menus->goods_name}}</td>
            </tr>
            <tr>
                <td style="font-weight: bold">菜品分类</td>
                <td>{{$menus->menucategory->name}}</td>
            </tr>
            <tr>
                <td style="font-weight: bold">价格</td>
                <td>{{$menus->goods_price}}元</td>
            </tr>
            <tr>
                <td style="font-weight: bold">商品图片</td>
                <td><img src="{{$menus->goods_img}}" alt="" width="100px"></td>
            </tr>
            <tr>
                <td style="font-weight: bold">评分</td>
                <td>{{$menus->rating}}</td>
            </tr>
            <tr>
                <td style="font-weight: bold">月销量</td>
                <td>{{$menus->month_sales}}</td>
            </tr>
            <tr>
                <td style="font-weight: bold">评分数量</td>
                <td>{{$menus->rating_count}}</td>
            </tr>
            <tr>
                <td style="font-weight: bold">满意度数量</td>
                <td>{{$menus->satisfy_count}}</td>
            </tr>
            <tr>
                <td style="font-weight: bold">满意度评分</td>
                <td>{{$menus->satisfy_rate}}</td>
            <tr>
                <td style="font-weight: bold">描述</td>
                <td>{{$menus->description}}</td>
            </tr>
            <tr>
                <td style="font-weight: bold">提示信息</td>
                <td>{{$menus->tips}}</td>
            </tr>
        </table>
    @stop