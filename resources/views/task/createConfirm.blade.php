    @extends('app')
      
      @section('content')
					<h2 class="page-header"><small>タスク登録</small></h2>
					{!! Form::open(array('route' => 'tasks/createRegist')) !!}
						@include('task.partial.confirm', $data)
					{!! Form::submit('登録', ['class' => 'btn btn-primary']) !!}
					{!! HTML::linkRoute('tasks/createInput', '修正する', [], ['title'=>'修正する', 'class' => 'btn btn-warning']) !!}
					{!! Form::close() !!}
      @endsection

