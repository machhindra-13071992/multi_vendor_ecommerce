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
                @if($isLoggedIn)
					<li class="nav-item">
						<a class="" href="{{ secure_asset('/users') }}">
							<span class="icon-holder">
									<i class="ei ei-time"></i>
								</span>
							<span class="title">Users</span>
						</a>
					</li>
					<li class="nav-item">
						<a class="" href="{{ secure_asset('/products') }}">
							<span class="icon-holder">
									<i class="fa fa-product-hunt"></i>
								</span>
							<span class="title">Products</span>
						</a>
					</li>
					<li class="nav-item">
						<a class="" href="{{ secure_asset('/orders') }}">
							<span class="icon-holder">
									<i class="ei ei-cart-2"></i>
								</span>
							<span class="title">Orders</span>
						</a>
					</li>
					<li class="nav-item dropdown {{ (request()->segment(1) == 'pitch_verticals' || request()->segment(1) == 'video_categories'  || request()->segment(1) == 'video_sub_categories'  || request()->segment(1) == 'primary_video_languages'  || request()->segment(1) == 'video_types'  || request()->segment(1) == 'video_length_types'  || request()->segment(1) == 'video_statuses' || request()->segment(1) == 'menus' || request()->segment(1) == 'menu_links'  || request()->segment(1) == 'roles'  || request()->segment(1) == 'countries'  || request()->segment(1) == 'states'  || request()->segment(1) == 'cities' || request()->segment(1) == 'video_formats' || request()->segment(1) == 'page_channels' || request()->segment(1) == 'platforms' || request()->segment(1) == 'post_types' || request()->segment(1) == 'video_source_types' || request()->segment(1) == 'priorities') ? 'open' : '' }}">
                            <a class="dropdown-toggle" href="javascript:void(0);">
                                <span class="icon-holder"><i class="ti-package"></i></span>
                                <span class="title">Masters</span>
                                <span class="arrow"><i class="ti-angle-right"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="nav-item dropdown {{ (request()->segment(1) == 'categories' || request()->segment(1) == 'video_categories'  || request()->segment(1) == 'video_sub_categories'  || request()->segment(1) == 'primary_video_languages'  || request()->segment(1) == 'video_types'  || request()->segment(1) == 'video_length_types'  || request()->segment(1) == 'video_statuses' || request()->segment(1) == 'video_formats'|| request()->segment(1) == 'video_statuses'|| request()->segment(1) == 'video_statuses' || request()->segment(1) == 'video_source_types' || request()->segment(1) == 'priorities' ) ? 'open' : '' }} ">
                                    <a href="javascript:void(0);">
                                        <span><i class="fa fa-video-camera"></i></span><span class="title">&nbsp;&nbsp;Product Related</span></span>
                                        <span class="arrow"><i class="ti-angle-right"></i></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{ secure_asset('/categories') }}"><span class="icon-holder"><i class="fa fa-flash"></i></span><span class="title">&nbsp;&nbsp;Categories</span></a></li>
                                    </ul>
                                </li>
							</ul>
					</li>			
                @endif
            </ul>
        </div>
    </div>
    <!-- Side Nav END -->
