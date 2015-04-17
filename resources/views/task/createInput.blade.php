    @extends('app')
      
      @section('content')
					<script type="text/javascript" src="/js/jquery.datetimepicker.js"></script>
					<link type="text/css" href="/css/jquery.datetimepicker.css" rel="stylesheet" />
					<h2 class="page-header">タスク登録</h2>

					{!! Form::open(array('route' => 'tasks/createConfirm')) !!}
						@include('task.partial.form', $data)
					{!! Form::close() !!}
					
					<script type="text/javascript">
						var url = "{{ route('tasks/getProjectList') }}";
						var dateStr = "{{ $data->limit }}".substring(0, 16);
					</script>
					<script type="text/javascript" src="/js/task/taskForm.js"></script>
      @endsection

