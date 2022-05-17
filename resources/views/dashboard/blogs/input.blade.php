<fieldset class="content-group">
                <legend class="text-bold">Basic inputs</legend>

                <div class="form-group">
                    <label class="control-label col-lg-2">Default text input</label>
                    <div class="col-lg-10">
                       
                        {!! Form::text('blog_name' , null  ,['class' => 'form-control' ]); !!}
                    </div>
                </div>
            </fieldset>

            <fieldset class="content-group">
                <legend class="text-bold">Basic file inputs</legend>

                <div class="form-group">
                    <label class="control-label col-lg-2">Styled file input</label>
                    <div class="col-lg-10">
                        {!! Form::file('File_imgUrl',['onchange' =>'ChooseFile()'  ,'accept'=>'image/*' , 'class' => 'file-styled'])  !!}

                    </div>
                </div>
                <fieldset class="content-group">
                <legend class="text-bold"> {{ isset($blogeEdit) ? "preview images" : "result images" }}</legend>
                @isset($blogeEdit)

                <img id="imges"  style="height: 300px;" src="{{asset('admindashboard/picture/blogs/'.$blogeEdit->blog_imgUrl)}}" >
                @endisset
                @empty($blogeEdit)
                <img id="imges"  style="height: 300px;" >

                @endempty
                
                </fieldset>
            </fieldset>
            <legend class="text-bold">Basic file editor</legend>
             <div class="content-group">
             {{--
             <textarea name="blog_body_editor" id="editor-full" rows="4" cols="4">

             </textarea>
             --}}
               
          {!! Form::textarea('blog_body_editor' , null  ,['class' => 'form-control' ,'id'=> 'editor-full' , 'rows' => '4' , 'cols'=> '4']) !!}
        
			 </div>