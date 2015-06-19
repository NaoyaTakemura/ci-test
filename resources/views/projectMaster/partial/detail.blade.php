					<table class="table table-striped table-hover" id='project-detail'>
						<tbody>
							<tr>
								<th>ID</th>
								<td>{{ $project->id }}</td>
							</tr>
							<tr>
								<th>プロジェクト名</th>
								<td>{{ $project->name }}</td>
							</tr>
							<tr>
								<th>プロジェクトカラー</th>
								<td><span style="background-color: {{ $project->color }}">&emsp;</span> {{ $project->color }}</td>
							</tr>
							<tr>
								<th>企業名</th>
								<td>{{ $project->companyMasters->name }}</td>
							</tr>
						</tbody>
					</table>
