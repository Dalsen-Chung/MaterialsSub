<template>
    <div class="container content-top">
            <div class="col-md-3">
                <div class="list-group text-center">
                    <a href="#" class="list-group-item active">
                        菜单栏
                    </a>
                    <a href="#" class="list-group-item">网选教材</a>
                    <a href="#" class="list-group-item">自填教材</a>
                    <a href="#" class="list-group-item">往年记录</a>
                    <a href="#" class="list-group-item">已录教材</a>
                    <a href="#" class="list-group-item">个人中心</a>
                </div>
            </div>

            <div id="formNet">
                <div class="col-md-9 content-plane">
                    <div class="page-header text-center">
                        <h3>网选教材</h3><small>Via：豆瓣API</small>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="书名">
                                <span class="input-group-btn"><button class="btn btn-default" type="button">
                                    <span class="glyphicon glyphicon-search"></span></button>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="booklist">
                        <span class="label label-primary">已选教材</span>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>书名</th>
                                        <th>作者</th>
                                        <th>ISBN</th>
                                        <th>出版社</th>
                                        <th>出版日期</th>
                                        <th>参考价格</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <th>PHP教程</th>
                                        <th>高洛峰</th>
                                        <th>142531659</th>
                                        <th>清华大学出版社</th>
                                        <th>2016年9月</th>
                                        <th>50.0</th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <span class="label label-primary">录入以上表格教材</span>
                    <div class="fillin">
                        <form>
                            <div class="form-group">
                                <input type="email" class="form-control" id="Net-lessonName" placeholder="输入课程名称">
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">保存教材</button>
                        </form>
                    </div>
                </div>
            </div>

            <div id="formMyself">
                <div class="col-md-9 col-md-offset-3 content-plane">
                    <div class="page-header text-center">
                        <h3>自填教材</h3>
                    </div>
                    <div class="fillin">
                        <form>
                            <div class="form-group">
                                <label for="Self-lessonName1"><span class="label label-info">课程名称</span></label>
                                <input type="text" class="form-control" id="Self-lessonName1">
                            </div>
                            <div class="form-group">
                                <label for="Self-Book1"><span class="label label-info">教材名称</span></label>
                                <input type="text" class="form-control" id="Self-Book1">
                            </div>
                            <div class="form-group">
                                <label for="Self-Author1"><span class="label label-info">作者</span></label>
                                <input type="text" class="form-control" id="Self-Author1">
                            </div>
                            <div class="form-group">
                                <label for="Self-PublishMent1"><span class="label label-info">出版社</span></label>
                                <input type="text" class="form-control" id="Self-PublishMent1">
                            </div>
                            <div class="form-group">
                                <label for="Self-PublishTime1"><span class="label label-info">出版年份</span></label>
                                <input type="date" class="form-control" id="Self-PublishTime1">
                            </div>
                            <div class="form-group">
                                <label for="Self-ISBN1"><span class="label label-info">ISBN</span></label>
                                <input type="text" class="form-control" id="Self-ISBN1">
                            </div>
                            <div class="form-group">
                                <label for="Self-Price1"><span class="label label-info">价格 (单位:元)</span></label>
                                <input type="text" class="form-control" id="Self-Price1">
                            </div>
                            <div class="form-group">
                                <label for="Self-Img1"><span class="label label-info">上传教材图片(可选)</span></label>
                                <input type="file" id="Self-Img1">
                            </div>
                            <div class="col-xs-6 col-md-3">
                                <a href="#" class="thumbnail">
                                    <img src="" alt="...">
                                </a>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">保存教材</button>
                        </form>
                    </div>
                </div>
            </div>

            <div id="OldRecord">

            </div>

            <div id="NowRecord">

            </div>

            <div id="Personal">

            </div>
    </div>
</template>

<style>
    .content-top{
        padding: 0;
        margin-top: 30px;
        padding-bottom: 250px;
    }
    .page-header{
        margin-top: 15px;
    }
    .page-header>h3{
        margin-top: 0;
    }
    .content-plane{
        border: 1px solid #D3E0E9;
        /*padding: 0 20px;*/
        padding-bottom: 30px;
        /*height: 1200px;*/
        border-radius: 5px;
    }
    .booklist{
        margin: 30px auto 20px;
    }
    .label-primary{
        display: inline-block;
        margin-bottom: 10px;
    }
    th{
        font-weight:normal;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        color:#34495E;
    }
    @media  only screen and (min-width: 1024px) {
        .fillin{
            width: 50%;
            margin: 0 auto;
        }
    }
    @media  only screen and (max-width: 1024px){

    }
</style>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
