    @extends('app')
      
      @section('content')
					<h2 class="page-header"><small>プロジェクト削除確認</small></h2>
					@include('projectMaster.partial.detail', $project)
					{!! HTML::linkRoute('projectMasters/delete', '削除', [], ['title'=>'削除', 'class'=>'btn btn-danger']) !!}
					{!! HTML::linkRoute('projectMasters/index', '一覧画面へ', [], ['title'=>'一覧画面へ', 'class'=>'btn btn-default']) !!}
      @endsection

