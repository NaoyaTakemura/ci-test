					<table class="table table-striped table-hover" id='task-create'>
						<tbody>
							<tr>
								<th width="25%">企業</th>
								<td width="75%">{!! $errors->first('company_id', '<p>:message</p>') !!}{!! Form::select('company_id', $companies, $data->company_id, ['id' => 'company_id']) !!}</td>
							</tr>
							<tr>
								<th>プロジェクト</th>
								<td>{!! $errors->first('project_id', '<p>:message</p>') !!}{!! Form::select('project_id', $projects, $data->project_id, ['id' => 'project_id']) !!}</td>
							</tr>
							<tr>
								<th>タスク</th>
								<td>{!! $errors->first('title', '<p>:message</p>') !!}<input type='text' name='title' class='w60p' value='{{ $data->title or '' }}' /></td>
							</tr>
							<tr>
								<th>内容</th>
								<td>{!! $errors->first('text', '<p>:message</p>') !!}<textarea name='text' class='w60p' rows='4'>{{ $data->text or '' }}</textarea></td>
							</tr>
							<tr>
								<th>プライオリティ</th>
								<td>{!! $errors->first('priority', '<p>:message</p>') !!}<input type='text' name='priority' value='{{ $data->priority or '' }}' /></td>
							</tr>
							<tr>
								<th>期限</th>
								<td>{!! $errors->first('limit', '<p>:message</p>') !!}<input type='text' id="datepicker" name='limit' value='' /></td>
							</tr>
							<tr>
								<th>進捗</th>
								<td>{!! $errors->first('progress', '<p>:message</p>') !!}<input type='text' name='progress' value='{{ $data->progress or '' }}' /></td>
							</tr>
						</tbody>
					</table>
					{!! Form::submit('確認画面へ', ['class' => 'btn btn-primary']) !!}
					{!! HTML::linkRoute('tasks/index', '一覧画面へ', [], ['title'=>'一覧画面へ', 'class'=>'btn btn-default']) !!}
					

