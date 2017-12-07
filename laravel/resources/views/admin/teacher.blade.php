@extends('admin.adminlayouts')

@section('styles')
    <style type="text/css">
        .teacher{
            width: 65%;
            margin: 0 auto;
        }
        .teacher h2{
            text-align: center;
            padding: 20px 0;
        }
        .teacher .panel-body{
            color: #323639;
        }
        .teacher .panel-body input[type="file"]{
            width: 80%;
            text-align: center;
            margin: 20px auto;
        }
        .teacher table th{
            font-size: 14px;
            text-align: center;
            line-height: 30px !important;
        }
    </style>
@endsection()

@section('teacher')
    <div class="teacher">
        <h2>Teacher Management</h2>
        <div class="panel panel-primary">
            <div class="panel-heading"><span class="glyphicon glyphicon-user"></span> Teacher User</div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>序号</th>
                            <th>姓名</th>
                            <th>账号</th>
                            <th>院系</th>
                            <th>学历</th>
                            <th>电话</th>
                            <th>邮箱</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @for($i=0;$i<sizeof($teachers);$i++)
                            <tr>
                                <th>{{ $i+1 }}</th>
                                <th>{{ $teachers[$i]->TeaName }}</th>
                                <th>{{ $teachers[$i]->TeaAccount }}</th>
                                <th>{{ $teachers[$i]->TeaDepartment }}</th>
                                <th>{{ $teachers[$i]->TeaEducation }}</th>
                                <th>{{ $teachers[$i]->TeaPhone }}</th>
                                <th>{{ $teachers[$i]->TeaEmail }}</th>
                                <th>
                                    <a href="{{ url('admin/teacher/delete').'/'.$teachers[$i]->Teaid }}" class="btn btn-sm btn-danger">Delete user</a>
                                </th>
                            </tr>
                        @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="panel panel-primary">
            <div class="panel-heading"><span class="glyphicon glyphicon-import"></span> Add Teacher User From Excel File</div>
            <div class="panel-body">
                <form action="{{url('/admin/teacher/add')}}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                    <input type="file" name="excel" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />
                    <button type="submit" class="btn btn-primary btn-block">Fetch Data From Excel </button>
                    @if(count($errors)>0)
                        <div class="error">
                            @foreach($errors->all() as $error)
                                <p class="text-danger" style="text-align: center;margin-top: 10px">{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
@endsection()

@section('scripts')
    <script type="text/javascript">
    </script>
@endsection()