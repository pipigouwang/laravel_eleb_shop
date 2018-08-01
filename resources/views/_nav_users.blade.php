<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            {{--<a class="navbar-brand" href="{{route('shops.index')}}">商家信息管理</a>--}}
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        {{--以下是分类导航--}}
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                {{--<li class="active"><a href="{{route('shopscategory.index')}}">店铺分类管理<span class="sr-only">(current)</span></a></li>--}}
                {{--<li><a href="{{ route('addStudent') }}">添加学生</a></li>--}}
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">菜单栏<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('menucategory.index')}}">菜品分类</a></li>
                        <li><a href="{{route('menuses.index')}}">菜品表</a></li>
                        <li><a href="{{route('orders.index')}}">订单管理</a></li>
                        {{--<li><a href="#">Separated link</a></li>--}}
                        {{--<li role="separator" class="divider"></li>--}}
                        {{--<li><a href="#">One more separated link</a></li>--}}
                    </ul>
                </li>
            </ul>
            <form class="navbar-form navbar-left" action="">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search" name="keyword">
                </div>
                <button type="submit" class="btn btn-default">搜索</button>
            </form>
            <ul class="nav navbar-nav navbar-right">
                {{--游客登录--}}
                @guest
                <li><a href="{{route('login')}}" >登录</a></li>
                @endguest
                @auth
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{auth()->user()->name}}<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        {{--<li><a href="{{route('users.index')}}">用户中心</a></li>--}}
                        {{--<li><a href="">个人中心</a></li>--}}
                        <li><a href="">修改个人密码</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>
                        <li>
                            <form method="get" action="{{route('logout')}}">
                                {{csrf_field()}}
                                {{--{{method_field('DELETE')}}--}}
                                <button class="btn btn-link btn-info">注销</button>
                            </form></li>
                    </ul>
                </li>
                @endauth
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
