    @extends('app')
      
      @section('content')
					<h2 class="page-header"><small>企業登録</small></h2>
					{!! Form::open(array('route' => 'companyMasters/createRegist')) !!}
					@include('companyMaster.partial.confirm', $data)
					{!! Form::submit('登録', ['class' => 'btn btn-primary']) !!}
					{!! HTML::linkRoute('companyMasters/createInput', '修正する', [], ['title'=>'修正する', 'class' => 'btn btn-warning']) !!}
					{!! Form::close() !!}
      @endsection

