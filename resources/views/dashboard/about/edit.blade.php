@extends('dashboard.index')

@section('title')
about Create
@endsection

@section('js')
  
	<!-- Theme JS files -->
	

	<!-- editors JS files -->
    <script src="/global_assets/js/plugins/editors/ckeditor/ckeditor.js"></script>
	<script src="/global_assets/js/plugins/forms/selects/select2.min.js"></script>

	<script src="/global_assets/js/demo_pages/editor_ckeditor_rtl.js"></script>
	<!-- /editors JS files -->


<!-- Theme JS files -->

 
	
  

@endsection

@section('contents')
<!-- Form horizontal -->
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">انشاء تعريف </h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
                <li><a data-action="reload"></a></li>
                <li><a data-action="close"></a></li>
            </ul>
        </div>
    </div>

    <div class="panel-body">

      
       
       {!! Form::model($about,['route' => ['admin.abouts.update', $about->id ], 'method' => 'put' , 'class'=> 'form-horizontal' ,  'enctype' => 'multipart/form-data']) !!}
       <div class="content-group">
            
               
          {!! Form::textarea('details' , null  ,['class' => 'form-control' ,'id'=> 'editor-full' , 'rows' => '4' , 'cols'=> '4']) !!}
        
			 </div>
            <div class="text-right">
                <button type="submit" class="btn btn-primary">Submit <i class="icon-arrow-left13 position-right"></i></button>
            </div>
 
        {!! Form::close() !!}
    </div>
</div>
<!-- /form horizontal -->

								





@endsection