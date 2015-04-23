    @extends('app')
      
      @section('content')
					<h2 class="page-header"><small>{{ $project->name }}</small></h2>
					{!! $registed !!}
					@include('projectMaster.partial.detail', $project)
					{!! HTML::linkRoute('projectMasters/editInput', '編集画面へ', [$project->id], ['title'=>'編集画面へ', 'class'=>'btn btn-warning']) !!}
					{!! HTML::linkRoute('projectMasters/index', '一覧画面へ', [], ['title'=>'一覧画面へ', 'class'=>'btn btn-default']) !!}
      @endsection

