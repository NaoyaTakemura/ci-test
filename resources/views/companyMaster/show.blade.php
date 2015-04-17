    @extends('app')
      
      @section('content')
					<h2 class="page-header">{{ $company->name }}</h2>
					{!! $registed !!}
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th>ID</th>
								<th>プロジェクト名</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>{{ $company->id }}</td>
								<td>{{ $company->name }}</td>
							</tr>
						</tbody>
					</table>
					{!! HTML::linkRoute('companyMasters/index', '一覧画面へ', [], ['title'=>'一覧画面へ', 'class'=>'btn btn-default']) !!}
      @endsection

