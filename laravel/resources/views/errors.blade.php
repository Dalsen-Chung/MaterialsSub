<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
    <link rel="shortcut icon" href="{{ config('system.default_icon') }}">
    <title>出错啦!</title>
    <script type="text/javascript">setTimeout(function(){top.location='{{ url('admin/student') }}';},3000)</script>
    <style type="text/css">
        body{text-align:center}
    </style>
</head>

<body>
<p><img alt="404" src="{{ asset('images/404.gif') }}" width="520" height="320" /></p>
<h1>抱歉，这个页面已经被外星人绑架了</h1>
<p>3秒钟后将带您返回地球</p>
</body>
</html>