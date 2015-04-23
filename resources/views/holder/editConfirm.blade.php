    @extends('app')
      
      @section('content')
					<h2 class="page-header"><small>プロジェクト編集</small></h2>
					{!! Form::open(array('route' => array('holders/editRegist'))) !!}
					@include('holder.partial.confirm', $data)
					{!! Form::submit('登録', ['class' => 'btn btn-primary']) !!}
					{!! HTML::linkRoute('holders/editInput', '修正する', [$data['holder_id']], ['title'=>'修正する', 'class' => 'btn btn-warning']) !!}
					{!! Form::close() !!}
      @endsection

