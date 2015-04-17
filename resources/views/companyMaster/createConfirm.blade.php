    @extends('app')
      
      @section('content')
					<h2 class="page-header">企業登録</h2>
					{!! Form::open(array('route' => 'companyMasters/createRegist')) !!}
					<table class="table table-striped table-hover" id='company-create'>
						<tbody>
							<tr>
							<tr>
								<th>プロジェクト名</th>
								<td>{{ $data['name'] }}</td>
							</tr>
						</tbody>
					</table>
					{!! Form::submit('登録', ['class' => 'btn btn-primary']) !!}
					{!! HTML::linkRoute('companyMasters/createInput', '修正する', [], ['title'=>'修正する', 'class' => 'btn btn-warning']) !!}
					{!! Form::close() !!}
      @endsection

