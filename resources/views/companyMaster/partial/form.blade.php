					<table class="table table-striped table-hover" id='company-create'>
						<tbody>
							<tr>
								<th>企業名</th>
								<td>{!! $errors->first('name', '<p class="text-danger">:message</p>') !!}<input type='text' name='name' class='w60p' value='{{ $data->name or '' }}' /></td>
							</tr>
						</tbody>
					</table>