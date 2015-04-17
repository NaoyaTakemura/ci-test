    @extends('app')
      
      @section('content')
					<h2 class="page-header">企業削除確認</h2>
					<table class="table table-striped table-hover" id='company-detail'>
						<thead>
							<tr>
								<th>ID</th>
								<th>企業名</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>{{ $company->id }}</td>
								<td>{{ $company->name }}</td>
							</tr>
						</tbody>
					</table>
					{!! HTML::linkRoute('companyMasters/delete', '削除', [], ['title'=>'削除', 'class'=>'btn btn-danger']) !!}
					{!! HTML::linkRoute('companyMasters/index', '一覧画面へ', [], ['title'=>'一覧画面へ', 'class'=>'btn btn-default']) !!}
      @endsection

