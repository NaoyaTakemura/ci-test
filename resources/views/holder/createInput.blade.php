    @extends('app')
      
      @section('content')
					<h2 class="page-header"><small>担当者登録</small></h2>

					{!! Form::open(array('route' => 'holders/createConfirm')) !!}
					@include('holder.partial.form', $data)
					{!! Form::close() !!}
      @endsection

