<nav class="navbar  navbar-inverse navbar-static-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ config('system.schoolLink') }}" target="view_window" draggable="false">
                <img src="{{ asset('images/logo.png') }}" class="logo" alt="" draggable="false">
            </a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right" style="text-align: center;">
                <li><a href="{{ url('/') }}">系统文档</a></li>
                @if(Session::get('username'))
                    <li><a href="#">{{ Session::get('username') }}</a></li>
                    <li><a href="#">退出登录</a></li>
                @else
                    <li><a href="{{ url('/login') }}">用户登录</a></li>
                @endif
            </ul>
        </div>
    </div><!-- /.container-fluid -->
</nav>