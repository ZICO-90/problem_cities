<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="layout_user_id" content="{{ auth()->user()->id ?? ''}}">
    <meta name="date" content="{{  now() }}">
	<title>{{auth()->user()->name}} - @yield('title')</title>
	
	@include('Users.layuots.head')
	@yield('js')

	<script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body>


	@include('Users.layuots.MainNavbar')



	<!-- Second navbar -->
	@include('Users.layuots.SecondNavbar')
	<!-- /second navbar -->


	<!-- Page header -->
	@include('Users.layuots.PageHeader')
	<!-- /page header -->
	

	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">

	
	@yield('contents')
	

@if(url()->current() == route('user.index'))
                             @php
                                $status = array(
                                    '1'=> "label label-default",
                                    '2'=>"label label-success",
                                    '3' => "label label-danger",
                                    '4'=>"label label-info",
                                     );
                             @endphp


@foreach($detail as $item)
<div class="col-lg-6">

							<!-- Blog layout #3 with image -->
							<div class="panel panel-flat blog-horizontal blog-horizontal-3">
								<div class="panel-body">
								

									<div class="blog-preview">
										<div class="content-group">
										<div class="table-responsive content-group">
										<table class="table table-user-information">
                <tbody>
​
                    <tr>
                        <td>
                            <strong>
                                
                                اسم الخلل
                            </strong>
                        </td>
                        <td class="text-primary">
​
                                <li> {{$item->problem_name}} </li>
​
​
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>
                               
                             رقم الخلل
                            </strong>
                        </td>
                        <td class="text-primary">
                        <li>{{$item->key_problem}} </li>
                        </td>
                    </tr>
​
                    <tr>
                        <td>
                            <strong>
                               
                                المدينه
                            </strong>
                        </td>
                        <td class="text-primary">
                        <li>  {{$item->city->city_name}}</li>
                        </td>
                    </tr>
​
​
                    <tr>
                        <td>
                            <strong>
                               
                               جهة الخلل
                            </strong>
                        </td>
                        <td class="text-primary">
                        <li>{{$item->SideDefect->side_defect_name}} </li>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>
                                
                             حالة الخلل
                            </strong>
                        </td>
                        <td class="text-primary">
						<span class="{{$status[$item->tap_order_status]}}">{{$item->order_status}}</span>

                        </td>
                    </tr>
               
                </tbody>
            </table>
        </div>
											<ul class="list-inline list-inline-separate">
												
												<li>{{$item->created_at}}</li>
											</ul>
										</div>

										<p>{{$item->problem_details}}</p>
									 	<hr>
										 {!! link_to_route('user.problems.detail', 'فتح كارت الطلب', ['problemId'=> $item->id],['class'=> 'btn btn-primary']); !!}

									</div>

								</div>
							</div>
							<!-- /blog layout #3 with image -->

						</div>
@endforeach

@endif

	
	
		</div>
		<!-- /page content -->
		@if(url()->current() == route('user.index'))
		{!! $detail-> links('dashboard.pagination') !!}
		@endif
	</div>
	<!-- /page container -->


	<!-- Footer -->
	<div class="footer text-muted">
		&copy; 2015. <a href="#">Limitless Web App Kit</a> by <a href="http://themeforest.net/user/Kopyov" target="_blank">Eugene Kopyov</a>
	</div>
	<!-- /footer -->
	<script>




	</script>


</body>
</html>
