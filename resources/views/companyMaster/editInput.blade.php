    @extends('app')
      
      @section('content')
					<h2 class="page-header">企業編集</h2>

					{!! Form::open(array('route' => 'companyMasters/editConfirm')) !!}
					<table class="table table-striped table-hover">
						<tbody>
							<tr>
							<tr>
								<th>企業名</th>
								<td>{!! $errors->first('name', '<p>:message</p>') !!}<input type='text' name='name' class='w60p' value='{{ $company->name }}' /></td>
							</tr>
						</tbody>
					</table>
					{!! Form::submit('確認画面へ', ['class' => 'btn btn-primary']) !!}
					{!! HTML::linkRoute('companyMasters/index', '一覧画面へ', [], ['title'=>'一覧画面へ', 'class'=>'btn btn-default']) !!}
					{!! Form::close() !!}
      @endsection

