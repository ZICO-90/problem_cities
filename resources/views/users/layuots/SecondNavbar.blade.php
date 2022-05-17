	<!-- Second navbar -->
	<div class="navbar navbar-default" id="navbar-second">
		<ul class="nav navbar-nav no-border visible-xs-block">
			<li><a class="text-center collapsed" data-toggle="collapse" data-target="#navbar-second-toggle"><i class="icon-menu7"></i></a></li>
		</ul>

		<div class="navbar-collapse collapse" id="navbar-second-toggle">
			<ul class="nav navbar-nav">
			<li class="active">

<a href="{{route('user.index')}}"><i class="icon-display4 position-left"></i>الصفحة الرئيسية</a>

</li>
				<li class="active">

					<a href="{{route('user.problems.create')}}"><i class="icon-display4 position-left"></i> تسجيل خلل</a>
				
				</li>

				<li class="active">

					<a href="{{route('user.problems.myorder',auth()->user()->id)}}"><i class="icon-display4 position-left"></i>طلباتي المسجله</a>
				
				</li>

				<li class="active">

					<a href="{{route('user.blog.user.index')}}"><i class="icon-display4 position-left"></i>المقالات</a>
				
				</li>

					<li class="active">

					<a href="{{route('user.about.me.abouts')}}"><i class="icon-display4 position-left"></i>من نحن</a>
				
				</li>

				<li class="active">

<a href="{{route('user.chat.index')}}"><i class="icon-display4 position-left"></i>الشات</a>

</li>



		
			</ul>

			<ul class="nav navbar-nav navbar-right">
				<li>
					<a href="changelog.html">
						<i class="icon-history position-left"></i>
						Changelog
						<span class="label label-inline position-right bg-success-400">2.0</span>
					</a>
				</li>

				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-cog3"></i>
						<span class="visible-xs-inline-block position-right">Share</span>
						<span class="caret"></span>
					</a>

					<ul class="dropdown-menu dropdown-menu-right">
						<li><a href="#"><i class="icon-user-lock"></i> Account security</a></li>
						<li><a href="#"><i class="icon-statistics"></i> Analytics</a></li>
						<li><a href="#"><i class="icon-accessibility"></i> Accessibility</a></li>
						<li class="divider"></li>
						<li><a href="#"><i class="icon-gear"></i> All settings</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
	<!-- /second navbar -->