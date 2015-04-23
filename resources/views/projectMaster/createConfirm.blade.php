    @extends('app')
      
      @section('content')
					<h2 class="page-header"><small>プロジェクト登録</small></h2>
					{!! Form::open(array('route' => 'projectMasters/createRegist')) !!}
						@include('projectMaster.partial.confirm', $data)
					{!! Form::submit('登録', ['class' => 'btn btn-primary']) !!}
					{!! HTML::linkRoute('projectMasters/createInput', '修正する', [], ['title'=>'修正する', 'class' => 'btn btn-warning']) !!}
					{!! Form::close() !!}
      @endsection

