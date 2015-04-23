    @extends('app')
      
      @section('content')
					<h2 class="page-header"><small>プロジェクト編集</small></h2>

					{!! Form::open(array('route' => 'projectMasters/editConfirm')) !!}
						@include('projectMaster.partial.form', $data)
					{!! Form::close() !!}
      @endsection

