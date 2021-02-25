<!-- Side Nav START -->
    <div class="side-nav">
        <div class="side-nav-inner">
            <div class="side-nav-logo">
                <a href="{{ secure_asset('/home') }}">
                    <div class="logo logo-dark" style="background-image: url('{{ secure_asset('/resources/assets/images/logo/logo.png') }}')"></div>
                    <div class="logo logo-white" style="background-image: url('{{ secure_asset('/resources/assets/images/logo/logo.png') }}')"></div>
                </a>
                <div class="mobile-toggle side-nav-toggle">
                    <a href="">
                        <i class="ti-arrow-circle-left"></i>
                    </a>
                </div>
            </div>
            <ul class="side-nav-menu scrollable">
                <li class="nav-item {{ (request()->is('home')) ? 'active' : '' }}">
                    <a class="mrg-top-30" href="{{ secure_asset('/home') }}">
                        <span class="icon-holder">
                                <i class="ti-home"></i>
                            </span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="dropdown-toggle" href="javascript:void(0);">
                        <span class="icon-holder"><i class="ti-settings"></i></span>
                        <span class="title">Settings</span>
                        <span class="arrow"><i class="ti-angle-right"></i></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                             <li><a href="{{ secure_asset('/general_settings') }}"><span class="icon-holder"><i class="fa fa-flash"></i></span>&nbsp;General Settings</a></li>
                        </li>
                    </ul>
                </li>   
                @if($isLoggedIn)
					<li class="nav-item">
						<a class="" href="{{ secure_asset('/users') }}">
							<span class="icon-holder">
									<i class="ei ei-time"></i>
								</span>
							<span class="title">Users</span>
						</a>
					</li>
					<li class="nav-item dropdown {{ (request()->segment(1) == 'brands' || request()->segment(1) == 'categories' || request()->segment(1) == 'products') ? 'open' : '' }}">
						<a class="dropdown-toggle" href="javascript:void(0);">
                            <span class="icon-holder"><i class="ti-settings"></i></span>
                            <span class="title">Products</span>
                            <span class="arrow"><i class="ti-angle-right"></i></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                 <li><a href="{{ secure_asset('/brands') }}"><span class="icon-holder"><i class="fa fa-flash"></i></span>&nbsp;Brands</a></li>
                            </li>
                            <li>
                                 <li><a href="{{ secure_asset('/categories') }}"><span class="icon-holder"><i class="fa fa-flash"></i></span>&nbsp;Categories</a></li>
                            </li>
                            <li>
                                 <li><a href="{{ secure_asset('/products') }}"><span class="icon-holder"><i class="fa fa-flash"></i></span>&nbsp;Manage Products</a></li>
                            </li>
                        </ul>
					</li>
					<li class="nav-item">
						<a class="" href="{{ secure_asset('/orders') }}">
							<span class="icon-holder">
									<i class="ei ei-cart-2"></i>
								</span>
							<span class="title">Orders</span>
						</a>
					</li>
                    <li class="nav-item dropdown {{ (request()->segment(1) == 'general_settings' || request()->segment(1) == 'countries' || request()->segment(1) == 'states' || request()->segment(1) == 'cities' || request()->segment(1) == 'roles') ? 'open' : '' }}">
                        <a class="dropdown-toggle" href="javascript:void(0);">
                            <span class="icon-holder"><i class="ti-settings"></i></span>
                            <span class="title">Masters</span>
                            <span class="arrow"><i class="ti-angle-right"></i></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                 <li><a href="{{ secure_asset('/countries') }}"><span class="icon-holder"><i class="fa fa-building"></i></span>&nbsp;&nbsp;Countries</a></li>
                            </li>
                        </ul>
                        <ul class="dropdown-menu">
                            <li>
                                 <li><a href="{{ secure_asset('/states') }}"><span class="icon-holder"><i class="fa fa-building-o"></i></span>&nbsp;&nbsp;States</a></li>
                            </li>
                        </ul>
                        <ul class="dropdown-menu">
                            <li>
                                 <li><a href="{{ secure_asset('/cities') }}"><span class="icon-holder"><i class="fa fa-dot-circle-o"></i></span>&nbsp;&nbsp;Cities</a></li>
                            </li>
                        </ul>
                        <ul class="dropdown-menu">
                            <li>
                                 <li><a href="{{ secure_asset('/roles') }}"><span class="icon-holder"><i class="fa fa-exchange"></i></span>&nbsp;&nbsp;Roles</a></li>
                            </li>
                        </ul>
                    </li>			
                @endif
            </ul>
        </div>
    </div>
    <!-- Side Nav END -->
