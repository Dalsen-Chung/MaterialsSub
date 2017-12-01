<template>
    <div class="container warp">
        <div class="col-md-3">
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
        <div class="col-md-9">
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
                            <th>使用学期</th>
                            <th>参考价格</th>
                            <th>总数量</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>1</th>
                                <th>1</th>
                                <th>1</th>
                                <th>1</th>
                                <th>1</th>
                                <th>1</th>
                                <th>1</th>
                                <th>1</th>
                                <th>1</th>
                                <th>1</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
    .warp{
        padding-top: 20px;
        padding-bottom: 250px;
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
                books : []
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