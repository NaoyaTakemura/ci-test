    @extends('app')
      
      @section('content')
					<h2 class="page-header">プロジェクト登録</h2>
					{!! Form::open(array('route' => 'projectMasters/createRegist')) !!}
					<table class="table table-striped table-hover">
						<tbody>
							<tr>
								<th>企業名</th>
								<td>{{ $data['company_id'] }}</td>
							</tr>
							<tr>
								<th>プロジェクト名</th>
								<td>{{ $data['name'] }}</td>
							</tr>
						</tbody>
					</table>
					{!! Form::submit('登録') !!}
					{!! HTML::linkRoute('projectMasters/createInput', '修正する', [], ['title'=>'修正する']) !!}
					{!! Form::close() !!}
      @endsection

