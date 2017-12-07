@extends('admin.adminlayouts')

@section('styles')
    <style type="text/css">
        .dean{
            width: 65%;
            margin: 0 auto;
        }
        .dean h2{
            text-align: center;
            padding: 20px 0;
        }
        .dean .panel-body{
            color: #323639;
        }
        .dean .panel-body input[type="file"]{
            width: 80%;
            text-align: center;
            margin: 20px auto;
        }
        .dean table th{
            font-size: 14px;
            text-align: center;
            line-height: 30px !important;
        }
    </style>
@endsection()

@section('dean')
    <div class="dean">
        <h2>Academic User Management</h2>
        <div class="panel panel-primary">
            <div class="panel-heading"><span class="glyphicon glyphicon-education"></span> Academic Dean User</div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>序号</th>
                            <th>姓名</th>
                            <th>账号</th>
                            <th>院系</th>
                            <th>职位</th>
                            <th>电话</th>
                            <th>邮箱</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @for($i=0;$i<sizeof($deans);$i++)
                            <tr>
                                <th>{{ $i+1 }}</th>
                                <th>{{ $deans[$i]->EduMName }}</th>
                                <th>{{ $deans[$i]->EduMAccount }}</th>
                                <th>{{ $deans[$i]->EduMDepartment }}</th>
                                <th>{{ $deans[$i]->EduMPosition }}</th>
                                <th>{{ $deans[$i]->EduMPhone }}</th>
                                <th>{{ $deans[$i]->EduMEmail }}</th>
                                <th>
                                    <a href="{{ url('admin/dean/delete').'/'.$deans[$i]->EduMId }}" class="btn btn-sm btn-danger">Delete user</a>
                                </th>
                            </tr>
                        @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="panel panel-primary">
            <div class="panel-heading"><span class="glyphicon glyphicon-import"></span> Add Academic Dean User From Excel File</div>
            <div class="panel-body">
                <form action="{{url('/admin/dean/add')}}" method="post" enctype="multipart/form-data">
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