    @extends('app')
      
      @section('content')
					<link href="/css/fullcalendar.min.css" rel="stylesheet">
					<script type="text/javascript" src="/js/moment.min.js"></script>
					<script type="text/javascript" src="/js/fullcalendar.min.js"></script>
					<h2 class="page-header"><small>カレンダー</small></h2>
					<div>
						{!! HTML::linkRoute('tasks/createInput', '新規登録', [], ['title'=>'新規登録', 'class' => 'btn btn-primary']) !!}
						{!! HTML::linkRoute('tasks/priorityList', 'プライオリティ変更', [], ['title'=>'プライオリティ変更', 'class' => 'btn btn-primary']) !!}
					</div>
					<div id="calendar"></div>

					<script>
						$(function(){
							$('#calendar').fullCalendar({
								header: {
									left: 'prev,next today',
									center: 'title',
									right: 'month,agendaWeek,agendaDay'
								},
							    dayNames: ['日曜日','月曜日','火曜日','水曜日','木曜日','金曜日','土曜日'],
							    dayNamesShort: ['日','月','火','水','木','金','土'],
							    titleFormat: {
							        month: 'YYYY年 M月',
							        week: 'YYYY年 M月 D日',
							        day: 'YYYY年 M月 D日'
							    },
							    buttonText: {
							        today: '今日'
							    },
								events: {!! $tasks !!},
							});
						});
					</script>
      @endsection

