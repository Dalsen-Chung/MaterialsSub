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
        <h3 class="text-center" id="sys">系统使用介绍</h3>
        <div id="sysIntroduce">

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
    </script>
@endsection