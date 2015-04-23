					<table class="table table-striped table-hover" id='project-table'>
						<tbody>
							<tr>
								<th>企業名</th>
								<td>{!! $errors->first('company_id', '<p class="text-danger">:message</p>') !!}{!! Form::select('company_id', $companies, $data->company_id) !!}</td>
							</tr>
							<tr>
								<th>担当者名</th>
								<td>{!! $errors->first('name', '<p class="text-danger">:message</p>') !!}<input type='text' name='name' class='w60p' value='{{ $data->name or '' }}' /></td>
							</tr>
						</tbody>
					</table>
					{!! Form::submit('確認画面へ', ['class' => 'btn btn-primary']) !!}
					{!! HTML::linkRoute('holders/index', '一覧画面へ', [], ['title'=>'一覧画面へ', 'class'=>'btn btn-default']) !!}