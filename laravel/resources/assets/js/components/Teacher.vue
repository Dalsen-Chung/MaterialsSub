<template>
    <div class="container content-top">
            <div class="col-md-3">
                <div class="list-group text-center">
                    <a href="#" class="list-group-item active">
                        菜单栏
                    </a>
                    <a href="#" class="list-group-item" v-on:click="showBlock = 1">网选教材</a>
                    <a href="#" class="list-group-item" v-on:click="showBlock = 2">自填教材</a>
                    <a href="#" class="list-group-item" v-on:click="showBlock = 3">往年记录</a>
                    <a href="#" class="list-group-item" v-on:click="showBlock = 4">已录教材</a>
                </div>
            </div>

            <div id="formNet" v-show="showBlock ===1">
                <div class="col-md-9 content-plane">
                    <div class="page-header text-center">
                        <h3>网选教材</h3><small>Via：豆瓣API</small>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <div class="input-group">
                                <input type="text" class="form-control" v-model="searchBook" placeholder="书名">
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-search"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row netbooklists"  v-show="netBooks.bookListLength" >
                        <transition-group  name="list">
                            <div class="col-xs-12 col-md-4" v-for="book in netBooks.books" :key="book.id">
                                <a :href="book.alt" class="thumbnail" target="_blank">
                                    <img :src="book.image">
                                </a>
                                <span class="glyphicon glyphicon-book"></span> 书名：{{ book.title ? book.title : '未知' }}<br>
                                <span class="glyphicon glyphicon-user"></span> 作者：{{ book.author[0] ? book.author[0] : '未知' }}<br>
                                <span class="glyphicon glyphicon-bookmark"></span> 出版社：{{ book.publisher ? book.publisher : '未知' }}<br>
                                <span class="glyphicon glyphicon-time"></span> 出版日期：{{ book.pubdate ? book.pubdate : '未知'}}<br>
                                <span class="glyphicon glyphicon-yen"></span> 参考价格：{{ book.price ? book.price : '未知'}}<br>
                                <span class="glyphicon glyphicon-barcode"></span> ISBN13：{{ book.isbn13 ? book.isbn13 : '未知'}}<br>
                                <span class="glyphicon glyphicon-file"></span> 共{{ book.pages ? book.pages : '未知'}}页<br>
                                <button type="button" class="btn btn-block btn-success" v-on:click="addNetBook(book)">加入书单</button>
                            </div>
                        </transition-group>
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
                                        <th>操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(selectedBook , index) in netBookLists" :key="index">
                                        <th scope="row">{{index+1}}</th>
                                        <th>{{ selectedBook.title ? selectedBook.title : '未知' }}</th>
                                        <th>{{ selectedBook.author[0] ? selectedBook.author[0] : '未知' }}</th>
                                        <th>{{ selectedBook.isbn13 ? selectedBook.isbn13 : '未知' }}</th>
                                        <th>{{ selectedBook.publisher ? selectedBook.publisher : '未知' }}</th>
                                        <th>{{ selectedBook.pubdate ? selectedBook.pubdate : '未知' }}</th>
                                        <th>{{ selectedBook.price ? selectedBook.price : '未知' }}</th>
                                        <th><button class="btn btn-danger btn-sm" v-on:click="removeFromNetBookList(selectedBook)">
                                            <span class="glyphicon glyphicon-remove"></span>
                                        </button></th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <span class="label label-primary">录入以上表格教材</span>
                    <div class="fillin">
                        <form>
                            <div class="form-group">
                                <input type="email" class="form-control" v-model="netBooks.NetlessonName" id="Net-lessonName" placeholder="输入课程名称">
                            </div>
                            <button type="button" class="btn btn-primary btn-block">录入教材</button>
                        </form>
                    </div>
                </div>
            </div>

            <div id="formMyself" v-show="showBlock ===2">
                <div class="col-md-9 content-plane">
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
                                <div class="input-group">
                                    <div class="input-group-addon">《</div>
                                    <input type="text" class="form-control" id="Self-Book1">
                                    <div class="input-group-addon">》</div>
                                </div>
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
                                <label for="Self-Price1"><span class="label label-info">参考价格</span></label>
                                <div class="input-group">
                                    <div class="input-group-addon">¥</div>
                                    <input type="text" class="form-control" id="Self-Price1">
                                </div>
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
                            <button type="button" class="btn btn-primary btn-block">录入教材</button>
                        </form>
                    </div>
                </div>
            </div>

            <div id="OldRecord" v-show="showBlock === 3">
                <div class="col-md-9  content-plane">
                    <div class="page-header text-center">
                        <h3>往年记录</h3>
                    </div>
                    <div class="fillin">
                        <div class="select-content">
                            <label for="RecoYear">请选择学年</label>
                            <select id="RecoYear" class="form-control">
                                <option>2017年</option>
                                <option>2016年</option>
                                <option>2015年</option>
                                <option>2014年</option>
                                <option>2013年</option>
                            </select>
                        </div>
                        <div class="select-content">
                            <label for="RecoTerm">请选择学期</label>
                            <select id="RecoTerm" class="form-control">
                                <option>第一学期</option>
                                <option>第二学期</option>
                            </select>
                        </div>
                        <div class="select-content">
                            <label for="Recolesson">请选择系别</label>
                            <select id="Recolesson" class="form-control">
                                <option>电子与信息工程系</option>
                                <option>计算机系</option>
                                <option>数学系</option>
                                <option>英语系</option>
                                <option>经济学系</option>
                            </select>
                        </div>
                        <button type="button" class="btn btn-primary btn-block" style="margin-bottom: 10px;">查询记录</button>
                        <button type="button" class="btn btn-primary btn-block">查看往年全部记录</button>
                    </div>
                    <div class="booklist">
                        <span class="label label-primary">2017年</span>
                        <span class="label label-primary">第一学期</span>
                        <span class="label label-primary">电子与信息工程系</span>
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
                </div>
            </div>

            <div id="NowRecord" v-show="showBlock === 4">
                <div class="col-md-9 content-plane">
                    <div class="page-header text-center">
                        <h3>已录教材</h3>
                    </div>
                    <div class="booklist">
                        <span class="label label-primary">2017年</span>
                        <span class="label label-primary">第一学期</span>
                        <span class="label label-primary">电子与信息工程系</span>
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
                </div>
            </div>
    </div>
</template>

<style scoped>
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
        line-height: 2.6 !important;
    }
    .select-content{
        margin-bottom: 20px;
    }

    /*
        网选教材CSS
    */
    .netbooklists{
        margin-top: 40px;
    }
    .netbooklists img{
        width: 105px;
        height: 145px;
    }
    .netbooklists button{
        margin: 10px auto;
    }
    .netbooklists>div{
        margin-bottom: 20px;
    }
    @media  only screen and (min-width: 1024px) {
        .fillin{
            width: 50%;
            margin: 0 auto;
        }
    }
    @media  only screen and (max-width: 1024px){

    }

    /*
    动画
     */
    .list-item {
        display: inline-block;
        margin-right: 10px;
    }
    .list-enter-active, .list-leave-active {
        transition: all 1s;
    }
    .list-enter, .list-leave-to
        /* .list-leave-active for below version 2.1.8 */ {
        opacity: 0;
        transform: translateY(30px);
    }
</style>

<script>
    export default {
        data(){
            return{
                showBlock : 1,
                searchBook : '',
                netBooks:{
                    books : null,
                    bookListLength : 0,
                    NetlessonName : ''
                },
                netBookLists:[]
            }
        },
        watch :{
            //网选教材搜索框
            searchBook : function (val) {
                if(val === ''){
                    this.netBooks.bookListLength = 0;
                }else{
                    this.$http.jsonp('https://api.douban.com/v2/book/search?q='+this.searchBook+'&count=12').then((response) => {
                        console.log(response.data.books);
                        this.netBooks.bookListLength = response.data.books.length;
                        this.netBooks.books = response.data.books;
                    },(response) => {
                        console.log('fail'+response.data);
                    });
                }
            }
        },
        methods : {
            //增加网选教材
            addNetBook : function (book) {
                if(this.netBookLists.length === 0){
                    this.netBookLists.push(book);
                    console.log('从0Add')
                }else{
                    let flag = false;
                    for (let i = 0 ; i < this.netBookLists.length ; i++){
                        let list = this.netBookLists[i];
                        if(list.isbn13 === book.isbn13){
                            flag = true;
                        }
                    }
                    if(flag){
                        alert('该教材已添加!');
                    }else{
                        this.netBookLists.push(book);
                    }
                }
                console.log(this.netBookLists);
            },

            //删除网选教材
            removeFromNetBookList : function (book) {
                console.log('delete');
                for (let i = 0 ; i < this.netBookLists.length ; i++){
                    let list = this.netBookLists[i];
                    if(list.isbn13 === book.isbn13){
                        this.netBookLists.splice(i,1);
                        console.log(this.netBookLists);
                        break;
                    }
                }
            },
        },
        mounted() {
            console.log('Teacher Component mounted.');
//            this.$http.get('http://localhost/MaterialsSub/laravel/public/index.php/api/v1/user/login').then((response) => {
//                console.log(response.data);
//            },(response) => {
//
//            });
        }
    }
</script>
