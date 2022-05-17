@extends('users.index')
    
@section('title')
    problem update
@endsection

@section('js')

<!-- Theme JS files -->
<script src="/global_assets/js/plugins/uploaders/fileinput/plugins/purify.min.js"></script>
<script src="/global_assets/js/plugins/uploaders/fileinput/plugins/sortable.min.js"></script>
<script src="/global_assets/js/plugins/uploaders/fileinput/fileinput.min.js"></script>
	
<script src="/global_assets/js/demo_pages/uploader_bootstrap.js"></script>
<!-- /theme JS files -->
<script >
function onlyOne(checkbox) {
    var checkboxes = document.getElementsByName('check')
    checkboxes.forEach((item) => {
        if (item !== checkbox) item.checked = false
    });
}
</script>

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


						
                    {!! Form::model($problemEdit,['route' => ['user.problems.update' ,['problemId' => $problemEdit->id , 'key'=>  $problemEdit->key_problem ]], 'method' => 'PUT' , 'class'=> 'form-horizontal' ,  'enctype' => 'multipart/form-data']) !!}

						@include('users.RegisterProblem.input')

                        <legend class="text-bold">عرض المرفقات التي قمت برفعها وتعديلها  </legend>

                        <div class="row">
            @php
                    $nameArray = ['video' => 'فيديو' , 'image' => 'صورة' , 'application' => 'pdf'] ;
            @endphp

            @foreach($problemEdit->attachments as $file)
            <div class="col-md-3 col-sm-6">
                <div class="thumbnail">
                    <div class="thumb">
                        @if(substr($file->attachment_Url ,0 , strpos($file->attachment_Url,'/')) == "video")
                        <video style="width:300px;height:300px" controls poster="/images/w3html5.gif">
                             <source  src="{{asset('Users/Picture/problems/'.$file->attachment_Url)}}" type="video/mp4">
  
                                Your browser does not support the video tag.
                           </video>                
                        
                    </div>
                    @elseif(substr($file->attachment_Url ,0 , strpos($file->attachment_Url,'/')) == "image")
                    <img style="width:300px;height:300px" src="{{asset('Users/Picture/problems/'.$file->attachment_Url)}}" alt="">
                   
                        <div class="caption-overflow">
                            <span>
                                <a href="{{asset('Users/Picture/problems/'.$file->attachment_Url)}}" class="btn bg-success-300 btn-xs btn-icon"><i class="icon-zoomin3"></i></a>
                               
                            </span>
                        </div>
                    </div>

                    @elseif(substr($file->attachment_Url ,0 , strpos($file->attachment_Url,'/')) == "application")
  
                    <iframe src="https://drive.google.com/file/d/{{$file->google_file}}/preview" width="300" height="200" allow="autoplay"></iframe>
                   
                    <br>
              <a href="{{asset('Users/Picture/problems/'.$file->attachment_Url)}}" target="_blank" rel="noopener noreferrer">اضغط لتحميل الملف للقراءه</a>

                    </div>
                    @endif

                    <div class="caption text-center">
                        
                     نوع الملف : {{$nameArray[ substr($file->attachment_Url ,0 , strpos($file->attachment_Url,'/')) ]}} 
                          <br>
                         <label>   
                            
                                <input type="checkbox" value="{{$file->id}}" name="check" onclick="onlyOne(this)" />

                                            {{$file->file_name}}
                        </label>
                  
                        <br>
                        <label> 
                        {!! link_to_route('user.problems.attachment.delete', 'حذف هذا المرفق', ['attachmentID'=> $file->id,'keyId' => $problemEdit->key_problem ],['class'=> 'btn btn-primary']); !!}
                        </label>
                        
                    </div>
                </div>
            </div>
            @endforeach

        </div>

        <div class="form-group">
								<label class="col-lg-2 control-label text-semibold">Using data-attributes:</label>
								<div class="col-lg-10">
									<input type="file" name="fileCheck" accept="image/*,video/mp4,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,application/pdf" class="file-input"  data-show-upload="false" data-show-caption="true" data-show-preview="true">
									<span class="help-block">   حدد الملف المراد تبديله مع ملف من جهازك</span>
                                    <span class="help-block">  انواع البيانات : mp4 | 3gp | mov | avi | wmv | jpg | jpeg | png | pdf</span>
								</div>
							</div>

						
							<div class="text-right">
								<button type="submit" class="btn btn-primary">Submit <i class="icon-arrow-left13 position-right"></i></button>
							</div>
							{!! Form::close() !!}

					</div>
				</div>
				<!-- /form horizontal -->
@endsection