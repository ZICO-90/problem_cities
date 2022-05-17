    
@extends('dashboard.index')

@section('title')
about index
@endsection

@section('contents')

@include('globalPages.message')

@foreach($about as $item)
<fieldset>
    <div class="panel panel-default">
	                             <div class="panel-heading">
                                    <div class="panel-body">
								              {{--
											{!! html_entity_decode($blogsSingle->blog_body_editor) !!}
											--}}
								 {!! $item->details !!}
                                     </div>   
                                 </div> 
                                 <br>
                                 <div class="text-center content-group-lg pt-20">
                                       <ul class="list-inline list-inline-separate heading-text text-muted">
                                            <li><a href="{{route('admin.abouts.delete',$item->id)}}" class="btn btn-primary"> delete</a></li>
                                            <li><a href="{{route('admin.abouts.edit',$item->id)}}" class="btn btn-primary"> edit</a></li>
                                            <li><a href="{{route('admin.abouts.active',['id' => $item->id ,'bool'=>$item->status] )}}" class="btn btn-primary">{{$item->status == 1 ? 'activated' : 'un active' }}</a></li>
										</ul>
                                 </div>
                           </div>  
                          
 </fieldset>
 @endforeach
@endsection