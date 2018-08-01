@extends('default_users')

@section('contents')



    <table class="table table-bordered table-responsive">
        <tr>
            <th>ID</th>
            <th>名称</th>
            <th>随机字符串</th>
            <th>描述</th>
            {{--<th>店铺名</th>--}}
            <th>是否默认分类</th>
            <th>操作</th>
        </tr>
        @foreach($menucategories as $menucategory)
            <tr>
                <td>{{ $menucategory->id }}</td>
                <td>{{ $menucategory->name}}</td>
                <td>{{ $menucategory->type_accumulation}}</td>
                <td>{{ $menucategory->description}}</td>
                {{--<td>{{ $menucategory->shopss_name()}}</td>--}}
                <td>{{ $menucategory->is_selected?'是':'否'}}</td>
                <td>
                    <a href="{{ route('menucategory.edit',[$menucategory])}}">编辑</a>
                    <form method="post" action="{{ route('menucategory.destroy',[$menucategory]) }}">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button class="btn btn-warning btn-xs">删除</button>
                    </form>
                </td>
            {{--</tr>--}}
        @endforeach
    </table>
    {{--{{$users->appends(['keyword'=>$keyword])->links() }}--}}
    <a href="{{route('menucategory.create')}}"><button class="btn btn-info" >添加</button></a>
@endsection

