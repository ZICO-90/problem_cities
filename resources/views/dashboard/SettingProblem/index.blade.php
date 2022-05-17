@extends('dashboard.index')

@section('title')
Setting problem
@endsection

@section('js')

<!--------------------------------------------------------------------->

<!-- Theme JS files -->
<script src="/global_assets/js/plugins/tables/footable/footable.min.js"></script>

<script src="/global_assets/js/demo_pages/table_responsive.js"></script>
<!-- /theme JS files -->

<!--------------------------------------------------------------------->

@endsection

@section('contents')

                                @php
                                $status = array(
                                    '1'=> "label label-default",
                                    '2'=>"label label-success",
                                    '3' => "label label-danger",
                                    '4'=>"label label-info",
                                     );
                                @endphp

<div class="panel panel-flat">
						<div class="panel-heading">
							<h5 class="panel-title">جميع بيانات الخلل المسجله<a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
							<div class="heading-elements">
								<ul class="icons-list">
			                		<li><a data-action="collapse"></a></li>
			                		<li><a data-action="reload"></a></li>
			                		<li><a data-action="close"></a></li>
			                	</ul>
		                	</div>
						</div>

						

						<div class="table-responsive">
							<table class="table">
								<thead>
									<tr>
                                    
									<th>اسم الخلل</th>
                                    <th>صاحب الخلل</th>
									<th>تاريخ الخلل</th>
                                    <th>جهة الخلل</th>
									<th>المدينه</th>
                                    <th>سبب الخلل</th>
                                    <th>اداة الخلل	</th>
                                    <th>المتسبب في الخلل</th>
                                    <th>عدد المرفقات</th>
                                    <th>حاله الخلل</th>
                                
										<th class="text-center" style="width: 30px;"><i class="icon-menu-open2"></i></th>
									</tr>
								</thead>
								<tbody>
                                    @foreach($problem as $item)
									<tr>
										<td>{{$item->problem_name}}</td>
										<td>{{$item->user->name}}</td>
										<td>{{$item->created_at->isoFormat('YYYY-MM-DD')}}</td>
										<td>{{$item->SideDefect->side_defect_name}}</td>
									
                                        <th>{{$item->city->city_name}}</th>
                                        <th>{{$item->SauseOfDefect->sause_of_defect_name}}</th>
                                        <th>
                                            
                                        @isset($item->tool_defect)
                                            {{$item->tool_defect}}
                                        @endisset

                                        @empty($item->tool_defect)
                                         -----
                                        @endempty
                                        </th>
                                        <th>

                                     @isset($item->who_cause_of_defect)
                                        {{$item->who_cause_of_defect}}

                                      @endisset

                                        @empty($item->who_cause_of_defect)
                                        -----
                                        @endempty
                                        
                                        </th>
                                        <th>{{count($item->attachments)}}	</th>
                                        <td>

                                        {!! Form::open(['route' => ['admin.setting.problem.status' ,$item->id], 'method' => 'PUT' ]) !!}

                                            <select  onchange="this.form.submit()" name="tap_order_status">
                                            
                                                     <option value="1"   {{ $item->tap_order_status == 1 ? 'disabled selected' : ''}}  >جديد</option>
                                                     <option value="2" {{ $item->tap_order_status == 2 ? 'disabled selected' : ''}} >قيد المراجعه</option>
                                                     <option value="3" {{ $item->tap_order_status == 3 ? 'disabled selected' : ''}} >تمت المعيانه</option>
                                                     <option value="4" {{ $item->tap_order_status == 4 ? 'disabled selected' : ''}} > تم الاغلاق</option>
                                             </select>

                                        {!! Form::close() !!}
                                            
                                        <span class="{{$status[$item->tap_order_status]}}">{{$item->order_status}}</span>
                                    
                                         </td>
                                        
										<td class="text-center">
											<ul class="icons-list">
												<li class="dropdown">
													<a href="#" class="dropdown-toggle" data-toggle="dropdown">
														<i class="icon-menu9"></i>
													</a>

													<ul class="dropdown-menu dropdown-menu-right">
														<li><a href="{{route('user.problems.detail' , $item->id)}}"> مناقشة الخلل</a></li>
													
													</ul>
												</li>
											</ul>
										</td>
									</tr>
                                    @endforeach
								</tbody>
							</table>
						</div>
					</div>


@endsection













