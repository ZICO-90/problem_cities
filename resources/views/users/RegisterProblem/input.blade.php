<fieldset class="content-group">
								<legend class="text-bold">Basic inputs</legend>

								<div class="form-group">
									<label class="control-label col-lg-2">problem_name</label>
									<div class="col-lg-10">
										
                                        {!! Form::text('problem_name' , null  ,['class' => 'form-control' ]) !!}
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-lg-2">tool_defect</label>
									<div class="col-lg-10">
									
                                        {!! Form::text('tool_defect' , null  ,['class' => 'form-control' ]) !!}

									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-lg-2">who_cause_of_defect</label>
									<div class="col-lg-10">
										
                                        {!! Form::text('who_cause_of_defect' , null  ,['class' => 'form-control' ]) !!}

									</div>
								</div>


								<div class="form-group">
									<label class="control-label col-lg-2">city_id</label>
									<div class="col-lg-10">
										

                                        {!!   Form::select('city_id',  isset($CitieList) ? ['' => 'select city'] + $CitieList   : ['' => 'list is empty']

                                         , null , ['class' => 'form-control' ],[ '' => [ "disabled" => true ] ] ); !!}
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-lg-2">side_defect_id</label>
									<div class="col-lg-10">
									
                                        
                                        {!! Form::select('side_defect_id',  isset($SauseList) ?  ['' => 'select side defect'] + $SideList : ['' => 'list is empty']

                                         ,null , ['class' => 'form-control'  ] ,[ '' => [ "disabled" => true ] ] ) !!}
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-lg-2">cause_of_defect_id</label>
									<div class="col-lg-10">
										

                                        {!! Form::select('cause_of_defect_id',  isset($SideList) ? ['' => 'select cause of defect'] + $SauseList: ['' => 'list is empty']

                                        ,  null , ['class' => 'form-control' ] , [ '' => [ "disabled" => true ] ] ) !!}
									</div>
								</div>
					

			

								<div class="form-group">
									<label class="control-label col-lg-2">Textarea</label>
									<div class="col-lg-10">
                                        {!! Form::textarea('problem_details' , null  ,['class' => 'form-control' ,'placeholder'=> 'Default textarea' , 'rows' => '4' , 'cols'=> '4']) !!}

									</div>
								</div>

								
							</fieldset>

							<fieldset class="content-group">
								<legend class="text-bold"> @empty($problemEdit)  سحب المفرقات من الجهاز اجباري يمكنك سحب اكثر من مفرق @endempty @isset($problemEdit)  <span style="color:red;">يمكن اضافة  مرفقات اخري</span> @endisset  </legend>
								

                                    <div class="form-group">
								<label class="col-lg-2 control-label text-semibold">Using data-attributes:</label>
								<div class="col-lg-10">
									<input type="file" name="files[]" accept="image/*,video/mp4,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,application/pdf" class="file-input" multiple="multiple" data-show-upload="false" data-show-caption="true" data-show-preview="true">
									<span class="help-block">   ملحوظه لو هتعرف اكتر من ملف جمعهم في فولدر واحد ثم حدد الملفات </span>
                                    <span class="help-block">  انواع البيانات : mp4 | 3gp | mov | avi | wmv | jpg | jpeg | png | pdf</span>
								</div>
							</div>








                          </fieldset>                   
</fieldset>