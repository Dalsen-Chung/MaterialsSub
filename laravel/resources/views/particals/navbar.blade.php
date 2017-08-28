<nav class="navbar  navbar-inverse navbar-static-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#" draggable="false">
                <img src="{{ asset('images/logo.png') }}" class="logo" alt="" draggable="false">
            </a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right" style="text-align: center;">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">用户登录<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">学生登录</a></li>
                        <li><a href="#">教师登录</a></li>
                        <li><a href="#">教务登录</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">管理员登录</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div><!-- /.container-fluid -->
</nav>