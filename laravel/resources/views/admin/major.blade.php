@extends('admin.adminlayouts')

@section('styles')
    <style type="text/css">
        .major{
            width: 65%;
            margin: 0 auto;
        }
        .major h2{
            text-align: center;
            padding: 20px 0;
        }
        .major .panel-body{
            color: #323639;
        }
        .major .panel-body input[type="file"]{
            width: 80%;
            text-align: center;
            margin: 20px auto;
        }
        .major table th{
            font-size: 14px;
            text-align: center;
            line-height: 30px !important;
        }
    </style>
@endsection()

@section('major')
    <div class="major">
        <h2>Major Management</h2>
        <div class="panel panel-primary">
            <div class="panel-heading"><span class="glyphicon glyphicon-education"></span> Major Type</div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>序号</th>
                            <th>专业名称</th>
                            <th>专业代码</th>
                            <th>专业所属院系</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @for($i=0;$i<sizeof($majors);$i++)
                            <tr>
                                <th>{{ $i+1 }}</th>
                                <th>{{ $majors[$i]->MajorName }}</th>
                                <th>{{ $majors[$i]->MajorCode }}</th>
                                <th>{{ $majors[$i]->MajorDep }}</th>
                                <th>
                                    <a href="{{ url('admin/major/delete').'/'.$majors[$i]->Majorid }}" class="btn btn-sm btn-danger">Delete Major</a>
                                </th>
                            </tr>
                        @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="panel panel-primary">
            <div class="panel-heading"><span class="glyphicon glyphicon-import"></span> Add Major From Excel File</div>
            <div class="panel-body">
                <form action="{{url('/admin/major/add')}}" method="post" enctype="multipart/form-data">
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