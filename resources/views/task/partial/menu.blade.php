					<div class="menu-area">
						{!! HTML::linkRoute('tasks/index', 'タスク一覧', [], ['title'=>'タスク一覧', 'class' => 'btn btn-primary']) !!}
						{!! HTML::linkRoute('tasks/createInput', '新規登録', [], ['title'=>'新規登録', 'class' => 'btn btn-primary']) !!}
						{!! HTML::linkRoute('tasks/priorityList', 'プライオリティ変更', [], ['title'=>'プライオリティ変更', 'class' => 'btn btn-primary']) !!}
						{!! HTML::linkRoute('tasks/calendar', 'カレンダー', [], ['title'=>'カレンダー', 'class' => 'btn btn-primary']) !!}
					</div>
