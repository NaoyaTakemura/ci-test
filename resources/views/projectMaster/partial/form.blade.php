					<table class="table table-striped table-hover" id='project-create'>
						<tbody>
							<tr>
								<th>企業名</th>
								<td>{!! $errors->first('company_id', '<p class="text-danger">:message</p>') !!}{!! Form::select('company_id', $companies, $data->company_id) !!}</td>
							</tr>
							<tr>
								<th>プロジェクト名</th>
								<td>{!! $errors->first('name', '<p class="text-danger">:message</p>') !!}<input type='text' name='name' class='w60p' value='{{ $data->name or '' }}' /></td>
							</tr>
							<tr>
								<th>プロジェクトカラー</th>
								<td>{!! $errors->first('color', '<p class="text-danger">:message</p>') !!}<input type='text' name='color' class='w60p' value='{{ $data->color or '' }}' /></td>
							</tr>
						</tbody>
					</table>
					{!! Form::submit('確認画面へ', ['class' => 'btn btn-primary']) !!}
					{!! HTML::linkRoute('projectMasters/index', '一覧画面へ', [], ['title'=>'一覧画面へ', 'class'=>'btn btn-default']) !!}