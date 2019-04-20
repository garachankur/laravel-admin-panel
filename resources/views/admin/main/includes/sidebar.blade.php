<?php
    function setActiveMenu($route)
    {
        return (Request::is($route) || Request::is($route.'/*')) ? 'active' : '';
    }
?>

<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li class="nav-item {{ setActiveMenu('admin/dashboard') }}">
                <a href="{{url('/admin/dashboard')}}"><i class="fa fa-home"></i><span class="menu-title">Dashboard</span></a>
            </li>


            <li class="nav-item {{ setActiveMenu('admin/users') }}">
                <a href="{{url('/admin/users')}}"><i class="fa fa-users"></i><span class="menu-title">Users</span></a>
            </li>


	    </ul>
	</div>
</div>
