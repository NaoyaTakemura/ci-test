    @extends('app')
      
      @section('content')
					<h2 class="page-header"><small>{{ $holder->name }}</small></h2>
					{!! $registed !!}
					<table class="table table-striped table-hover">
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
					{!! HTML::linkRoute('holders/editInput', '編集画面へ', [$holder->id], ['title'=>'編集画面へ', 'class'=>'btn btn-warning']) !!}
					{!! HTML::linkRoute('holders/index', '一覧画面へ', [], ['title'=>'一覧画面へ', 'class'=>'btn btn-default']) !!}
      @endsection

