    @extends('app')
      
      @section('content')
					<h2 class="page-header"><small>プロジェクト登録</small></h2>

					{!! Form::open(array('route' => 'projectMasters/createConfirm')) !!}
						@include('projectMaster.partial.form', $data)
					{!! Form::close() !!}
      @endsection

