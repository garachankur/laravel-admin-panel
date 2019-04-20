<nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-dark navbar-shadow">
	<div class="navbar-wrapper">
      	<div class="navbar-header">
        	<ul class="nav navbar-nav flex-row">
          		<li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>
          		<li class="nav-item mr-auto">
		            <a class="navbar-brand">
		              <h3 class="brand-text">ADMIN PANEL</h3>
		            </a>
          		</li>
          		<li class="nav-item d-none d-md-block float-right"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="toggle-icon ft-toggle-right font-medium-3 white" data-ticon="ft-toggle-right"></i></a></li>
		          <li class="nav-item d-md-none">
		            <a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="la la-ellipsis-v"></i></a>
		          </li>
        	</ul>
      	</div>

      	<div class="navbar-container content">
        	<div class="collapse navbar-collapse" id="navbar-mobile">
          		<ul class="nav navbar-nav mr-auto float-left">
		      	    <li class="nav-item d-none d-md-block"><a class="nav-link nav-link-expand" href="#"><i class="ficon ft-maximize"></i></a></li>
          		</ul>

	          	<ul class="nav navbar-nav float-right">
	            	<li class="dropdown dropdown-user nav-item">
	              		<a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
	                		<span class="mr-1">Hello,
	                  			<span class="user-name text-bold-700">{{Auth::guard('admin')->user()->name}}</span>
	                		</span>
	                		<span class="avatar avatar-online">
	                  		<img  style="width:100%;height: 36px; background-position: center center;background-size: cover !important;" src="{{Auth::guard('admin')->user()->image ?  asset('storage/'.config('laraveladminpanel.admin_image_path').Auth::guard('admin')->user()->id.'/thumb/'.Auth::guard('admin')->user()->image) : asset('admin-theme/images/default-user.png')}}" alt="avatar"><i></i></span>
	              		</a>

	              		<div class="dropdown-menu dropdown-menu-right">
                          <a class="dropdown-item" href="{{url('admin/admin-user/editprofile')}}"><i class="fas fa-user"></i> Edit Profile</a>
                          <a class="dropdown-item" href="{{url('admin/admin-user/changepassword')}}"><i class="fas fa-key"></i> Change Password</a>
	                		<a class="dropdown-item" href="javascript:void(0)" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
	                			<i class="fas fa-power-off"></i> Logout
	                		</a>
	              		</div>

		                <form id="logout-form" action="{{ url('admin/logout') }}" method="POST" style="display: none;">
		                    {{ csrf_field() }}
		                </form>
	            	</li>
	          	</ul>
        	</div>
      	</div>
    </div>
 </nav>
