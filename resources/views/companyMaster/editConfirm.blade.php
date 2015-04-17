    @extends('app')
      
      @section('content')
					<h2 class="page-header">プロジェクト編集</h2>
					{!! Form::open(array('route' => array('companyMasters/editRegist'))) !!}
					<table class="table table-striped table-hover">
						<tbody>
							<tr>
								<th>企業名</th>
								<td>{{ $data['name'] }}</td>
							</tr>
						</tbody>
					</table>
					{!! Form::submit('登録', ['class' => 'btn btn-primary']) !!}
					{!! HTML::linkRoute('companyMasters/editInput', '修正する', [$data['company_id']], ['title'=>'修正する', 'class' => 'btn btn-warning']) !!}
					{!! Form::close() !!}
      @endsection

