@extends('users.index')
    
@section('title')
    problem create
@endsection

@section('js')
<!-- Theme JS files -->
	<script src="/global_assets/js/plugins/uploaders/fileinput/plugins/purify.min.js"></script>
	<script src="/global_assets/js/plugins/uploaders/fileinput/plugins/sortable.min.js"></script>
	<script src="/global_assets/js/plugins/uploaders/fileinput/fileinput.min.js"></script>
	
	<script src="/global_assets/js/demo_pages/uploader_bootstrap.js"></script>
<!-- /theme JS files -->
@endsection
    
@section('contents')
<!-- Form horizontal -->
<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Basic form inputs</h5>
						<div class="heading-elements">
							<ul class="icons-list">
		                		<li><a data-action="collapse"></a></li>
		                		<li><a data-action="reload"></a></li>
		                		<li><a data-action="close"></a></li>
		                	</ul>
	                	</div>
					</div>

					<div class="panel-body">
					@include('globalPages.ERRORS')


                    @include('globalPages.message')


						
						{!! Form::open(['route' => 'user.problems.store', 'method' => 'POST' , 'class'=> 'form-horizontal' ,  'enctype' => 'multipart/form-data']) !!}

						@include('users.RegisterProblem.input')

						
							<div class="text-right">
								<button type="submit" class="btn btn-primary">Submit <i class="icon-arrow-left13 position-right"></i></button>
							</div>
							{!! Form::close() !!}

					</div>
				</div>
				<!-- /form horizontal -->

@endsection