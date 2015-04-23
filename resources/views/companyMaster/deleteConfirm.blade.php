    @extends('app')
      
      @section('content')
					<h2 class="page-header"><small>企業削除確認</small></h2>
					@include('companyMaster.partial.detail', $company)
					{!! HTML::linkRoute('companyMasters/delete', '削除', [], ['title'=>'削除', 'class'=>'btn btn-danger']) !!}
					{!! HTML::linkRoute('companyMasters/index', '一覧画面へ', [], ['title'=>'一覧画面へ', 'class'=>'btn btn-default']) !!}
      @endsection

