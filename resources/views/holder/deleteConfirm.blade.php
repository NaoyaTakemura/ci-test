    @extends('app')
      
      @section('content')
					<h2 class="page-header"><small>担当者削除確認</small></h2>
					@include('holder.partial.detail', $data)
					{!! HTML::linkRoute('holders/delete', '削除', [], ['title'=>'削除', 'class'=>'btn btn-danger']) !!}
					{!! HTML::linkRoute('holders/index', '一覧画面へ', [], ['title'=>'一覧画面へ', 'class'=>'btn btn-default']) !!}
      @endsection

