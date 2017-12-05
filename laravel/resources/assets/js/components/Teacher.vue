<template>
    <div class="container content-top">
            <div class="col-md-3">
                <div class="list-group text-center">
                    <a href="#" class="list-group-item active">菜单栏</a>
                    <a href="#" class="list-group-item" v-on:click="showBlock = 1">网选教材</a>
                    <a href="#" class="list-group-item" v-on:click="showBlock = 2">自填教材</a>
                    <a href="#" class="list-group-item" v-on:click="showBlock = 3">教材记录</a>
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
                    <div class="spinner" v-show="wordChangeLoading">
                        <div class="bounce1"></div>
                        <div class="bounce2"></div>
                        <div class="bounce3"></div>
                    </div>
                    <div class="row netbooklists"  v-show="netBooks.bookListLength" >
                            <div class="col-xs-12 col-md-4" v-for="book in netBooks.books" :key="book.id" style="height: 450px;">
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
                    </div>
                    <div class="spinner" v-show="NetBookLoading">
                        <div class="bounce1"></div>
                        <div class="bounce2"></div>
                        <div class="bounce3"></div>
                    </div>
                    <nav aria-label="Page navigation" style="text-align: center" v-show="netBooks.bookListLength">
                        <ul class="pagination" style="cursor: pointer">
                            <li>
                                <span @click="prePage">
                                    <span aria-hidden="true">&laquo;</span>
                                </span>
                            </li>
                            <li v-for="item in netBooks.pageNum" v-bind:class="{active:item === netBooks.nowPage}">
                                <span @click="goToPage(item)">{{ item }}</span>
                            </li>
                            <li>
                                <span @click="nextPage">
                                    <span aria-hidden="true">&raquo;</span>
                                </span>
                            </li>
                        </ul>
                    </nav>
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
                                <tbody name="list" is="transition-group">
                                    <tr v-for="(selectedBook , index) in netBookLists" :key="index">
                                        <th scope="row">{{index+1}}</th>
                                        <th>{{ selectedBook.title ? selectedBook.title : '未知' }}</th>
                                        <th>{{ selectedBook.author[0] ? selectedBook.author[0] : '未知' }}</th>
                                        <th>{{ selectedBook.isbn13 ? selectedBook.isbn13 : '未知' }}</th>
                                        <th>{{ selectedBook.publisher ? selectedBook.publisher : '未知' }}</th>
                                        <th>{{ selectedBook.pubdate ? selectedBook.pubdate : '未知' }}</th>
                                        <th>{{ selectedBook.price ? selectedBook.price : '未知' }}</th>
                                        <th>
                                            <button type="button" class="btn btn-primary btn-sm"  v-on:click="NetSaveOne(selectedBook)" data-toggle="modal" data-target="#NetModal">
                                                录入
                                            </button>
                                            <button class="btn btn-danger btn-sm" v-on:click="removeFromNetBookList(selectedBook)">
                                                删除
                                            </button>
                                        </th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="NetModal" tabindex="-1" role="dialog" aria-labelledby="NetModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="NetModalLabel">请输入教材信息</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="fillin">
                                        <form>
                                            <div class="form-group">
                                                <input type="text" class="form-control" v-model="netBooks.saveMess.NetlessonName" id="Net-lessonName" placeholder="输入教材对应的课程">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" v-model="netBooks.saveMess.Award" id="Net-award" placeholder="教材获奖情况（省/部级、十五规划等）">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" v-model="netBooks.saveMess.ByOwn" id="Net-ByOwn" placeholder="是否自编教材（如是，请备注任职我院教师名字）">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" v-model="netBooks.saveMess.WithSun" id="Net-WithSun" placeholder="是否与中山大学出版社立项建设的系列教材">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" v-model="netBooks.saveMess.FromAbroad" id="Net-FromAbroad" placeholder="是否境外教材">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" v-model="netBooks.saveMess.ForTea" id="Net-ForTea" placeholder="教师征订本教材数量（本）">
                                            </div>
                                            <div class="select-content">
                                                <label for="NetYear">学年</label>
                                                <select id="NetYear" v-model="netBooks.saveMess.NetYear" class="form-control" disabled>
                                                    <option selected>{{ netBooks.saveMess.NetYear }}</option>
                                                </select>
                                            </div>
                                            <div class="select-content">
                                                <label for="NetTerm">请选择学期</label>
                                                <select id="NetTerm" v-model="netBooks.saveMess.NetTerm" class="form-control">
                                                    <option>第一学期</option>
                                                    <option>第二学期</option>
                                                </select>
                                            </div>
                                            <div class="select-content">
                                                <label for="NetMajor">请选择录入专业</label>
                                                <select id="NetMajor" v-model="netBooks.saveMess.NetMajor" class="form-control">
                                                    <option v-for="(MajorVal,key) in MajorArr" :key="key">{{ MajorVal }}</option>
                                                </select>
                                            </div>
                                            <button type="button" class="btn btn-primary btn-block" v-on:click="NetSaveTwo(netBooks.saveMess)">录入教材</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                                </div>
                            </div>
                        </div>
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
                                <input type="text" class="form-control" id="Self-lessonName1" v-model="selfBooks.LessonName">
                            </div>
                            <div class="form-group">
                                <label for="Self-Book1"><span class="label label-info">教材名称</span></label>
                                <div class="input-group">
                                    <div class="input-group-addon">《</div>
                                    <input type="text" class="form-control" id="Self-Book1" v-model="selfBooks.Name">
                                    <div class="input-group-addon">》</div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Self-Author1"><span class="label label-info">作者</span></label>
                                <input type="text" class="form-control" id="Self-Author1" v-model="selfBooks.Author">
                            </div>
                            <div class="form-group">
                                <label for="Self-PublishMent1"><span class="label label-info">出版社</span></label>
                                <input type="text" class="form-control" id="Self-PublishMent1" v-model="selfBooks.Publisher">
                            </div>
                            <div class="form-group">
                                <label for="Self-PublishTime1"><span class="label label-info">出版年份</span></label>
                                <input type="date" class="form-control" id="Self-PublishTime1" v-model="selfBooks.PublicDate">
                            </div>
                            <div class="form-group">
                                <label for="Self-ISBN1"><span class="label label-info">ISBN</span></label>
                                <input type="text" class="form-control" id="Self-ISBN1" placeholder="请输入13位ISBN" v-model="selfBooks.ISBN13">
                            </div>
                            <div class="form-group">
                                <label for="Self-Page1"><span class="label label-info">页数</span></label>
                                <input type="text" class="form-control" id="Self-Page1" placeholder="请输入教材页数(只填数字)" v-model="selfBooks.Page">
                            </div>
                            <div class="form-group">
                                <label for="Self-Price1"><span class="label label-info">参考价格</span></label>
                                <div class="input-group">
                                    <div class="input-group-addon">¥</div>
                                    <input type="text" class="form-control" id="Self-Price1" placeholder="只填数字" v-model="selfBooks.Price">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Self-AltUrl1"><span class="label label-info">参考购书地址</span></label>
                                <input type="text" class="form-control" id="Self-AltUrl1" placeholder="请输入完整URL(包括http/https前缀)" v-model="selfBooks.AltUrl">
                            </div>
                            <div class="form-group">
                                <label for="Self-Award1"><span class="label label-info">教材获奖情况（省/部级、十五规划等）</span></label>
                                <input type="text" class="form-control" id="Self-Award1" placeholder="无获奖情况则不填" v-model="selfBooks.Award">
                            </div>
                            <div class="form-group">
                                <label for="Self-ByOwn1"><span class="label label-info">是否自编教材（如是，请备注任职我院教师名字）</span></label>
                                <input type="text" class="form-control" id="Self-ByOwn1" placeholder="例如: 是(陈老师编)" v-model="selfBooks.ByOwn">
                            </div>
                            <div class="form-group">
                                <label for="Self-WithSun1"><span class="label label-info">是否与中山大学出版社立项建设的系列教材</span></label>
                                <input type="text" class="form-control" id="Self-WithSun1"  placeholder="是/否" v-model="selfBooks.WithSun">
                            </div>
                            <div class="form-group">
                                <label for="Self-FromAbroad1"><span class="label label-info">是否境外教材</span></label>
                                <input type="text" class="form-control" id="Self-FromAbroad1" placeholder="是/否" v-model="selfBooks.FromAbroad">
                            </div>
                            <div class="form-group">
                                <label for="Self-ForTea"><span class="label label-info">教师征订本教材数量（本）</span></label>
                                <input type="text" class="form-control" id="Self-ForTea" placeholder="只填数字" v-model="selfBooks.ForTea">
                            </div>
                            <div class="select-content">
                                <label for="Self-Year"><span class="label label-info">学年</span></label>
                                <select id="Self-Year" v-model="selfBooks.Year" class="form-control" disabled>
                                    <option selected>{{ selfBooks.Year }}</option>
                                </select>
                            </div>
                            <div class="select-content">
                                <label for="Self-Term"><span class="label label-info">请选择学期</span></label>
                                <select id="Self-Term" v-model="selfBooks.Term" class="form-control">
                                    <option>第一学期</option>
                                    <option>第二学期</option>
                                </select>
                            </div>
                            <div class="select-content">
                                <label for="Self-Major"><span class="label label-info">请选择录入专业</span></label>
                                <select id="Self-Major" v-model="selfBooks.Major" class="form-control">
                                    <option v-for="(MajorVal,key) in MajorArr" :key="key">{{ MajorVal }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="Self-Img1"><span class="label label-info">上传教材图片(可选)</span></label>
                                <input type="file" id="Self-Img1"  @change="onUpload" accept="image/gif,image/jpeg,image/jpg,image/png,image/svg">
                            </div>
                            <div class="col-xs-6 col-md-3">
                                <a href="#" class="thumbnail">
                                    <img :src="selfBooks.Image">
                                </a>
                            </div>
                            <div class="spinner" v-show="UploadLoading">
                                <div class="bounce1"></div>
                                <div class="bounce2"></div>
                                <div class="bounce3"></div>
                            </div>
                            <button type="button" class="btn btn-primary btn-block" @click="saveSelfBook">录入教材</button>
                        </form>
                    </div>
                </div>
            </div>

            <div id="OldRecord" v-show="showBlock === 3">
                <div class="col-md-9  content-plane">
                    <div class="page-header text-center">
                        <h3>教材记录</h3>
                    </div>
                    <div class="fillin">
                        <div class="select-content">
                            <label for="RecoYear"><span class="label label-info">请选择学年</span></label>
                            <select id="RecoYear" class="form-control" v-model="BookRecord.Year">
                                <option>2017年</option>
                                <option>2016年</option>
                                <option>2015年</option>
                                <option>2014年</option>
                                <option>2013年</option>
                            </select>
                        </div>
                        <div class="select-content">
                            <label for="RecoTerm"><span class="label label-info">请选择学期</span></label>
                            <select id="RecoTerm" class="form-control" v-model="BookRecord.Term">
                                <option>第一学期</option>
                                <option>第二学期</option>
                            </select>
                        </div>
                        <div class="select-content">
                            <label for="RecordMajor"><span class="label label-info">请选择专业</span></label>
                            <select id="RecordMajor" class="form-control" v-model="BookRecord.Major">
                                <option v-for="(Major,key) in MajorArr" :key="key">{{ Major }}</option>
                            </select>
                        </div>
                        <button type="button" class="btn btn-primary btn-block" style="margin-bottom: 10px;" @click="searchRecord">查询记录</button>
                        <div class="spinner" v-show="SearchLoading">
                            <div class="bounce1"></div>
                            <div class="bounce2"></div>
                            <div class="bounce3"></div>
                        </div>
                    </div>
                    <div class="booklist">
                        <span class="label label-primary">{{ BookRecord.Year ? BookRecord.Year : '未选择学年' }}</span>
                        <span class="label label-primary">{{ BookRecord.Term ? BookRecord.Term : '未选择学期' }}</span>
                        <span class="label label-primary">{{ BookRecord.Major ? BookRecord.Major : '未选择专业' }}</span>
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
                                <tbody name="list" is="transition-group">
                                    <tr v-for="(record,index) in RecordData" :key="index">
                                        <th scope="row">{{ index+1 }}</th>
                                        <th><a :href="record.BookAltUrl" target="_blank">{{ record.BookName }}</a></th>
                                        <th>{{ record.BookAuthor }}</th>
                                        <th>{{ record.BookIsbn13 }}</th>
                                        <th>{{ record.BookPublisher }}</th>
                                        <th>{{ record.BookPubDate }}</th>
                                        <th>{{ record.BookPrice }}</th>
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
                        <span class="label label-primary">{{ nowYear }}</span>
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
                                    <th>使用课程</th>
                                    <th>发放专业</th>
                                    <th>使用学年</th>
                                    <th>参考价格</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(book,index) in SelectedBooks" :key="index">
                                    <th scope="row">{{ index+1 }}</th>
                                    <th><a v-bind:href="book.BookAltUrl" target="_blank">{{ book.BookName }}</a></th>
                                    <th>{{ book.BookAuthor ? book.BookAuthor : '未知'}}</th>
                                    <th>{{ book.BookIsbn13 ? book.BookIsbn13 : '未知'}}</th>
                                    <th>{{ book.BookPublisher ? book.BookPublisher : '未知'}}</th>
                                    <th>{{ book.BookPubDate ? book.BookPubDate : '未知'}}</th>
                                    <th>{{ book.BookCourse ? book.BookCourse : '未知'}}</th>
                                    <th>{{ book.BookToClass ? book.BookToClass : '未知'}}</th>
                                    <th>{{ book.Year+book.Semester ? book.Year+book.Semester : '未知'}}</th>
                                    <th>{{ book.BookPrice ? book.BookPrice : '未知'}}</th>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <button v-show="SelectedBooks.length != 0" class="btn btn-success btn-block" @click="saveSelectedBook">提交以上教材至教务部</button>
                    <div class="spinner" v-show="SubmitLoading">
                        <div class="bounce1"></div>
                        <div class="bounce2"></div>
                        <div class="bounce3"></div>
                    </div>
                </div>
            </div>

            <!--提示框-->
        <div class="modal fade bs-example-modal-sm" id="AlertSmModal" tabindex="-1"  role="dialog" aria-labelledby="AlertModalLabel">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h5 class="modal-title" id="AlertModalLabel">提示</h5>
                    </div>
                    <div class="modal-body" style="text-align: center">
                        <span v-bind:style="AlertStyle">{{ AlertMess }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!--回到顶部-->
        <div class="toTop">
            <a href="#navTop">
                <span class="glyphicon glyphicon-arrow-up"></span>
                <div><span>Top</span></div>
            </a>
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

    /*回到顶部*/
    .toTop{
        position: fixed;
        right: 25px;
        bottom: 25px;
        z-index: 999;
        text-align: center;
        font-size: 12px;
        cursor: pointer;
    }
    .toTop span{
        display: block;
        /*text-align: center;*/
    }
    .toTop>a:hover, a:visited, a:link, a:active{
        text-decoration: none;
        outline: none;
    }


    /*
        已选教材CSS
    */
    @media  only screen and (min-width: 1024px) {
        .fillin{
            width: 80%;
            margin: 0 auto;
        }
    }
    @media  only screen and (max-width: 500px){
        .toTop{
            display: none;
        }
    }
    @media  only screen and (min-width: 1400px){
        .container {
            width: 1350px;
        }
    }
</style>

<script>
    export default {
        data(){
            return{
                showBlock : 1,
                searchBook : '',
                dateArr : [],
                MajorArr : [],
                nowYear : '',
                netBookLists : [],
                netBooks:{
                    books : null,
                    bookListLength : 0,
                    saveMess : {
                        NetlessonName : '',
                        Award : '',
                        ByOwn : '',
                        WithSun : '',
                        FromAbroad : '',
                        ForTea : '',
                        NetTerm : '',
                        NetYear : '',
                        NetMajor : ''
                    },
                    saveTotal : {},
                    prePage : true,
                    nexPage : false,
                    pageNum : 10,
                    pageBooks : 15,
                    nowPage : 1,
                    pageOffset : 0
                },
                selfBooks : {
                    LessonName : '',
                    Name : '',
                    Author : '',
                    Publisher : '',
                    PublicDate : '',
                    ISBN13 : '',
                    Price: '',
                    AltUrl : '',
                    Award : '',
                    ByOwn : '',
                    WithSun : '',
                    FromAbroad : '',
                    ForTea : '',
                    Image : '',
                    Page : '',
                    Term : '',
                    Year : '',
                    Major : ''
                },
                BookRecord : {
                    Major : '',
                    Term : '',
                    Year : ''
                },
                AlertMess : '',
                AlertStyle : '',
                SelectedBooks : [],
                RecordData : [],
                SearchLoading : false,
                SubmitLoading : false,
                UploadLoading : false,
                NetBookLoading : false,
                wordChangeLoading :false
            }
        },
        watch :{
            //网选教材搜索框 debounce函数用于延迟执行
            searchBook : _.debounce(function (val) {
                if(val === ''){
                    this.netBooks.bookListLength = 0;
                }else{
                    this.netBooks.nowPage = 1;
                    this.wordChangeLoading = true;
                    this.getBooksByApi();
                }
            },500)
        },
        methods : {
            //获取近四年年份
            getMajors : function () {
                let myDate = new Date();
                let nowYear = myDate.getFullYear();
                this.nowYear = nowYear+'年';
                this.netBooks.saveMess.NetYear = nowYear + '年';
                this.selfBooks.Year = nowYear + '年';
                let majors = {};
                for (let i = 0 ; i < 4 ; i++){
                    this.dateArr.push(nowYear-i);
                }
                this.$http.get('http://localhost/MaterialsSub/laravel/public/index.php/api/v1/getmajor').then((response) => {
                    majors = response.data;
                    for (let i = 0 ; i < this.dateArr.length ; i++){
                        let year = this.dateArr[i];
                        for (let j = 0 ; j < majors.length ; j++){
                            let major = majors[j].MajorName;
                            this.MajorArr.push(year+'级'+major);
                        }
                    }
                },(response) => {
                    console.log('fail'+response.data);
                });
            },

            //获取豆瓣图书
            getBooksByApi : function () {
                this.$http.jsonp('https://api.douban.com/v2/book/search?q='+this.searchBook+'&count='+this.netBooks.pageBooks+'&start='+this.netBooks.pageOffset)
                    .then((response) => {
                        console.log(response.data.books);
                        this.netBooks.bookListLength = response.data.books.length;
                        this.netBooks.books = response.data.books;
                        this.wordChangeLoading = false;
                        this.NetBookLoading = false;
                },(response) => {
                    console.log('fail'+response.data);
                });
            },

            //增加网选教材
            addNetBook : function (book) {
                if(this.netBookLists.length === 0){
                    this.netBookLists.push(book);
                    this.AlertMess = '教材已添加至下方书单';
                    this.AlertStyle = 'color:green';
                    $('#AlertSmModal').modal('show');
                }else{
                    let flag = false;
                    for (let i = 0 ; i < this.netBookLists.length ; i++){
                        let list = this.netBookLists[i];
                        if(list.isbn13 === book.isbn13){
                            flag = true;
                        }
                    }
                    if(flag){
                        this.AlertStyle = 'color:red';
                        this.AlertMess = '该教材已存在于书单中,添加失败!';
                        $('#AlertSmModal').modal('show');
                    }else{
                        this.AlertStyle = 'color:green';
                        this.AlertMess = '教材已添加至下方书单';
                        this.netBookLists.push(book);
                        $('#AlertSmModal').modal('show');
                    }
                }
                console.log(this.netBookLists);
            },

            //删除网选教材
            removeFromNetBookList : function (book) {
                for (let i = 0 ; i < this.netBookLists.length ; i++){
                    let list = this.netBookLists[i];
                    if(list.isbn13 === book.isbn13 || book.BookIsbn13){
                        this.netBookLists.splice(i,1);
                        break;
                    }
                }
            },

            //录入网选教材一层事件
            NetSaveOne : function (obj) {
                this.netBooks.saveTotal.BookName = obj.title || '未知';
                this.netBooks.saveTotal.BookAuthor = obj.author[0] || '未知';
                this.netBooks.saveTotal.BookPubDate = obj.pubdate || '未知';
                this.netBooks.saveTotal.BookImage = obj.image || '未知';
                this.netBooks.saveTotal.BookPublisher = obj.publisher || '未知';
                this.netBooks.saveTotal.BookIsbn13 = obj.isbn13 || '未知';
                this.netBooks.saveTotal.BookPrice = obj.price || '未知';
                this.netBooks.saveTotal.BookPages = obj.pages || '未知';
                this.netBooks.saveTotal.BookAltUrl = obj.alt || '未知';
                console.log(this.netBooks.saveTotal);
            },

            //录入网选教材二层事件
            NetSaveTwo : function (obj) {
                this.netBooks.saveTotal.BookCourse = obj.NetlessonName || '未知';
                this.netBooks.saveTotal.BookAward = obj.Award || '未知';
                this.netBooks.saveTotal.BookByOwn = obj.ByOwn || '未知';
                this.netBooks.saveTotal.BookWithSun = obj.WithSun || '未知';
                this.netBooks.saveTotal.BookFromAbroad = obj.FromAbroad || '未知';
                this.netBooks.saveTotal.BookForTea = obj.ForTea || 0;
                this.netBooks.saveTotal.BookToClass = obj.NetMajor || '未知';
                this.netBooks.saveTotal.Year = obj.NetYear;
                this.netBooks.saveTotal.Semester = obj.NetTerm || '未知';
                console.log(this.netBooks.saveTotal);
                let saveBook = this.netBooks.saveTotal;
                this.netBooks.saveTotal = {};
                this.SelectedBooks.push(saveBook);
                console.log(this.SelectedBooks);
                this.removeFromNetBookList(saveBook);
                $('#NetModal').modal('hide');
                let _this = this;
                setTimeout(function () {
                    _this.AlertStyle = 'color:green';
                    _this.AlertMess = '录入成功,可到已选教材查看';
                    $('#AlertSmModal').modal('show');
                },500);
            },
            
            //图片上传
            onUpload : function (e) {
                this.UploadLoading = true;
                let formData = new FormData();
                formData.append('photo', e.target.files[0]);
                let config = {
                    headers:{'Content-Type':'multipart/form-data'}
                };
                this.$http.post('http://localhost/MaterialsSub/laravel/public/index.php/api/v1/uploadimg'
                    ,formData,config).then((response) => {
                    this.selfBooks.Image = response.data.photo;
                    this.UploadLoading = false;
                },(response) => {
                    console.log('error'+response.data);
                });
            },

            //保存自填教材
            saveSelfBook : function () {
                let saveObj = {};
                saveObj.BookName = this.selfBooks.Name || '未知';
                saveObj.BookAuthor = this.selfBooks.Author || '未知';
                saveObj.BookPubDate = this.selfBooks.PublicDate || '未知';
                saveObj.BookImage = this.selfBooks.Image || '未知';
                saveObj.BookPublisher = this.selfBooks.Publisher || '未知';
                saveObj.BookIsbn13 = this.selfBooks.ISBN13 || '未知';
                saveObj.BookPrice = this.selfBooks.Price || '未知';
                saveObj.BookPages = this.selfBooks.Page || '未知';
                saveObj.BookAltUrl = this.selfBooks.AltUrl || '未知';
                saveObj.BookCourse = this.selfBooks.LessonName || '未知';
                saveObj.BookAward = this.selfBooks.Award || '未知';
                saveObj.BookByOwn = this.selfBooks.ByOwn || '未知';
                saveObj.BookWithSun = this.selfBooks.WithSun || '未知';
                saveObj.BookFromAbroad = this.selfBooks.FromAbroad || '未知';
                saveObj.BookForTea = this.selfBooks.ForTea || 0;
                saveObj.BookToClass = this.selfBooks.Major || '未知';
                saveObj.Year = this.selfBooks.Year;
                saveObj.Semester = this.selfBooks.Term;
                this.selfBooks = {};
                this.SelectedBooks.push(saveObj);
                console.log(this.SelectedBooks);
                let _this = this;
                setTimeout(function () {
                    _this.AlertStyle = 'color:green';
                    _this.AlertMess = '录入成功,可到已选教材查看';
                    $('#AlertSmModal').modal('show');
                },200);
            },

            //保存已选的教材至数据库
            saveSelectedBook : function () {
                this.SubmitLoading = true;
                this.$http.post('http://localhost/MaterialsSub/laravel/public/index.php/api/v1/savebooks'
                   ,this.SelectedBooks).then((response) => {
                    this.SubmitLoading = false;
                    let status = response.data.status_code;
                    if(status === 200){
                        this.AlertStyle = 'color:green';
                        this.AlertMess = '以下教材已成功提交至教务部';
                        $('#AlertSmModal').modal('show');
                        this.SelectedBooks = [];
                    }
                },(response) => {
                    this.SubmitLoading = false;
                    this.AlertStyle = 'color:red';
                    this.AlertMess = response.data;
                    $('#AlertSmModal').modal('show');
                });
            },

            //根据条件查询往年记录
            searchRecord : function () {
                this.SearchLoading = true;
                if(this.BookRecord.Year === '' ||this.BookRecord.Term === '' || this.BookRecord.Major === undefined){
                    this.AlertStyle = 'color:red';
                    this.AlertMess = '请选择完整的查询条件';
                    $('#AlertSmModal').modal('show');
                    this.SearchLoading = false;
                }else{
                    this.$http.post('http://localhost/MaterialsSub/laravel/public/index.php/api/v1/searchrecord'
                        ,this.BookRecord).then((response) => {
                        this.SearchLoading = false;
                        if(response.data.status_code === 200){
                            if(response.data.res.length > 0){
                                this.RecordData = response.data.res;
                            }else{
                                this.RecordData = [];
                                this.AlertStyle = 'color:#FF9800';
                                this.AlertMess = '暂无该查询条件的数据';
                                $('#AlertSmModal').modal('show');
                            }
                        }
                    },(response) => {
                        this.SearchLoading = false;
                        this.AlertStyle = 'color:red';
                        this.AlertMess = response.data;
                        $('#AlertSmModal').modal('show');
                    });
                }
            },

            //翻页函数
            goToPage :function (item) {
                if(this.netBooks.nowPage !== item){
                    this.NetBookLoading = true;
                    this.netBooks.nowPage = item;
                    this.netBooks.pageOffset = (this.netBooks.nowPage-1) * this.netBooks.pageBooks;
                    this.getBooksByApi();
                }
            },

            nextPage : function () {
                if(this.netBooks.nowPage < this.netBooks.pageNum){
                    this.NetBookLoading = true;
                    this.netBooks.nowPage++;
                    this.netBooks.pageOffset = (this.netBooks.nowPage-1) * this.netBooks.pageBooks;
                    this.getBooksByApi();
                }
            },

            prePage : function () {
                if(this.netBooks.nowPage > 1){
                    this.NetBookLoading = true;
                    this.netBooks.nowPage--;
                    this.netBooks.pageOffset = (this.netBooks.nowPage-1) * this.netBooks.pageBooks;
                    this.getBooksByApi();
                }
            },

        },
        mounted() {
            console.log('Teacher Component mounted.');
            this.getMajors();
//            this.$http.get('http://localhost/MaterialsSub/laravel/public/index.php/api/v1/user/login').then((response) => {
//                console.log(response.data);
//            },(response) => {
//
//            });
        }
    }
</script>
