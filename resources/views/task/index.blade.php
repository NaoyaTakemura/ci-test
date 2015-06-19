    @extends('app')
      
      @section('content')
					<script type="text/javascript" src="/js/jquery.tgClickToolTip.js"></script>
					<link href="/css/jquery.tgClickToolTip.css" rel="stylesheet">
					<h2 class="page-header"><small>タスク一覧</small></h2>
					{!! $message !!}
					<div>
						{!! HTML::linkRoute('tasks/createInput', '新規登録', [], ['title'=>'新規登録', 'class' => 'btn btn-primary']) !!}
					</div>
					@if(count($tasks) > 0)
					<table class="table table-striped table-hover" id="task-list">
						<thead>
							<tr>
								<th width="5%">ID</th>
								<th width="10%">企業名</th>
								<th width="15%">プロジェクト名</th>
								<th width="40%">タスク</th>
								<th width="10%">ボール保持者</th>
								<th width="10%">期限</th>
								<th width="5%">編集</th>
								<th width="5%">削除</th>
							</tr>
						</thead>
						<tbody>

						@foreach($tasks as $task)
							<tr>
								<td>{{ $task->id }}</td>
								<td>{{ $task->projectMasters->companyMasters->name }}</td>
								<td>{{ $task->projectMasters->name }}</td>
								<td>
									<img class="tooltip{{ $task->id }}" src="/images/file.png" />
									{!! HTML::linkRoute('tasks/show', e($task->title), [$task->id], ['title'=>e($task->title)]) !!}
									<p id="tooltip{{ $task->id }}" class="toolTip invisible">{!! nl2br(e($task->text)) !!}</p>
								</td>
								<td>{{ $task->holders->name }}</td>
								<td>{{ date('Y/m/d G:i', strtotime($task->limit)) }}</td>
								<td>{!! HTML::linkRoute('tasks/editInput', '編集', [$task->id], ['title'=>'編集']) !!}</td>
								<td>{!! HTML::linkRoute('tasks/deleteConfirm', '削除', [$task->id], ['title'=>'削除']) !!}</td>
							</tr>
						@endforeach
						</tbody>
					</table>
					<script>
						$(function(){
							$(this).tgClickToolTip({
								selector : '#task-list td:nth-child(4) img',    // セレクタ
								PositionTop : '-20',            // ツールチップ出現位置（+数値で下方向へ移動）
								PositionLeft : '40',            // ツールチップ出現位置（+数値で右方向へ移動）
							});
						});
					</script>
					@else
					<div>データが存在しません</div>

					@endif
      @endsection

