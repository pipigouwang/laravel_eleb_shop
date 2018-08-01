@extends('default_users')
@section('contents')
    <form class="navbar-form" method="get" action="{{route('menuses.index')}}">
        <div class="form-group">
            <select name="category_id" class="form-control">
                <option value="">请选择分类</option>
                @foreach($menucategories as $menucatory)
                    <option {{$menucatory->id==$menucatory->category_id?'selected':''}} value="{{$menucatory->id}}">{{$menucatory->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <input type="number" class="form-control" name="min_price" placeholder="最低价格">-
        </div>
        <div class="form-group">
            <input type="number" class="form-control" name="max_price" placeholder="最高价格">
        </div>
        <button type="submit" class="btn btn-default">搜索</button>
    </form>
    <table class="table table-bordered table-responsive">
        <tr>
            <th>ID</th>
            <th>名称</th>
            <th>评分</th>
            <th>所属商家ID</th>
            <th>所属分类ID</th>
            <th>价格</th>
            <th>描述</th>
            <th>月销量</th>
            <th>评分数量</th>
            <th>提示信息</th>
            <th>满意度数量</th>
            <th>满意度评分</th>
            <th>商品图片</th>
            <th>操作</th>
        </tr>
        @foreach($menuses as $menus)
            <tr>
                <td>{{$menus->id}}</td>
                <td>{{$menus->goods_name}}</td>
                <td>{{$menus->rating}}</td>
                <td>{{$menus->shop_category->name}}</td>
                <td>{{$menus->menucategory->name}}</td>
                <td>{{$menus->goods_price}}</td>
                <td>{{$menus->description}}</td>
                <td>{{$menus->month_sales}}</td>
                <td>{{$menus->rating_count}}</td>
                <td>{{$menus->tips}}</td>
                <td>{{$menus->satisfy_count}}</td>
                <td>{{$menus->satisfy_rate}}</td>
                <td align="center"><img class="img-circle" width="100px" src="{{$menus->goods_img}}" /></td>

                <td>
                    <div class="row">
                        <div class="col-xs-2">
                            <a href="{{route('menuses.show',[$menus])}}" class="btn btn-info"><span class="glyphicon glyphicon-eye-open"></span></a>
                        </div>
                        <div class="col-xs-2" style="margin-left: 5px">
                            <a href="{{route('menuses.edit',[$menus])}}" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span></a>
                        </div>
                        <div class="col-xs-2" style="margin-left: 5px">
                            <form action="{{route('menuses.destroy',[$menus])}}" method="post">
                                <button class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
                                {{csrf_field()}}
                                {{method_field('DELETE')}}
                            </form>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
    </table>
    <a href="{{route('menuses.create')}}"><button>添加</button></a>
    {{$menuses->links()}}
@endsection

