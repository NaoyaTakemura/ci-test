    @extends('app')
      
      @section('content')
					<h2 class="page-header">プロジェクト削除確認</h2>
					<table class="table table-striped table-hover" id='project-detail'>
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
					{!! HTML::linkRoute('projectMasters/delete', '削除', [], ['title'=>'削除']) !!}
					{!! HTML::linkRoute('projectMasters/index', '一覧画面へ', [], ['title'=>'一覧画面へ']) !!}
      @endsection

