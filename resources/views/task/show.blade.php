    @extends('app')
      
      @section('content')
					<h2 class="page-header">{{ $task->title }}</h2>
					{!! $registed !!}
					<table class="table table-striped table-hover">
						<tbody>
							<tr>
								<th>ID</th>
								<td>{{ $task->id }}</td>
							</tr>
							<tr>
								<th>企業名</th>
								<td>{{ $task->projectMasters->companyMasters->name }}</td>
							</tr>
							<tr>
								<th>プロジェクト名</th>
								<td>{{ $task->projectMasters->name }}</td>
							</tr>
							<tr>
								<th>タスク</th>
								<td>{{ $task->title }}</td>
							</tr>
							<tr>
								<th>内容</th>
								<td>{!! nl2br(e($task->text)) !!}</td>
							</tr>
							<tr>
								<th>プライオリティ</th>
								<td>{{ $task->priority }}</td>
							</tr>
							<tr>
								<th>期限</th>
								<td>{{ date('Y/m/d G:i', strtotime($task->limit)) }}</td>
							</tr>
							<tr>
								<th>進捗</th>
								<td>{{ $task->progress }}%</td>
							</tr>
						</tbody>
					</table>
					{!! HTML::linkRoute('tasks/editInput', '編集画面へ', [$task->id], ['title'=>'編集画面へ', 'class'=>'btn btn-warning']) !!}
					{!! HTML::linkRoute('tasks/index', '一覧画面へ', [], ['title'=>'一覧画面へ', 'class'=>'btn btn-default']) !!}
      @endsection

