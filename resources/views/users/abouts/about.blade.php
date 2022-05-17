    
@extends('users.index')

@section('title')
about index
@endsection

@section('contents')




<fieldset>
    <div class="panel panel-default">
	                             <div class="panel-heading">
                                    <div class="panel-body">
								              {{--
											{!! html_entity_decode($blogsSingle->blog_body_editor) !!}
											--}}
								 {!! $abouts->details !!}
                                     </div>   
                                 </div> 
                                 
                           </div>  
                          
 </fieldset>

@endsection