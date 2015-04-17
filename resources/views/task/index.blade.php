    @extends('app')
      
      @section('content')
					<h2 class="page-header">タスク一覧</h2>
					{!! $deleted !!}
					<div>
						{!! HTML::linkRoute('tasks/createInput', '新規登録', [], ['title'=>'新規登録', 'class' => 'btn btn-primary']) !!}
					</div>
					@if(count($tasks) > 0)
					<table class="table table-striped table-hover" id="task-list">
						<thead>
							<tr>
								<th width="5%">ID</th>
								<th width="10%">企業名</th>
								<th width="20%">プロジェクト名</th>
								<th width="35%">タスク</th>
								<th width="10%">プライオリティ</th>
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
								<td>{!! HTML::linkRoute('tasks/show', e($task->title), [$task->id], ['title'=>e($task->title)]) !!}</td>
								<td>{{ $task->priority }}</td>
								<td>{{ date('Y/m/d G:i', strtotime($task->limit)) }}</td>
								<td>{!! HTML::linkRoute('tasks/editInput', '編集', [$task->id], ['title'=>'編集']) !!}</td>
								<td>{!! HTML::linkRoute('tasks/deleteConfirm', '削除', [$task->id], ['title'=>'削除']) !!}</td>
							</tr>
						@endforeach
						</tbody>
					</table>
					@else
					<div>データが存在しません</div>
					@endif
      @endsection

