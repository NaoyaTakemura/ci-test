    @extends('app')
      
      @section('content')
					<h2 class="page-header"><small>企業一覧</small></h2>
					{!! $deleted !!}
					<div>
						{!! HTML::linkRoute('companyMasters/createInput', '新規登録', [], ['title'=>'新規登録', 'class' => 'btn btn-primary']) !!}
					</div>
					@if(count($companies) > 0)
					<table class="table table-striped table-hover" id="company-list">
						<thead>
							<tr>
								<th>ID</th>
								<th>企業名</th>
								<th>編集</th>
								<th>削除</th>
							</tr>
						</thead>
						<tbody>
						@foreach($companies as $company)
							<tr>
								<td>{{ $company->id }}</td>
								<td>{!! HTML::linkRoute('companyMasters/show', e($company->name), [$company->id], ['title'=>e($company->name)]) !!}</td>
								<td>{!! HTML::linkRoute('companyMasters/editInput', '編集', [$company->id], ['title'=>'編集']) !!}</td>
								<td>{!! HTML::linkRoute('companyMasters/deleteConfirm', '削除', [$company->id], ['title'=>'削除']) !!}</td>
							</tr>
						@endforeach
						</tbody>
					</table>
					@else
					<div>データが存在しません</div>
					@endif
      @endsection

