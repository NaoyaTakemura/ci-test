    @extends('app')
      
      @section('content')
					<h2 class="page-header"><small>担当者編集</small></h2>
					
					{!! Form::open(array('route' => 'holders/editConfirm')) !!}
					@include('holder.partial.form', $data)
					{!! Form::close() !!}
      @endsection

