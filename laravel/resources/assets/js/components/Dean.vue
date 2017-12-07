<template>
    <div class="container warp">
        <div class="col-md-3 animated fadeInLeft" id="info">
            <div class="userBlock">
                <img src="/MaterialsSub/laravel/public/images/tea.png" alt="">
                <div class="userInfo">
                    <span>姓名：{{ user.EduMName }}</span>
                    <span>院系：{{ user.EduMDepartment }}</span>
                    <span>职位：{{ user.EduMPosition }}</span>
                    <span>手机：{{ user.EduMPhone }}</span>
                    <span>邮箱：{{ user.EduMEmail }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-9 animated fadeInRight">
            <div class="row listTile">
                <div class="col-md-4">院系：{{ user.EduMDepartment }}</div>
                <div class="col-md-4">用材学年：{{ Year }}</div>
                <div class="col-md-4">用材学期：{{ Term }}</div>
            </div>
            <div class="SelectBook">
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
                            <th>发放班级</th>
                            <th>参考价格</th>
                            <th>总数量</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(book,index) in books" :key="index">
                                <th>{{ index+1 }}</th>
                                <th>{{ book.BookName }}</th>
                                <th>{{ book.BookAuthor }}</th>
                                <th>{{ book.BookIsbn13 }}</th>
                                <th>{{ book.BookPublisher }}</th>
                                <th>{{ book.BookPubDate }}</th>
                                <th>{{ book.BookCourse }}</th>
                                <th>{{ book.BookToClass }}</th>
                                <th>{{ book.BookPrice }}</th>
                                <th>{{ book.Amount+'本' }}</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="infoBlock">
                <button type="button" id="butBuy" class="btn btn-block btn-success" @click="outPutExcel">
                    导出为Excel  <span class="glyphicon glyphicon-download-alt" ></span>
                </button>
                <div class="spinner" v-show="outPutLoading">
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
    </div>
</template>

<style scoped>
    .warp{
        padding-top: 20px;
        padding-bottom: 300px;
    }

    .userBlock{
        text-align: center;
        background-color: #499C94;
        border: 1px solid #499C94;
        border-radius: 10px;
    }

    .userInfo{
        margin-top: 20px;
    }

    #info{
        -webkit-animation-delay: 0.2s;
        -moz-animation-delay: 0.2s;
        -o-animation-delay: 0.2s;
        animation-delay: 0.2s;
    }

    .userInfo > span{
        color: #fafafa;
        margin-bottom: 20px;
        display: block;
    }

    .listTile{
        padding: 10px;
        height: 40px;
        text-align: center;
        background-color: #499C94;
        color: #fafafa;
        border: 1px solid #499C94;
        border-radius: 5px;
    }

    .SelectBook table{
        margin-top: 10px;
    }
    th{
        text-align: center;
    }

    .infoBlock{
        margin-top: 30px;
        text-align: center;
    }
    .infoBlock button{
        background-color: #499C94;
        border-color : #499C94;
    }
    .infoBlock button:hover{
        box-shadow: 3px 3px 3px #BCBCB7;
    }

    @media (min-width: 1400px){
        .container {
            width: 1350px;
        }
    }
</style>

<script>
    export default {
        data(){
            return {
                user : {},
                Year :'',
                Term : '',
                QueryData : {},
                books : [],
                outPutLoading : false,
                AlertStyle : '',
                AlertMess : ''
            }
        },
        methods : {
            getCurrentDate : function () {
                let myDate = new Date();
                let nowYear = myDate.getFullYear()+'年';
                let nowMonth = myDate.getMonth()+1;
                let nowTerm = '';
                if(nowMonth>6&&nowMonth<10){
                    nowTerm = '第一学期';
                }else{
                    nowTerm = '第二学期';
                }
                this.Year = nowYear;
                this.Term = nowTerm;
            },
            getCurrentBooks : function () {
                this.QueryData.year = this.Year;
                this.QueryData.term = this.Term;
                this.$http.post('http://localhost/MaterialsSub/laravel/public/index.php/api/v1/getcurrentbooks',this.QueryData)
                    .then((response) => {
                        if(response.data.length === 0){
                            console.log('没有书');
                        }else{
                            this.books = response.data;
                            console.log(this.books);
                        }
                    },(response) => {
                        console.log('error:'+response.data)
                    });
            },
            outPutExcel : function () {
                this.outPutLoading = true;
                let postObj = {};
                let d = new Date();
                let today = d.getFullYear()+""+(d.getMonth()+1)+""+d.getDate()+""+d.getHours()+""+d.getMinutes()+""+d.getSeconds();
                postObj.fileName =today+"-"+this.user.EduMDepartment + this.Year+this.Term + '教材汇总表';
                postObj.data = this.books;
                this.$http.post('http://localhost/MaterialsSub/laravel/public/index.php/api/v1/excel/export',postObj)
                    .then((response) => {
                        let url = response.data;
                        console.log(url);
                        this.outPutLoading = false;
                        window.location.href = url;
                        this.AlertMess = '教材导出成功!';
                        this.AlertStyle = 'color:green';
                        $('#AlertSmModal').modal('show');
                    },(response) => {
                        this.AlertMess = '错误：'+response.data;
                        this.AlertStyle = 'color:red';
                        $('#AlertSmModal').modal('show');
                    });
            }
        },
        mounted(){
            this.user = JSON.parse(document.getElementById('acc').value);
            console.log(this.user);
            this.getCurrentDate();
            this.getCurrentBooks();
        }
    }
</script>