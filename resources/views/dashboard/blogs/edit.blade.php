@extends('dashboard.index')

@section('title')
Blogs Edit
@endsection

@section('js')
  
	<!-- Theme JS files -->
	<script src="/global_assets/js/plugins/forms/styling/uniform.min.js"></script>
	<script src="/global_assets/js/demo_pages/form_inputs.js"></script>


<!--------------------------------------------------------------------->
	<!-- editors JS files -->
    <script src="/global_assets/js/plugins/editors/ckeditor/ckeditor.js"></script>
	<script src="/global_assets/js/plugins/forms/selects/select2.min.js"></script>

	<script src="/global_assets/js/demo_pages/editor_ckeditor_rtl.js"></script>
	<!-- /editors JS files -->
<!--------------------------------------------------------------------->

<!--input file change image -->
    <script>
    function ChooseFile()
    {

        // Change Images in Choose File
        var output = document.getElementById('imges');

        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function () {
            URL.revokeObjectURL(output.src) // free memory
        };

    };
  </script>
<!-- /input file change image -->

<!--------------------------------------------------------------------->

    <!-- Theme JS files -->

 
	
    <!-- editor_ckeditor.html >  Search  the path folder  -->

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

       {!! Form::model($blogeEdit,['route' => ['admin.blogs.update' , $blogeEdit->id ], 'method' => 'PATCH' , 'class'=> 'form-horizontal' ,  'enctype' => 'multipart/form-data']) !!}
            @include('dashboard.blogs.input')
            <div class="text-right">
                <button type="submit" class="btn btn-primary">Submit <i class="icon-arrow-left13 position-right"></i></button>
            </div>
 
        {!! Form::close() !!}
    </div>
</div>
<!-- /form horizontal -->

								





@endsection