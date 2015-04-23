    @extends('app')
      
      @section('content')
					<h2 class="page-header"><small>プロジェクト編集</small></h2>
					{!! Form::open(array('route' => array('holders/editRegist'))) !!}
					<table class="table table-striped table-hover">
						<tbody>
							<tr>
								<th>企業名</th>
								<td>{{ $data['company_id'] }}</td>
							</tr>
							<tr>
								<th>担当者名</th>
								<td>{{ $data['name'] }}</td>
							</tr>
						</tbody>
					</table>
					{!! Form::submit('登録', ['class' => 'btn btn-primary']) !!}
					{!! HTML::linkRoute('holders/editInput', '修正する', [$data['holder_id']], ['title'=>'修正する', 'class' => 'btn btn-warning']) !!}
					{!! Form::close() !!}
      @endsection

