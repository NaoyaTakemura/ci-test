					<table class="table table-striped table-hover" id='task-create'>
						<tbody>
							<tr>
								<th>企業</th>
								<td>{{ $data['company_id'] }}</td>
							</tr>
							<tr>
								<th>プロジェクト</th>
								<td>{{ $data['project_id'] }}</td>
							</tr>
							<tr>
								<th>タスク</th>
								<td>{{ $data['title'] }}</td>
							</tr>
							<tr>
								<th>内容</th>
								<td>{!! nl2br(e( $data['text'])) !!}</td>
							</tr>
							<!--tr>
								<th>プライオリティ</th>
								<td>{{ $data['priority'] }}</td>
							</tr-->
							<tr>
								<th>期限</th>
								<td>{{ $data['limit'] }}</td>
							</tr>
							<tr>
								<th>進捗</th>
								<td>{{ $data['progress'] }}</td>
							</tr>
							<tr>
								<th>ボール保持者</th>
								<td>{{ $data['holder_id'] }}</td>
							</tr>
						</tbody>
					</table>