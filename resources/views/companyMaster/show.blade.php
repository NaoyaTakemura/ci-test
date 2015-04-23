    @extends('app')
      
      @section('content')
					<h2 class="page-header"><small>{{ $company->name }}</small></h2>
					{!! $registed !!}
					@include('companyMaster.partial.detail', $company)
					{!! HTML::linkRoute('companyMasters/editInput', '編集画面へ', [$company->id], ['title'=>'編集画面へ', 'class'=>'btn btn-warning']) !!}
					{!! HTML::linkRoute('companyMasters/index', '一覧画面へ', [], ['title'=>'一覧画面へ', 'class'=>'btn btn-default']) !!}
      @endsection

