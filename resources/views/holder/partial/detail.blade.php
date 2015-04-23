					<table class="table table-striped table-hover">
						<tbody>
							<tr>
								<th>ID</th>
								<td>{{ $data->id }}</td>
							</tr>
							<tr>
								<th>担当者名</th>
								<td>{{ $data->name }}</td>
							</tr>
							<tr>
								<th>企業名</th>
								<td>{{ $data->companyMasters->name }}</td>
							</tr>
						</tbody>
					</table>