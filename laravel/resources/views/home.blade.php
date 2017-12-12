@extends('layouts.app')

@section('jumbotron')
    @include('particals.jumbotron')
@endsection

@section('technology-content')
        <h3 class="text-center">系统开发所用技术</h3>
        <div class="technology clearfix">
            <div class="animated  bounceInUp">
                <img src="{{ asset('images/laravel.png') }}" alt="">
                <div class="Itemtext">
                    <div>
                        {{ config('system.laravel-text') }}
                    </div>
                    <button type="button" class="btn btn-block btn-laravel" value="1" onclick="jump(this.value)">Laravel</button>
                </div>
            </div>
            <div class="animated  bounceInUp" id="vue">
                <img src="{{ asset('images/vue.png') }}" alt="">
                <div class="Itemtext">
                    <div>
                        {{ config('system.vue-text') }}
                    </div>
                    <button type="button" class="btn btn-block btn-vue" value="2" onclick="jump(this.value)">Vue.js</button>
                </div>
            </div>
            <div class="animated  bounceInUp" id="bootstrap">
                <img src="{{ asset('images/Bootstrap.png') }}" alt="">
                <div class="Itemtext">
                    <div>
                        {{ config('system.bootstrap-text') }}
                    </div>
                    <button type="button" class="btn btn-block btn-boot" value="3" onclick="jump(this.value)">Bootstrap</button>
                </div>
            </div>
            <div class="animated  bounceInUp" id="mysql">
                <img src="{{ asset('images/mysql.png') }}" alt="">
                <div class="Itemtext">
                    <div>
                        {{ config('system.mysql-text') }}
                    </div>
                    <button type="button" class="btn btn-block btn-mysql" value="4" onclick="jump(this.value)">Mysql</button>
                </div>
            </div>
        </div>
    @endsection

@section('systemTeach-content')
        <h3 class="text-center" id="sys">系统使用简介</h3>
        <div id="sysIntroduce">
            <div id="info_stu" class="animated fadeInLeft" style="display: none">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <span class="label label-info">学生用户</span>
                    </div>
                    <div class="panel-footer">
                        <div class="list-group">
                            <a class="list-group-item list-group-item-info">
                                <span class="glyphicon glyphicon-hand-right"></span>
                                点击右上角用户登录
                            </a>
                            <a class="list-group-item list-group-item-info">
                                <span class="glyphicon glyphicon-pencil"></span>
                                输入正确的学号、密码与验证码,点击登录
                            </a>
                            <a class="list-group-item list-group-item-info">
                                <span class="glyphicon glyphicon-user"></span>
                                左边栏可查看个人信息与选材学年与学期
                            </a>
                            <a class="list-group-item list-group-item-info">
                                <span class="glyphicon glyphicon-tasks"></span>
                                右边栏可查看本学期可选的教材
                            </a>
                            <a class="list-group-item list-group-item-success">
                                <span class="glyphicon glyphicon-ok-sign"></span>
                                点击确定按钮完成教材征订
                            </a>
                            <a class="list-group-item list-group-item-warning">
                                <span class="glyphicon glyphicon-exclamation-sign"></span>
                                注意：点击确定征订按钮后不能修改征订结果
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div id="info_tea" class="animated fadeInRight" style="display: none">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <span class="label label-default">教师用户</span>
                    </div>
                    <div class="panel-footer">
                        <div class="list-group">
                            <a class="list-group-item list-group-item-info">
                                <span class="glyphicon glyphicon-hand-right"></span>
                                点击右上角用户登录
                            </a>
                            <a class="list-group-item list-group-item-info">
                                <span class="glyphicon glyphicon-pencil"></span>
                                输入正确的教工号、密码与验证码,点击登录
                            </a>
                            <a class="list-group-item list-group-item-info">
                                <span class="glyphicon glyphicon-menu-hamburger"></span>
                                左边栏为功能菜单，共有四个功能模块
                            </a>
                            <a class="list-group-item list-group-item-info" data-toggle="collapse" href="#net-collapse" aria-expanded="false" aria-controls="net-collapse">
                                <span class="glyphicon glyphicon-chevron-right"></span>
                                网选教材模块
                            </a>
                            <ul class="list-group collapse" id="net-collapse" style="margin-bottom: 0;text-indent: 10px">
                                <li class="list-group-item list-group-item-success">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                    在搜索框输入书名
                                </li>
                                <li class="list-group-item list-group-item-success">
                                    <span class="glyphicon glyphicon-eye-open"></span>
                                    浏览合适的图书，点击加入书单
                                </li>
                                <li class="list-group-item list-group-item-success">
                                    <span class="glyphicon glyphicon-arrow-down"></span>
                                    下拉滚动条至下方可查看已添加的图书
                                </li>
                                <li class="list-group-item list-group-item-success">
                                    <span class="glyphicon glyphicon-hand-up"></span>
                                    点击录入按钮，填写教材详细信息（尽可能不填空值）,录入后可到已录教材模块查看
                                </li>
                            </ul>
                            <a class="list-group-item list-group-item-info" data-toggle="collapse" href="#self-collapse" aria-expanded="false" aria-controls="self-collapse">
                                <span class="glyphicon glyphicon-chevron-right"></span>
                                自填教材模块
                            </a>
                            <ul class="list-group collapse" id="self-collapse" style="margin-bottom: 0;text-indent: 10px;">
                                <li class="list-group-item list-group-item-success">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                    在表单中填写书本详细信息
                                </li>
                                <li class="list-group-item list-group-item-warning">
                                    <span class="glyphicon glyphicon-exclamation-sign"></span>
                                    填写过程中注意表单中的提示,尽可能不填空值
                                </li>
                                <li class="list-group-item list-group-item-success">
                                    <span class="glyphicon glyphicon-hand-up"></span>
                                    点击录入按钮，提交教材到已录教材模块
                                </li>
                            </ul>
                            <a class="list-group-item list-group-item-info" data-toggle="collapse" href="#record-collapse" aria-expanded="false" aria-controls="record-collapse">
                                <span class="glyphicon glyphicon-chevron-right"></span>
                                教材记录模块
                            </a>
                            <ul class="list-group collapse" id="record-collapse" style="margin-bottom: 0;text-indent: 10px;">
                                <li class="list-group-item list-group-item-success">
                                    <span class="glyphicon glyphicon-list"></span>
                                    选择学年、学期、专业等条件
                                </li>
                                <li class="list-group-item list-group-item-success">
                                    <span class="glyphicon glyphicon-hand-up"></span>
                                    点击查询按钮，显示往年数据
                                </li>
                            </ul>
                            <a class="list-group-item list-group-item-info" data-toggle="collapse" href="#had-collapse" aria-expanded="false" aria-controls="had-collapse">
                                <span class="glyphicon glyphicon-chevron-right"></span>
                                已录教材模块
                            </a>
                            <ul class="list-group collapse" id="had-collapse" style="margin-bottom: 0;text-indent: 10px;">
                                <li class="list-group-item list-group-item-success">
                                    <span class="glyphicon glyphicon-eye-open"></span>
                                    查看已录入的教材
                                </li>
                                <li class="list-group-item list-group-item-success">
                                    <span class="glyphicon glyphicon-hand-up"></span>
                                    点击提交按钮，将数据保存至数据库中
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div id="info_edu" class="animated fadeInLeft" style="display: none">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <span class="label label-primary">教务员用户</span>
                    </div>
                    <div class="panel-footer">
                        <div class="list-group">
                            <a class="list-group-item list-group-item-info">
                                <span class="glyphicon glyphicon-hand-right"></span>
                                点击右上角用户登录
                            </a>
                            <a class="list-group-item list-group-item-info">
                                <span class="glyphicon glyphicon-pencil"></span>
                                输入正确的学号、密码与验证码,点击登录
                            </a>
                            <a class="list-group-item list-group-item-info">
                                <span class="glyphicon glyphicon-user"></span>
                                左边栏可查看个人信息
                            </a>
                            <a class="list-group-item list-group-item-info">
                                <span class="glyphicon glyphicon-eye-open"></span>
                                右边栏查看教材征订情况
                            </a>
                            <a class="list-group-item list-group-item-success">
                                <span class="glyphicon glyphicon-hand-up"></span>
                                点击导出按钮，将自动提醒下载Excel文件
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection


@section('scripts')
    <script>
        function jump(btnValue){
            let url = '';
            switch(btnValue){
                case '1':
                    url = 'https://laravel.com/';
                    break;
                case '2':
                    url = 'https://cn.vuejs.org/';
                    break;
                case '3':
                    url = 'http://v3.bootcss.com/';
                    break;
                case '4':
                    url = 'https://www.mysql.com/';
                    break;
            }
            window.open(url);
        }

        //监听滚动事件
        window.addEventListener("scroll",function(e){
            let t =document.documentElement.scrollTop||document.body.scrollTop;
            if(t >= 400){
                $('#info_stu').show();
            }
            if(t >= 800){
                $('#info_tea').show();
            }
            if(t >= 1200){
                $('#info_edu').show();
            }
        });
    </script>
@endsection