@extends('users.index')
    
@section('title')
    my order 
@endsection

@section('js')
	<!-- Theme JS files -->
	<script src="/global_assets/js/plugins/tables/footable/footable.min.js"></script>

	
	<script src="/global_assets/js/demo_pages/table_responsive.js"></script>
	<!-- /theme JS files -->
@endsection
@section('contents')

<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Bordered striped<a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
						<div class="heading-elements">
							<ul class="icons-list">
		                		<li><a data-action="collapse"></a></li>
		                		<li><a data-action="reload"></a></li>
		                		<li><a data-action="close"></a></li>
		                	</ul>
	                	</div>
					</div>

					<div class="panel-body">
                        <h2>
                        اهلا وسهلا بك
                         :  
                         {{$MyOrder->name}}
                         في قائمه طلباتك 
                        </h2>
                    </div>

					<div class="table-responsive">
						<table class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>رقم الخلل</th>
									<th>اسم الخلل</th>
									<th>تاريخ الخلل</th>
                                    <th>جهة الخلل</th>
									<th>المدينه</th>
                                    <th>سبب الخلل</th>
                                    <th>اداة الخلل	</th>
                                    <th>المتسبب في الخلل</th>
                                    <th>عدد المرفقات</th>
                                    <th>حاله الخلل</th>
                                    <th>العمليات</th>
								</tr>
							</thead>
							<tbody>
                                @php
                                $status = array(
                                    '1'=> "label label-default",
                                    '2'=>"label label-success",
                                    '3' => "label label-danger",
                                    '4'=>"label label-info",
                                     );
                                @endphp
                                @foreach($MyOrder->Problems as $item)
								<tr>
									<td>{{$item->key_problem}}</td>
									<td>{{$item->problem_name}}</td>
									<td>{{$item->created_at->isoFormat('YYYY-MM-DD')}}</td>
                                    <td>{{$item->SideDefect->side_defect_name}}</td>
									<td>{{$item->city->city_name}}</td>
                                    <td>{{$item->SauseOfDefect->sause_of_defect_name}}</td>
                                    <td>
                                        @isset($item->tool_defect)
                                        {{$item->tool_defect}}
                                        @endisset

                                        @empty($item->tool_defect)
                                         -----
                                        @endempty
                                    </td>
                                    <td>
                                    @isset($item->who_cause_of_defect)
                                       {{$item->who_cause_of_defect}}

                                        @endisset

                                        @empty($item->who_cause_of_defect)
                                        -----
                                        @endempty
                                        
                                    
                                    </td>
                                    <td>{{count($item->attachments)}}</td>
                                    <td>
                                      
                                        <span class="{{$status[$item->tap_order_status]}}">{{$item->order_status}}</span>
                                        
                                    </td>

                                    <td>
                                    <ul class="icons-list">
											<li><a href="{{route('user.problems.detail',$item->id)}}">عرض</a></li>
											<li><a href="{{route('user.problems.edit',$item->id)}}">تعديل</a></li>
											<li><a href="#"> حذف</a></li>
										</ul>
                                    </td>
                                  

                                   
								   </tr>
                                   
                                    
                                 
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
@endsection