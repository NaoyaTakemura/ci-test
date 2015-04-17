    @extends('app')
      
      @section('content')
					<h2 class="page-header">プロジェクト一覧</h2>
					{!! $deleted !!}
					<div>
						{!! HTML::linkRoute('projectMasters/createInput', '新規登録', [], ['title'=>'新規登録', 'class' => 'btn btn-primary']) !!}
					</div>
					@if(count($projects) > 0)
					<table class="table table-striped table-hover" id="project-list">
						<thead>
							<tr>
								<th>ID</th>
								<th>プロジェクト名</th>
								<th>企業名</th>
								<th>編集</th>
								<th>削除</th>
							</tr>
						</thead>
						<tbody>
						@foreach($projects as $project)
							<tr>
								<td>{{ $project->id }}</td>
								<td>{!! HTML::linkRoute('projectMasters/show', e($project->name), [$project->id], ['title'=>e($project->name)]) !!}</td>
								<td>{{ $project->companyMasters->name }}</td>
								<td>{!! HTML::linkRoute('projectMasters/editInput', '編集', [$project->id], ['title'=>'編集']) !!}</td>
								<td>{!! HTML::linkRoute('projectMasters/deleteConfirm', '削除', [$project->id], ['title'=>'削除']) !!}</td>
							</tr>
						@endforeach
						</tbody>
					</table>
					@else
					<div>データが存在しません</div>
					@endif
      @endsection

