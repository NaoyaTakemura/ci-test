    @extends('app')
      
      @section('content')
					<h2 class="page-header">プロジェクト編集</h2>
					{!! Form::open(array('route' => array('projectMasters/editRegist', $data['project_id']))) !!}
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
					{!! HTML::linkRoute('projectMasters/editInput', '修正する', [$data['project_id']], ['title'=>'修正する']) !!}
					{!! Form::close() !!}
      @endsection

