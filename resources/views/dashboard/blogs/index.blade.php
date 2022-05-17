@extends('dashboard.index')

@section('title')
Blogs index
@endsection               
                    
@section('contents')      

    @if ($message = Session::get('commpleted'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>

        </div>
        @endif

        @if ($message = Session::get('problem'))
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>

        </div>
        @endif
                    <!-- Post grid -->
				
                    <div class="row">
					@foreach( $blogsList as $item)
                        <div class="col-md-4">
					
							<div class="panel panel-flat">
							
								<div class="panel-body">
									<div class="thumb content-group">
										<img src="{{asset('admindashboard/picture/blogs/'.$item->blog_imgUrl)}}" alt="" class="img-responsive">
                                       
										<div class="caption-overflow">
											<span>
												<a href="{{route('admin.blogs.blogSingle',$item->id)}}" class="btn btn-flat border-white text-white btn-rounded btn-icon"><i class="icon-arrow-right8"></i></a>
											</span>
										</div>
									</div>

									<h5 class="text-semibold mb-5">
										<a href="#" class="text-default">{{$item->blog_name}}</a>
									</h5>

									<ul class="list-inline list-inline-separate text-muted content-group">
									
										<li>{{$item->created_at}}</li>
									</ul>

								</div>

								<div class="panel-footer panel-footer-condensed">

									<div class="heading-elements not-collapsible">
										<ul class="list-inline list-inline-separate heading-text text-muted">
                                            <li><a href="{{route('admin.blogs.blogSingle',$item->id)}}" class="text-muted">{{$item->count_comment}} comments</a></li>
                                            <li><a href="{{route('admin.blogs.blogSingle',$item->id)}}" class="text-muted">{{$item->count_views}} Views</a></li>
										</ul>
										<a href="{{route('admin.blogs.blogDelete',$item->id)}}" class="heading-text pull-right">delete <i class="icon-arrow-left13 position-right"></i></a>

										<a href="{{route('admin.blogs.edit',$item->id)}}" class="heading-text pull-right">edit <i class="icon-arrow-left13 position-right"></i></a>
										
										<br>

										<a href="{{route('admin.blogs.blogSingle',$item->id)}}" class="heading-text pull-right">Read more <i class="icon-arrow-left13 position-right"></i></a>
									</div>
								</div>
								
							</div>
							
						</div>
						@endforeach
						
              

					
				</div>
			<!-- /post grid -->

                      	<!-- Pagination -->
				

				
                                {!! $blogsList-> links('dashboard.pagination') !!}
                               
					<!-- /pagination -->
@endsection    