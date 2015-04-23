    @extends('app')
      
      @section('content')
					<h2 class="page-header"><small>タスク編集</small></h2>
					{!! Form::open(array('route' => array('tasks/editRegist'))) !!}
						@include('task.partial.confirm', $data)
					{!! Form::submit('登録', ['class' => 'btn btn-primary']) !!}
					{!! HTML::linkRoute('tasks/editInput', '修正する', [$data['id']], ['title'=>'修正する', 'class' => 'btn btn-warning']) !!}
					{!! Form::close() !!}
      @endsection

