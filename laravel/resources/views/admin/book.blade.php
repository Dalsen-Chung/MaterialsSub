@extends('admin.adminlayouts')

@section('styles')
    <style type="text/css">
        .book{
            width: 90%;
            margin: 0 auto;
        }
        .book h2{
            text-align: center;
            padding: 20px 0;
        }
        .book .panel-body{
            color: #323639;
        }
        .book .panel-body input[type="file"]{
            width: 80%;
            text-align: center;
            margin: 20px auto;
        }
        .book table th{
            font-size: 11px;
            text-align: center;
            line-height: 30px !important;
        }
    </style>
@endsection()

@section('book')
    <div class="book">
        <h2>Books Management</h2>
        <div class="panel panel-primary">
            <div class="panel-heading"><span class="glyphicon glyphicon-education"></span> Book List</div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>书名</th>
                            <th>作者</th>
                            <th>出版日期</th>
                            <th>出版社</th>
                            <th>ISBN</th>
                            <th>价格</th>
                            <th>用材课程</th>
                            <th>学生征订数量</th>
                            <th>教师征订数量</th>
                            <th>发放班级</th>
                            <th>用材学年</th>
                            <th>用材学期</th>
                            <th>征订总数量</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @for($i=0;$i<sizeof($books);$i++)
                            <tr>
                                <th>{{ $i+1 }}</th>
                                <th>{{ $books[$i]->BookName }}</th>
                                <th>{{ $books[$i]->BookAuthor }}</th>
                                <th>{{ $books[$i]->BookPubDate }}</th>
                                <th>{{ $books[$i]->BookPublisher }}</th>
                                <th>{{ $books[$i]->BookIsbn13 }}</th>
                                <th>{{ $books[$i]->BookPrice }}</th>
                                <th>{{ $books[$i]->BookCourse }}</th>
                                <th>{{ $books[$i]->BookForStu }}</th>
                                <th>{{ $books[$i]->BookForTea }}</th>
                                <th>{{ $books[$i]->BookToClass }}</th>
                                <th>{{ $books[$i]->Year }}</th>
                                <th>{{ $books[$i]->Semester }}</th>
                                <th>{{ $books[$i]->Amount }}</th>
                                <th>
                                    <a href="{{ url('admin/book/delete').'/'.$books[$i]->BookId }}" class="btn btn-sm btn-danger">Delete Book</a>
                                </th>
                            </tr>
                        @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection()

@section('scripts')
    <script type="text/javascript">
    </script>
@endsection()