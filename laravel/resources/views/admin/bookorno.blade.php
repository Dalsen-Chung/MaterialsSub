@extends('admin.adminlayouts')

@section('styles')
    <style type="text/css">
        .bookOrNo{
            width: 65%;
            margin: 0 auto;
        }
        .bookOrNo h2{
            text-align: center;
            padding: 20px 0;
        }
        .bookOrNo .panel-body{
            color: #323639;
        }
        .bookOrNo .panel-body input[type="file"]{
            width: 80%;
            text-align: center;
            margin: 20px auto;
        }
        .bookOrNo table th{
            font-size: 14px;
            text-align: center;
            line-height: 30px !important;
        }
    </style>
@endsection()

@section('bookOrNo')
    <div class="bookOrNo">
        <h2>Student Book OR NO Management</h2>
        <div class="panel panel-primary">
            <div class="panel-heading"><span class="glyphicon glyphicon-education"></span> Booked List</div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>序号</th>
                            <th>账号</th>
                            <th>选材学年</th>
                            <th>选材学期</th>
                            <th>是否已选</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @for($i=0;$i<sizeof($bookorno);$i++)
                            <tr>
                                <th>{{ $i+1 }}</th>
                                <th>{{ $bookorno[$i]->HadAccount }}</th>
                                <th>{{ $bookorno[$i]->HadYear }}</th>
                                <th>{{ $bookorno[$i]->HadSemester }}</th>
                                <th>{{ $bookorno[$i]->HadSubscribe == '1' ? '是':'否'}}</th>
                                <th>
                                    <a href="{{ url('admin/bookorno/delete').'/'.$bookorno[$i]->HadId }}" class="btn btn-sm btn-danger">Delete Record</a>
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