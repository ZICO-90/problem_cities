@extends('users.index')
    
@section('title')
   Chat
@endsection

@section('js')
<!-- Theme JS files -->
	<script src="/global_assets/js/demo_pages/chat_layouts.js"></script>
<!-- /theme JS files -->

<meta name="user_id" content="{{ auth()->user()->id ?? ''}}">
<meta name="avatar" content="{{  auth()->user()->avatar ??'' }}">

@endsection
    
@section('contents')
                <!-- Secondary sidebar -->
            <div class="sidebar sidebar-secondary sidebar-default">
				<div class="sidebar-content">

				

					<!-- Online users -->
					<div class="sidebar-category">
						<div class="category-title">
							<span>Online users</span>
							<ul class="icons-list">
								<li><a href="#" data-action="collapse"></a></li>
							</ul>
						</div>

						<div class="category-content no-padding">
							<ul class="media-list media-list-linked" id="media-list">
						
							

							
							</ul>
						</div>
					</div>
					<!-- /online users -->


				

				</div>
			</div>
			<!-- /secondary sidebar -->
            
            
            
            <!-- Basic layout -->
            <div class="panel panel-flat">
						<div class="panel-heading">
							<h6 class="panel-title">Default layout</h6>
							<div class="heading-elements">
								<ul class="icons-list">
			                		<li><a data-action="collapse"></a></li>
			                		<li><a data-action="reload"></a></li>
			                		<li><a data-action="close"></a></li>
			                	</ul>
		                	</div>
						</div>

						<div class="panel-body">
							<ul class="media-list chat-list content-group" id="chat-list-message">
								
                    @foreach($chats as $message)
						@if(auth()->user()->id != $message->user_id)
								<li class="media" id="media-text">
									<div class="media-left">
										<a >
											<img src="{{asset('Users/Picture/'.$message->user->avatar)}}" class="img-circle img-md" alt="">
										</a>
									</div>

									<div class="media-body">
										<div class="media-content">{{$message->message}}</div>
										<span class="media-annotation display-block mt-10">{{$message->created_at->format('H:i')}}<a href="#"><i class="icon-pin-alt position-right text-muted"></i></a></span>
									</div>
								</li>
							@else

								<li class="media reversed" id="media-reversed">
									<div class="media-body">
										<div class="media-content">{{$message->message}}</div>
										<span class="media-annotation display-block mt-10">{{$message->created_at->format('H:i')}}<a href="#"><i class="icon-pin-alt position-right text-muted"></i></a></span>
									</div>

									<div class="media-right">
										<a>
											<img src="{{asset('Users/Picture/'.$message->user->avatar)}}" class="img-circle img-md" alt="">
										</a>
									</div>
								</li>
						@endif
					@endforeach
							</ul>

	                    	<textarea name="enter-message" id ="enter-message-chat" class="form-control content-group" rows="3" cols="1" placeholder="Enter your message..."></textarea>

	                    	

	                    		<div class="col-xs-6 text-right">
		                            <button type="button" id="" class="btn bg-teal-400 btn-labeled btn-labeled-right"><b><i class="icon-circle-left2"></i></b> Send</button>
	                    		</div>
	                    	</div>
						</div>
					</div>
					<!-- /basic layout -->
@endsection