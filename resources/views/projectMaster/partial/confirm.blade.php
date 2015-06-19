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
							<tr>
								<th>プロジェクトカラー</th>
								<td><span style="background-color: {{ $data['color'] }}">&emsp;</span> {{ $data['color'] }}</td>
							</tr>
						</tbody>
					</table>
