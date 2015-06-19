    @extends('app')
      
      @section('content')
					<script type="text/javascript" src="/js/jquery.tgClickToolTip.js"></script>
					<script type="text/javascript" src="/js/jquery.sortable.min.js"></script>
					<link href="/css/jquery.tgClickToolTip.css" rel="stylesheet">
					<h2 class="page-header"><small>プライオリティ設定</small></h2>

					@if(count($tasks) > 0)
					{!! Form::open(array('route' => array('tasks/priorityRegist'))) !!}
					<ul class="sortable">
						@foreach($tasks as $task)
							<li>
								<span class="p-name">{{ $task->projectMasters->name }}</span>
								
								<span class="t-name"><img class="tooltip{{ $task->id }}" src="/images/file.png" />	{!! e($task->title) !!}</span>
								<input type="hidden" name="priority[]" value="{{ $task->id }}" />	
								<p id="tooltip{{ $task->id }}" class="toolTip invisible">{!! nl2br(e($task->text)) !!}</p>
							</li>
						@endforeach
					</ul>
					<div>
					{!! Form::submit('登録', ['class' => 'btn btn-primary']) !!}
					{!! HTML::linkRoute('tasks/index', '一覧画面へ', [], ['title'=>'一覧画面へ', 'class'=>'btn btn-default']) !!}
					</div>
					{!! Form::close() !!}
					<script>
						$(function(){
							$(this).tgClickToolTip({
								selector : '.sortable li img',    // セレクタ
								PositionTop : '-20',            // ツールチップ出現位置（+数値で下方向へ移動）
								PositionLeft : '40',            // ツールチップ出現位置（+数値で右方向へ移動）
							});
							$('.sortable').sortable();
						});
					</script>
					@else
					<div>データが存在しません</div>

					@endif
      @endsection

