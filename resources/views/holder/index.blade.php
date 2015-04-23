    @extends('app')
      
      @section('content')
					<h2 class="page-header"><small>担当者一覧</small></h2>
					{!! $deleted !!}
					<div>
						{!! HTML::linkRoute('holders/createInput', '新規登録', [], ['title'=>'新規登録', 'class' => 'btn btn-primary']) !!}
					</div>
					@if(count($holders) > 0)
					<table class="table table-striped table-hover" id="holder-list">
						<thead>
							<tr>
								<th>ID</th>
								<th>企業名</th>
								<th>担当名</th>
								<th>編集</th>
								<th>削除</th>
							</tr>
						</thead>
						<tbody>
						@foreach($holders as $holder)
							<tr>
								<td>{{ $holder->id }}</td>
								<td>{{ $holder->companyMasters->name }}</td>
								<td>{!! HTML::linkRoute('holders/show', e($holder->name), [$holder->id], ['title'=>e($holder->name)]) !!}</td>
								<td>{!! HTML::linkRoute('holders/editInput', '編集', [$holder->id], ['title'=>'編集']) !!}</td>
								<td>{!! HTML::linkRoute('holders/deleteConfirm', '削除', [$holder->id], ['title'=>'削除']) !!}</td>
							</tr>
						@endforeach
						</tbody>
					</table>
					@else
					<div>データが存在しません</div>
					@endif
      @endsection

