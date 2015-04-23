<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
		<meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>TaskManager</title>
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
        <link href="/css/app.css" rel="stylesheet">
		<link href="/css/style.css" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <h1><small>TODO</small></h1>
				<div class="row">
				<ul class="list-inline">
					<li>{!! HTML::linkRoute('tasks/index', 'タスク管理', [], ['title'=>'タスク管理']) !!}</li>
					<li>{!! HTML::linkRoute('projectMasters/index', 'プロジェクト管理', [], ['title'=>'プロジェクト管理']) !!}</li>
					<li>{!! HTML::linkRoute('companyMasters/index', '企業管理', [], ['title'=>'企業管理']) !!}</li>
					<li>{!! HTML::linkRoute('holders/index', '担当者管理', [], ['title'=>'担当者管理']) !!}</li>
				</ul>
                <div class="col-md-12">
                    @yield('content')
                </div>
            </div>
        </div>
    </body>
</html>
