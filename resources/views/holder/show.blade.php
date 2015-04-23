    @extends('app')
      
      @section('content')
					<h2 class="page-header"><small>{{ $data->name }}</small></h2>
					{!! $registed !!}
					@include('holder.partial.detail', $data)
					{!! HTML::linkRoute('holders/editInput', '編集画面へ', [$data->id], ['title'=>'編集画面へ', 'class'=>'btn btn-warning']) !!}
					{!! HTML::linkRoute('holders/index', '一覧画面へ', [], ['title'=>'一覧画面へ', 'class'=>'btn btn-default']) !!}
      @endsection

