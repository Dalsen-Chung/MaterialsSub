<template>
    <div class="container warp">
        <div class="col-md-3 animated bounceInLeft">
            <div class="userBlock">
                <img src="/MaterialsSub/laravel/public/images/user.png" alt="">
                <div class="userInfo">
                    <span>姓名：{{ user.StuName }}</span>
                    <span>院系：{{ user.StuDepartment }}</span>
                    <span>专业：{{ user.StuClass }}</span>
                    <span>年级：{{ user.StuPeriod }}</span>
                    <span>当前教材使用学期：{{ user.Term }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-9 animated bounceInRight" id="BockBlock">
            <div class="alert alert-success" role="alert" v-show="hadBooked">您已征订本学期教材</div>
            <div class="alert alert-warning" role="alert" v-if="EmptyBook">暂无可征订教材</div>
            <div class="SelectTitle" v-show=" !hadBooked && !EmptyBook ">
                <span>请在下方表格中选择本学期要征订的教材</span>
            </div>
            <div class="SelectBook" v-show="  !hadBooked && !EmptyBook">
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
                                <th>使用学期</th>
                                <th>参考价格</th>
                                <th>征订</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(book,index) in bookLists" :key="index">
                                <th scope="row">{{ index+1}}</th>
                                <th><a :href="book.BookAltUrl">{{ book.BookName }}</a></th>
                                <th>{{ book.BookAuthor ? book.BookAuthor: '未知'}}</th>
                                <th>{{ book.BookIsbn13 ? book.BookIsbn13: '未知' }}</th>
                                <th>{{ book.BookPublisher ? book.BookPublisher: '未知'}}</th>
                                <th>{{ book.BookPubDate ? book.BookPubDate: '未知'}}</th>
                                <th>{{ book.BookCourse }}</th>
                                <th>{{ book.Year+book.Semester }}</th>
                                <th>{{ book.BookPrice ? book.BookPrice: '未知'}}</th>
                                <th>
                                    <input type="checkbox"  :value="book"  v-model="saveArr">
                                </th>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="selectAll">
                    <input type="checkbox" id="checkedAll"  @click="allChecked">
                    <label for="checkedAll">全选</label>
                </div>
            </div>
            <div class="infoBlock" v-show="!hadBooked && !EmptyBook">
                <span class="label label-danger">*注意：确定征订后不可修改</span>
                <button type="button" id="butBuy" class="btn btn-block btn-success" @click="addBooks">
                    确定征订<span class="glyphicon glyphicon-ok"></span>
                </button>
            </div>
            <div class="spinner" v-show="SubmitLoading">
                <div class="bounce1"></div>
                <div class="bounce2"></div>
                <div class="bounce3"></div>
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
        background-color: #14A96F;
        border: 1px solid #14A96F;
        border-radius: 10px;
    }
    #BockBlock{
        -webkit-animation-delay: 0.4s;
        -moz-animation-delay: 0.4s;
        -o-animation-delay: 0.4s;
        animation-delay: 0.4s;
    }
    .alert{
        text-align: center;
    }
    
    .userInfo{
        margin-top: 20px;
    }

    .userInfo > span{
        color: #fafafa;
        margin-bottom: 20px;
        display: block;
    }

    .SelectTitle{
        width: 100%;
        background-color: #14A96F;
        color: #fafafa;
        text-align: center;
        height: 40px;
        line-height: 40px;
        border: 1px solid #14A96F;
        border-radius: 5px;
    }

    .SelectBook table{
        margin-top: 10px;
    }
    th{
        text-align: center;
    }

    .selectAll{
        text-align: right;
    }

    .infoBlock{
        margin-top: 30px;
        text-align: center;
    }

    #butBuy{
        margin: 5px auto 0;
    }

    @media (min-width: 1400px){
        .container {
            width: 1350px;
        }
        #butBuy{
            width: 50%;
        }
    }

    @media (max-width: 992px){
        .col-md-9 {
            margin-top: 20px;
        }
        .SelectBook{
            margin-top: 10px;
        }
    }
    
</style>

<script>
    export default {
        data(){
            return {
                Year : '',
                Term : '',
                hadBooked : false,
                postObj : {},
                EmptyBook : false,
                user : {},
                bookLists : [],
                queryData : {},
                saveArr : [],
                SubmitLoading : false,
                AlertMess : '',
                AlertStyle : ''
            }
        },
        watch : {
          saveArr : function () {
              console.log(this.saveArr);
          }
        },
        methods : {
            getBooks : function () {
                this.user.Term = this.Year+''+this.Term;
                this.queryData.term = this.Term;
                this.queryData.year = this.Year;
                this.queryData.period = this.user.StuPeriod+''+this.user.StuClass;
                this.$http.post('http://localhost/MaterialsSub/laravel/public/index.php/api/v1/getbooks',this.queryData).then((response) => {
                    this.bookLists = response.data;
                    if(this.bookLists.length ===0){
                        this.EmptyBook = true;
                    }
                },(response) => {
                    console.log('error:'+response.data);
                });
            },


            allChecked : function (event) {
                let _this = this;
                if(!event.currentTarget.checked) {
                    this.saveArr = [];
                } else { //实现全选
                    _this.saveArr = [];
                    _this.bookLists.forEach(function(item) {
                        _this.saveArr.push(item);
                    });
                }
            },

            addBooks : function () {
                if(this.saveArr.length ===0){
                    let _this = this;
                    setTimeout(function () {
                        _this.AlertStyle = 'color:red';
                        _this.AlertMess = '请至少选择一本教材';
                        $('#AlertSmModal').modal('show');
                    },100);
                }else{
                    this.SubmitLoading = true;
                    this.$http.post('http://localhost/MaterialsSub/laravel/public/index.php/api/v1/addamount',this.saveArr).then((response) => {
                        let status = response.data.status;
                        if(status === 'success'){
                            let _this = this;
                            _this.$http.post('http://localhost/MaterialsSub/laravel/public/index.php/api/v1/hadbooked',this.postObj)
                                .then((resp) => {
                                    if(resp.data){
                                        setTimeout(function () {
                                            _this.AlertStyle = 'color:green';
                                            _this.AlertMess = '征订成功!';
                                            $('#AlertSmModal').modal('show');
                                        },200);
                                        _this.SubmitLoading = false;
                                        _this.hadBooked = true;
                                    }
                                },(resp) => {
                                    console.log('error:'+resp.data);
                                });
                        }
                    },(response) => {
                        console.log(response.data);
                        this.SubmitLoading = false;
                    });
                }
            },
            checkIfBooked : function () {
                this.postObj = {
                    'stuAcc' : this.user.StuAccount,
                    'hadYear' : this.Year,
                    'hadSemester' : this.Term
                };
                this.$http.post('http://localhost/MaterialsSub/laravel/public/index.php/api/v1/checkifbooked',
                     this.postObj
                ).then((response) => {
                    let bookedNum = response.data[0].HadSubscribe;
                    this.hadBooked = bookedNum !== '0';
                },(response) => {
                    console.log(response.data);
                });
            },
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
            }

        },
        mounted(){
            console.log('Student Component mounted.');
            this.getCurrentDate();
            this.user = JSON.parse(document.getElementById('acc').value);
            console.log(this.user);
            this.checkIfBooked();
            this.getBooks();
        }
    }
</script>