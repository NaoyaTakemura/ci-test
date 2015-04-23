    @extends('app')
      
      @section('content')
					<h2 class="page-header"><small>プロジェクト削除確認</small></h2>
					<table class="table table-striped table-hover" id='holder-detail'>
						<thead>
							<tr>
								<th>ID</th>
								<th>担当者名</th>
								<th>企業名</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>{{ $holder->id }}</td>
								<td>{{ $holder->name }}</td>
								<td>{{ $holder->companyMasters->name }}</td>
							</tr>
						</tbody>
					</table>
					{!! HTML::linkRoute('holders/delete', '削除', [], ['title'=>'削除', 'class'=>'btn btn-danger']) !!}
					{!! HTML::linkRoute('holders/index', '一覧画面へ', [], ['title'=>'一覧画面へ', 'class'=>'btn btn-default']) !!}
      @endsection

