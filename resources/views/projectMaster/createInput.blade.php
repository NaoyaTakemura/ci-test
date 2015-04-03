    @extends('app')
      
      @section('content')
					<h2 class="page-header">プロジェクト登録</h2>

					{!! Form::open(array('route' => 'projectMasters/createConfirm')) !!}
					<table class="table table-striped table-hover" id='project-create'>
						<tbody>
							<tr>
								<th>企業名</th>
								<td>{!! $errors->first('company_id', '<p>:message</p>') !!}{!! Form::select('company_id', $companies, $data->company_id) !!}</td>
							</tr>
							<tr>
								<th>プロジェクト名</th>
								<td>{!! $errors->first('name', '<p>:message</p>') !!}<input type='text' name='name' value='{{ $data->name or '' }}' /></td>
							</tr>
						</tbody>
					</table>
					{!! Form::submit('確認画面へ') !!}
					{!! HTML::linkRoute('projectMasters/index', '一覧画面へ', [], ['title'=>'一覧画面へ']) !!}
					{!! Form::close() !!}
      @endsection

