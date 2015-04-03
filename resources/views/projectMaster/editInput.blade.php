    @extends('app')
      
      @section('content')
					<h2 class="page-header">プロジェクト編集</h2>

					{!! Form::open(array('route' => 'projectMasters/editConfirm')) !!}
					<table class="table table-striped table-hover">
						<tbody>
							<tr>
								<th>企業名</th>
								<td>{!! $errors->first('company_id', '<p>:message</p>') !!}{!! Form::select('company_id', $companies, $project->company_id) !!}</td>
							</tr>
							<tr>
								<th>プロジェクト名</th>
								<td>{!! $errors->first('name', '<p>:message</p>') !!}<input type='text' name='name' value='{{ $project->name }}' /></td>
							</tr>
						</tbody>
					</table>
					{!! Form::submit('確認画面へ') !!}
					{!! HTML::linkRoute('projectMasters/index', '一覧画面へ', [], ['title'=>'一覧画面へ']) !!}
					{!! Form::close() !!}
      @endsection

