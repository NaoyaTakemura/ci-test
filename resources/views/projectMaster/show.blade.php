    @extends('app')
      
      @section('content')
					<h2 class="page-header">{{ $project->name }}</h2>
					{!! $registed !!}
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th>ID</th>
								<th>プロジェクト名</th>
								<th>企業名</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>{{ $project->id }}</td>
								<td>{{ $project->name }}</td>
								<td>{{ $project->companyMasters->name }}</td>
							</tr>
						</tbody>
					</table>
					{!! HTML::linkRoute('projectMasters/editInput', '編集画面へ', [$project->id], ['title'=>'編集画面へ', 'class'=>'btn btn-warning']) !!}
					{!! HTML::linkRoute('projectMasters/index', '一覧画面へ', [], ['title'=>'一覧画面へ', 'class'=>'btn btn-default']) !!}
      @endsection

