@extends('users.index')
    
@section('title')
    Detail Problem
@endsection

@section('js')

<!-- Theme JS files -->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/css?family=Open+Sans|Sansita:800" rel="stylesheet">
<!-- /theme JS files -->

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

<style>

.content {
  text-align: center;
}
.content h1 {
  font-family: 'Sansita', sans-serif;
  letter-spacing: 1px;
  font-size: 50px;
  color: #282828;
  margin-bottom: 10px;
}
.content  i {
  color: #FFC107;
}
.content span {
  position: relative;
  display: inline-block;
}
.content  span:before, .content  span:after {
  position: absolute;
  content: "";
  background-color: #282828;
  width: 40px;
  height: 2px;
  top: 40%;
}
.content  span:before {
  left: -45px;
}
.content  span:after {
  right: -45px;
}
.content p {
  font-family: 'Open Sans', sans-serif;
  font-size: 18px;
  letter-spacing: 1px;
}
.wrapper {
  
  display: inline-block;
  border: none;
 
  font-size: 14px;
  position: absolute;
  
  left: 50%;
  transform: translate(-50%, -50%);
}

.wrapper input {
   
  border: 0;
  width: 1px;
  height: 1px;
  overflow: hidden;
  position: absolute !important;
  clip: rect(1px 1px 1px 1px);
  clip: rect(1px, 1px, 1px, 1px);
  opacity: 0;
}

.wrapper label {
  position: relative;
  float: right;
  color: #C8C8C8;
}

.wrapper label:before {
  margin: 5px;
  content: "\f005";
  font-family: FontAwesome;
  display: inline-block;
  font-size: 1.5em;
  color: #ccc;
  -webkit-user-select: none;
  -moz-user-select: none;
  user-select: none;
}

.wrapper input:checked ~ label:before {
  color: #FFC107;
}

.wrapper label:hover ~ label:before {
  color: #ffdb70;
}

.wrapper label:hover:before {
  color: #FFC107;
}

</style>

<style type="text/css">

.main-section{
    background-color:#fff;
    padding:30px 15px;
}
.rating-part-left h1{
    font-size:75px;
    margin:0px;
    color: #528ec1;
}
.rating-part-left i{
    font-size:22px;
    padding:2px;
    color:#FDC91B;
}
.rating-part-left p{
    font-size:18px;
    color:#504F55;
}
.progress{
    background: #f1f1f1;
    box-shadow: none;
    border-radius: 0px;
    margin:7px 0px;
}
.progress .progress-bar{
    background: #528ec1;
}
.rating-part-right i,.product-rating-panel-right i{
    font-size: 20px;
    padding:4px 0px;
    color:#FDC91B;
}
.rating-part-right span{
    color:#528ec1;
    font-size:17px;
    padding-left: 5px;
}
.review-section{
    padding: 0px 15px;
}
.product-rating-panel-left img{
    height:75px;
    width:75px;
    border-radius: 50%;
    border:2px solid #528ec1;
}
.product-rating-panel-left p{
    margin:0px;
    font-size:17px;
    color:#B3B5B4;
}
.product-rating-panel-left span{
    font-size:19px;
}
.product-rating-panel-left small{
    color:#B3B5B4;
}
.product-rating-panel-right p{
    font-size: 18px;
    color:#919191;
}

    </style>

@endsection
    
@section('contents')

@include('globalPages.message')
@if(auth()->user()->id == $detail->user_id && $detail->tap_order_status == 4 && empty($detail->StarRating))

<div class="panel panel-flat">
      <div class="content">
        <h1>5 Stars Rate</h1>
       <span><i class="fa fa-star"></i></span>
        <p>Pure CSS!</p>
     </div>
   <br>
   {!! Form::open(['route' => ['user.star.rating.store',$detail->id ], 'method' => 'POST']) !!}

      <div class="wrapper" dir="ltr" >
        
      
       
        
         <input name="ratingRadio" type="radio" id="st5" value="1.0" />
         <label for="st5">5</label>

         <input name="ratingRadio" type="radio" id="st4" value="0.8" />
         <label for="st4">4</label>

         <input name="ratingRadio" type="radio" id="st3" value="0.6" />
         <label for="st3">3</label>

         <input name="ratingRadio" type="radio" id="st2" value="0.4" />
         <label for="st2">2</label>

         <input name="ratingRadio" type="radio" id="st1" value="0.2" />
         <label for="st1">1</label>
      </div>


             <div class="panel-body">
						<h6 class="no-margin-top content-group">اضف تعليق لتقيمك</h6>

                              <div class="content-group">
   
                                  {!! Form::textarea('addcomment' , null  ,['class' => 'form-control' , 'rows' => '4' , 'cols'=> '4']) !!}

                                </div>

                           <div class="text-right">
                               <button type="submit" class="btn bg-blue"><i class="icon-plus22"></i> اضف تقيم</button>
                           </div>
                      
						
						
			</div>
   {!! Form::close() !!}

</div>
@endif

@if(!empty($detail->StarRating))

<div class="panel panel-flat">
    <div class="row review-section">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        
                        <h3>Reviews</h3>
                        <hr>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="row">
                            <div class="col-md-4 col-md-4 col-xs-4 product-rating-panel-left">
                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <img src="{{asset('Users/Picture/'.$detail->user->avatar)}}">
                                    </div>  
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <p>{{$detail->StarRating->created_at->diffForHumans()}}</p>
                                        <span>{{$detail->user->name}}</span><br>
                                        <small>Review Info</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8 col-sm-8 col-xs-8 product-rating-panel-right">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                    @for($i = 0 ; $i < 5 ; $i++)
                                        @if( $i < $detail->StarRating->star)
                                        <i class="fa fa-star" aria-hidden="true"></i>

                                        @else
                                        <i class="fa fa-star-o" aria-hidden="true"></i>

                                        @endif
                                       
                                        
                                       
                                     @endfor
                                     
                                     <strong style="font-size:21px"> &nbsp; &nbsp; {{$detail->StarRating->raing_string}}  </strong>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <p>{{$detail->StarRating->comment}}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
     </div>
 </div>
@endif
<!-- Task overview -->
<div class="panel panel-flat">
    <div class="panel-heading mt-5">
        <h5 class="panel-title">#23: Support tickets list doesn't support commas</h5>
        <div class="heading-elements">
            <a href="#" class="btn bg-teal-400 btn-sm btn-labeled btn-labeled-right heading-btn">Check in <b><i class="icon-alarm-check"></i></b></a>
        </div>
    </div>


 

    <div class="panel-body">
       
        <div class="row container-fluid">
        
        <h6 class="text-semibold">جدول عرض استعراض الطلب</h6>
        <div class="content-group">
                    <dl>
                        

                        <dt class="text-size-small text-primary text-uppercase"> <h1>تفاصيل الخلل</h1></dt>
                        <dd class="text-size-small text-primary text-uppercase">{{$detail->problem_details}}</dd>
                    </dl>
                </div>
            </div>
            @php
                                $status = array(
                                    '1'=> "label label-default",
                                    '2'=>"label label-success",
                                    '3' => "label label-danger",
                                    '4'=>"label label-info",
                                     );
                                @endphp

        <div class="table-responsive content-group">
            <table class="table table-framed">
                <thead>
                    <tr>
                        <th class="col-xs-2">رقم الخلل</th>
                        <th class="col-xs-3"> اسم الخلل</th>
                        
                        <th class="col-xs-2">تاريخ الخلل</th>
                        <th class="col-xs-2">المدينه</th>
                        <th class="col-xs-2">سبب الخلل</th>

                        @isset($detail->tool_defect)
                        <th class="col-xs-2">اداة الخلل</th>
                        @endisset

                        @isset($detail->who_cause_of_defect)
                        <th class="col-xs-2">المتسبب في الخلل</th>
                        @endisset
                        
                        <th class="col-xs-2">حالة الخلل</th>
                      
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$detail->key_problem}}</td>
                        <td><span class="text-semibold">{{$detail->problem_name}}</span></td>
                        <td>
                            <div class="input-group input-group-transparent">
                                <div class="input-group-addon"><i class="icon-calendar22 position-left"></i></div>
                                <span class="text-semibold">{{$detail->created_at}}</span>
                            </div>
                        </td>
                        <td><span class="text-semibold">{{$detail->city->city_name}}</span></td>
                        <td><span class="text-semibold">{{$detail->SauseOfDefect->sause_of_defect_name}}</span></td>
                         @isset($detail->tool_defect)
                        <td><span class="text-semibold">{{$detail->tool_defect}}</span></td>
                        @endisset

                        @isset($detail->who_cause_of_defect)
                        <td><span class="text-semibold">{{$detail->who_cause_of_defect}}</span></td>
                        @endisset
                        <td>
                           
                        
                            <span class="{{$status[$detail->tap_order_status]}}">{{$detail->order_status}}</span>

                        </td>
                      
                    </tr>
                   
                </tbody>
            </table>
        </div>

        <h6 class="text-semibold">Uploaded files</h6>
        <p>A much goodness between destructive that save stupid firefly destructively dog goldfinch continually alas pinched for outside flailed inescapably hey brought rid crud and awakened sobbed extraordinarily wherever deer before tenable yet into dalmatian opposite save close ahead next independent mindful but far.</p>

        <div class="row">
            @php
                    $nameArray = ['video' => 'فيديو' , 'image' => 'صورة' , 'application' => 'pdf'] ;
            @endphp

            @foreach($detail->attachments as $file)
            <div class="col-md-3 col-sm-6">
                <div class="thumbnail">
                    <div class="thumb">
                        @if(substr($file->attachment_Url ,0 , strpos($file->attachment_Url,'/')) == "video")
                        <video width="300" height="200" controls poster="/images/w3html5.gif">
                             <source  src="{{asset('Users/Picture/problems/'.$file->attachment_Url)}}" type="video/mp4">
  
                                Your browser does not support the video tag.
                           </video>                
                        
                    </div>
                    @elseif(substr($file->attachment_Url ,0 , strpos($file->attachment_Url,'/')) == "image")
                    <img src="{{asset('Users/Picture/problems/'.$file->attachment_Url)}}" alt="">
                   
                        <div class="caption-overflow">
                            <span>
                                <a href="{{asset('Users/Picture/problems/'.$file->attachment_Url)}}" class="btn bg-success-300 btn-xs btn-icon"><i class="icon-zoomin3"></i></a>
                               
                            </span>
                        </div>
                    </div>

                    @elseif(substr($file->attachment_Url ,0 , strpos($file->attachment_Url,'/')) == "application")
  
            
              <iframe src="https://drive.google.com/file/d/{{$file->google_file}}/preview" width="300" height="200" allow="autoplay"></iframe>

                    </div>
                    @endif

                    <div class="caption text-center">
                        
                     نوع الملف : {{$nameArray[ substr($file->attachment_Url ,0 , strpos($file->attachment_Url,'/')) ]}} 
                    </div>
                </div>
            </div>
            @endforeach




          
        </div>
    </div>

    
</div>
<!-- /task overview -->


<!-- Comments -->
<div class="panel panel-flat">
					<div class="panel-heading">
						<h6 class="panel-title text-semiold">Discussion<a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
						<div class="heading-elements">
							<ul class="list-inline list-inline-separate heading-text text-muted">
								<li>{{count($detail->ProblemCommnets)}} comments</li>
								
							</ul>
	                	</div>
					</div>

					<div class="panel-body">
						<ul class="media-list stack-media-on-mobile">
						
                            

                           @foreach($detail->ProblemCommnets as $comment)  
					

							<li class="media">
								<div class="media-left">
									<a href="#"><img src="{{asset('Users/Picture/'.$comment->user->avatar)}}" class="img-circle img-sm" alt=""></a>
								</div>

								<div class="media-body">
									<div class="media-heading">
										<a href="#" class="text-semibold">{{$comment->user->name}}</a>
										<span class="media-annotation dotted">{{$comment->created_at->diffForHumans()}}</span>
									</div>

									<p>{{$comment->commnets_body}}</p>

									<ul class="list-inline list-inline-separate text-size-small">
										<li>{{count($comment->ReplyCommnets)}} </li>
										<li><a    onclick="myFunction('panel-body-reply-master-{{$comment->id}}')">Reply</a></li>
                                        @if(auth()->user()->id == $comment->user_id)
                                           <li><a    onclick="myFunction('panel-body-edit-master-{{$comment->id}}')">Edit</a></li>
                                           <li><a href="{{route('user.problem.comment.delete.master',$comment->id)}}">delete</a></li>

                                           @endif
                                                {!! Form::open(['route'=> ['user.problem.comment.edit', $comment->id], 'id'=> 'panel-body-edit-master-'.$comment->id  ,'style'=> "display:none" , 'method' => 'PUT']) !!}
    
                                                    {!! Form::textarea('edit_master' , null  ,['class' => 'form-control' , 'rows' => '4' , 'cols'=> '4']) !!}

                                                    <div class="text-right">
                                                         <button type="submit" class="btn bg-blue"><i class="icon-plus22"></i>edit</button>
                                                   </div>
                                               {!! Form::close() !!}


                                                       {!! Form::open(['route' => ['user.problem.comment.reply' ,['problemId'=>$detail->id, 'commentId' => $comment->id]], 'id'=> 'panel-body-reply-master-'.$comment->id   ,'style'=> "display:none" , 'method' => 'POST']) !!}
        
                                           
                                            
                                                          {!! Form::textarea('commentReply' , null  ,['class' => 'form-control' , 'rows' => '4' , 'cols'=> '4']) !!}
                                                              <br>
                                                            <div class="text-right">
                                                                <button type="submit" class="btn bg-blue"><i class="icon-plus22"></i> Comment</button>
                                                           </div>



                                                      {!! Form::close() !!}
									</ul>
                                 @if(!is_null($comment->ReplyCommnets))	
                                    @foreach($comment->ReplyCommnets as $reply)	
                                            
									<div class="media">
										<div class="media-left">
											<a ><img src="{{asset('Users/Picture/'.$reply->user->avatar)}}" class="img-circle img-sm" alt=""></a>
										</div>

										<div class="media-body">
											<div class="media-heading">
												<a href="#" class="text-semibold">{{$reply->user->name}}</a>
												<span class="media-annotation dotted">
                                                    {{$reply->created_at->diffForHumans()}}
                                                </span>
											</div>

											<p>{{$reply->commnets_body}}</p>

											<ul class="list-inline list-inline-separate text-size-small">
                                            @if(auth()->user()->id == $reply->user_id)
                                            
												<li><a href="{{route('user.problem.comment.delete.reply',$reply->id)}}">delete</a></li>
												
                                                <li><a    onclick="myFunction('panel-body-edit-reply-{{$reply->id}}')">Edit</a></li>
                                             @endif

                                                    {!! Form::open(['route'=> ['user.problem.comment.edit', $reply->id], 'id'=> 'panel-body-edit-reply-'.$reply->id  ,'style'=> "display:none" , 'method' => 'PUT']) !!}
    
                                                       {!! Form::textarea('reply_edit' , null  ,['class' => 'form-control' , 'rows' => '4' , 'cols'=> '4']) !!}

                                                            <div class="text-right">
                                                               <button type="submit" class="btn bg-blue"><i class="icon-plus22"></i> edit</button>
                                                            </div>
                                                   {!! Form::close() !!}
											</ul>

                                               

											
										</div>
									</div>
                                    @endforeach
                                 @endif
								</div>
							</li>
                            @endforeach
							
						</ul>
					</div>

					<hr class="no-margin">

					<div class="panel-body">
						<h6 class="no-margin-top content-group">Add comment</h6>
                        {!! Form::open(['route' => ['user.problem.comment.master',$detail->id ], 'method' => 'POST']) !!}

                              <div class="content-group">
   
                                  {!! Form::textarea('addcomment' , null  ,['class' => 'form-control' , 'rows' => '4' , 'cols'=> '4']) !!}

                                </div>

                           <div class="text-right">
                               <button type="submit" class="btn bg-blue"><i class="icon-plus22"></i> Add comment</button>
                           </div>
                      {!! Form::close() !!}
						
						
					</div>
				</div>
<!-- /comments -->




@endsection