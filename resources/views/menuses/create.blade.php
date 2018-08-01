@extends('default_users')
@section('css_files')
    <link rel="stylesheet" type="text/css" href="/webuploader/webuploader.css">
    @stop
@section('js_files')
    <script type="text/javascript" src="/webuploader/webuploader.js"></script>
    @include('vendor.ueditor.assets')
    @stop
@section('contents')
    <h2>添加菜品</h2>
    @include('_errors')
    <br>
    <br>
    <form action="{{route('menuses.store')}}" method="post" enctype="multipart/form-data">
        <table class="table table-bordered">
            <tr>
                <td>名称</td>
                <td><input type="text" name="goods_name" class="form-control" value="{{old('goods_name')}}" placeholder="必填"></td>
            </tr>
            <tr>
                <td>菜品分类</td>
                <td>
                    <select name="category_id" id="" class="form-control" >
                        <option value="">请选择</option>
                        @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                    </select>
            </tr>
            <tr>
                <td>价格</td>
                <td>
                    <input type="number" name="goods_price" class="form-control" placeholder="必填" value="{{old('goods_price')}}">
                </td>
            </tr>
            {{--<tr>--}}
                {{--<td>商品图片</td>--}}
                {{--<td>--}}
                {{--</td>--}}
            {{--</tr>--}}
            <tr id="uploader-demo">
                <!--用来存放item-->
                <td id="fileList" class="uploader-list"></td>
                <input type="hidden" name="goods_img" id="img_url" >
                <td id="filePicker">选择图片</td>
                <img id="img" width="200px">
            </tr>
            <tr>
                <td>描述</td>
                <td>
                    {{--<input type="text" name="description" class="form-control" value="{{old('description')}}" placeholder="可不填">--}}
                    <script id="container" name="description" type="text/plain"></script>
                </td>
            </tr>
            <tr>
                <td>提示信息</td>
                <td>
                    <input type="text" name="tips" class="form-control" value="{{old('tips')}}" placeholder="可不填">
                </td>
            </tr>

            <tr>
                <td></td>
                <td><button type="submit" class="btn btn-primary">提交</button></td>
            </tr>
            {{csrf_field()}}
        </table>
    </form>
    @stop
@section('js')
    <script>
    // 初始化Web Uploader
    var uploader = WebUploader.create({

    // 选完文件后，是否自动上传。
    auto: true,

    // swf文件路径
   // swf: BASE_URL + '/js/Uploader.swf',

    // 文件接收服务端。
    server: "{{route('upload')}}",

    // 选择文件的按钮。可选。
    // 内部根据当前运行是创建，可能是input元素，也可能是flash.
    pick: '#filePicker',
    // 只允许选择图片文件。
    accept: {
    title: 'Images',
    extensions: 'gif,jpg,jpeg,bmp,png',
    mimeTypes: 'image/jpg,image/jpeg,image/png,image/gif,image/bmp'
    },
        formData:{
            _token:'{{ csrf_token() }}'
        }
    });
    uploader.on( 'uploadSuccess', function( file,response ) {
        // do some things.
        //response.fileName
        //console.log(response);
        $("#img").attr('src',response.fileName);
        $("#img_url").val(response.fileName);
    });
    var ue = UE.getEditor('container');
    ue.ready(function() {
        ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
    });
    </script>
    @stop