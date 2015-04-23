    @extends('app')
      
      @section('content')
					<h2 class="page-header"><small>プロジェクト編集</small></h2>
					{!! Form::open(array('route' => array('companyMasters/editRegist'))) !!}
					@include('companyMaster.partial.confirm', $data)
					{!! Form::submit('登録', ['class' => 'btn btn-primary']) !!}
					{!! HTML::linkRoute('companyMasters/editInput', '修正する', [$data['company_id']], ['title'=>'修正する', 'class' => 'btn btn-warning']) !!}
					{!! Form::close() !!}
      @endsection

