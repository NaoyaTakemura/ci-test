    @extends('app')
      
      @section('content')
					<h2 class="page-header"><small>企業登録</small></h2>

					{!! Form::open(array('route' => 'companyMasters/createConfirm')) !!}
					@include('companyMaster.partial.form', $data)
					{!! Form::submit('確認画面へ', ['class' => 'btn btn-primary']) !!}
					{!! HTML::linkRoute('companyMasters/index', '一覧画面へ', [], ['title'=>'一覧画面へ', 'class'=>'btn btn-default']) !!}
					{!! Form::close() !!}
      @endsection

