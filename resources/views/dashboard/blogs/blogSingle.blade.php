@extends('dashboard.index')

@section('title')
Blogs Single
@endsection   

@section('js')
    <script src="/global_assets/js/plugins/editors/ckeditor/ckeditor.js"></script>
	<script src="/global_assets/js/demo_pages/blog_single.js"></script>
  
    <script>

function myFunction(Classed) {
  var x = document.getElementById(Classed);
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
};


</script>

    @endsection
                    
@section('contents')   
<!-- Detached content -->
<div class="container-detached">
						<div class="content-detached">
	<!-- Post -->
    <div class="panel">
								<div class="panel-body">
									<div class="content-group-lg">
										<div class="content-group text-center">
											<a href="" class="display-inline-block">
												<img src="{{asset('admindashboard/picture/blogs/'.$blogsSingle->	blog_imgUrl)}}" class="img-responsive" alt="">
											</a>
										</div>

										<h3 class="text-semibold mb-5">
											<a href="" class="text-default">{{$blogsSingle->blog_name}}</a>
										</h3>

										<ul class="list-inline list-inline-separate text-muted content-group">
											
											<li>{{$blogsSingle->created_at}}</li>
											<li><a href="#" class="text-muted">{{count($blogsSingle->Comments)}}  comments</a></li>
                                            <li><a href="#" class="text-muted">{{$blogsSingle->count_views}} Views</a></li>
										</ul>

                                   
							</div>
                       
                            <div class="panel panel-default">
	                             <div class="panel-heading">
                                    <div class="panel-body">
								              {{--
											{!! html_entity_decode($blogsSingle->blog_body_editor) !!}
											--}}
								 {!! $blogsSingle->blog_body_editor !!}

										
                               

                                
								 

                                     </div>   
                                 </div> 
                           </div>  


								</div>
							</div>
							<!-- /post -->


                            	<!-- Comments -->
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title text-semiold">Discussion</h6>
									<div class="heading-elements">
										<ul class="list-inline list-inline-separate heading-text text-muted">
											<li>{{count($blogsSingle->Comments)}} comments</li>
											
										</ul>
				                	</div>
								</div>
								@foreach($blogsSingle->Comments as $item)
								<div class="panel-body">
									<ul class="media-list stack-media-on-mobile">
										<li class="media">
											<div class="media-left">
												<a href="#"><img src="{{asset('Users/Picture/'.$item->user->avatar)}}" class="img-circle img-sm" alt=""></a>
												
											</div>

											<div class="media-body">
												<div class="media-heading">
													<a href="#" class="text-semibold">{{$item->user->name}}</a>
													<span class="media-annotation dotted">{{$item->created_at->diffForHumans()}}</span>
												</div>

												<p>{{$item->message}}</p>

												<ul class="list-inline list-inline-separate text-size-small">
												@if(auth()->check() && auth()->user()->id ==$item->user->id)
													<li><a    onclick="myFunction('panel-body-{{$item->id}}')">Edit</a></li>
													<li>
													{!! Form::open(['route' => ['admin.comments.delete',$item->id], 'method' => 'delete' ,'name' => 'my-form-'.$item->id]) !!}
														<a onclick="document.forms['my-form-{{$item->id}}'].submit();return false;">delete</a>
														{!! Form::close() !!}
													</li>
												@endif
									<div class="panel-body" id ="panel-body-{{$item->id}}" style="display:none">
									
								{!! Form::open(['route' => ['admin.comments.edit',['commentId' => $item->id , 'blogid' => $blogsSingle->id] ], 'method' => 'PUT']) !!}

									<div class="content-group" >
								    
									  {!! Form::textarea('message' , null  ,['class' => 'form-control' , 'rows' => '4' , 'cols'=> '4']) !!}
									  </div>
									<div class="text-right">
										<button type="submit" class="btn bg-blue"><i class="icon-plus22"></i> Add comment</button>
									</div>
									
									
											  </div>
								{!! Form::close() !!}
												</ul>
											</div>
										</li>

									</ul>
								</div>
								@endforeach
								<hr class="no-margin">

								<div class="panel-body">
									<h6 class="no-margin-top content-group">Add comment</h6>
							
								{!! Form::open(['route' => ['admin.comments.store',$blogsSingle->id ], 'method' => 'POST']) !!}

									<div class="content-group">
										{{-- 
											<textarea name="message" rows="5" cols="5" class="form-control" placeholder="Textarea">Text</textarea>

											--}}
									  {!! Form::textarea('message' , null  ,['class' => 'form-control' , 'rows' => '4' , 'cols'=> '4']) !!}

									</div>
									
									<div class="text-right">
										<button type="submit" class="btn bg-blue"><i class="icon-plus22"></i> Add comment</button>
									</div>
									{!! Form::close() !!}
								
								</div>
							</div>
							<!-- /comments -->

                         </div>
					</div>
					<!-- /detached content -->
 
@endsection  