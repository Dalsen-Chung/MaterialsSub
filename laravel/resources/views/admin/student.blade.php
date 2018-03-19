@extends('admin.adminlayouts')

@section('styles')
    <style type="text/css">
        .student{
            width: 65%;
            margin: 0 auto;
        }
        .student h2{
            text-align: center;
            padding: 20px 0;
        }
        .student .panel-body{
            color: #323639;
        }
        .student .panel-body input[type="file"]{
            width: 80%;
            text-align: center;
            margin: 20px auto;
        }
        .student table th{
            font-size: 14px;
            text-align: center;
            line-height: 30px !important;
        }
    </style>
@endsection()

@section('student')
    <div class="student">
        <h2>Student Management</h2>
        <div class="panel panel-primary">
            <div class="panel-heading"><span class="glyphicon glyphicon-education"></span> Student User</div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>序号</th>
                                <th>姓名</th>
                                <th>账号</th>
                                <th>院系</th>
                                <th>年级</th>
                                <th>专业</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for($i=0;$i<sizeof($students);$i++)
                                <tr>
                                    <th>{{ $i+1 }}</th>
                                    <th>{{ $students[$i]->StuName }}</th>
                                    <th>{{ $students[$i]->StuAccount }}</th>
                                    <th>{{ $students[$i]->StuDepartment }}</th>
                                    <th>{{ $students[$i]->StuPeriod }}</th>
                                    <th>{{ $students[$i]->StuClass }}</th>
                                    <th>
                                        <a href="{{ url('admin/student/delete').'/'.$students[$i]->StuID }}" class="btn btn-sm btn-danger">Delete user</a>
                                    </th>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="panel panel-primary">
            <div class="panel-heading"><span class="glyphicon glyphicon-import"></span> Add Student User From Excel File</div>
            <div class="panel-body">
                <form action="{{url('/admin/student/add')}}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                    <input type="file" name="excel" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />
                    <button type="submit" class="btn btn-primary btn-block" id="fetchExcel">Fetch Data From Excel </button>
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