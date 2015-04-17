    @extends('app')
      
      @section('content')
					<h2 class="page-header">プロジェクト削除確認</h2>
						@include('task.partial.confirm', $data)
					{!! HTML::linkRoute('tasks/delete', '削除', [], ['title'=>'削除', 'class'=>'btn btn-danger']) !!}
					{!! HTML::linkRoute('tasks/index', '一覧画面へ', [], ['title'=>'一覧画面へ', 'class'=>'btn btn-default']) !!}
      @endsection

