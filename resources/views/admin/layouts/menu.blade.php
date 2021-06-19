</div>
<!--inner block end here-->
<!--copy rights start here-->
<div class="copyrights">
	<?php
        use App\Setting;
        $app = Setting::first();
    ?>	<p>&copy; 2020
        @if(session('lang') == 'en')
            {{ $app->sitename_en }}
        @elseif(session('lang') == 'ar')
            {{ $app->sitename_ar }}
        @endif. {{ __('all_rights_reserved') }} | {{ __('design_by') }}
        <a href="https://www.linkedin.com/in/kairo-wageh-591811b5/" target="_blank">Kairo Wageh</a>
    </p>
</div>
<!--COPY rights end here-->
</div>
</div>
<!--slider menu-->
    <div class="sidebar-menu">
		  	<div class="logo"> <a href="#" class="sidebar-icon"> <span class="fa fa-bars"></span> </a> <a href="#"> <span id="logo" ></span>
			      <!--<img id="logo" src="" alt="Logo"/>-->
			  </a> </div>
		    <div class="menu">
		      <ul id="menu" >
		        <li id="menu-home" >
		        	<a href="{{ route('home') }}">
		        		<i class="fa fa-tachometer"></i>
		        		<span>{{__('dashboard')}}</span>
		        		@if(Session::get('lang') == 'en')
		        			<span class="fa fa-angle-right" style="float: right"></span>
		        		@else
		        			<span class="fa fa-angle-left" style="float: left"></span>
		        		@endif
		        	</a>
		        	<!-- <ul>
			            <li><a href="{{ route('home') }}">{{__('dashboard')}}</a></li>
			            <li><a href="{{ route('admin.settings') }}">{{__('settings')}}</a></li>
		          </ul> -->
		        </li>
		        <li>
		        	<a href="#">
		        		<i class="fa fa-users"></i>
		        		<span>{{__('adminsAccounts')}}</span>
		        		@if(Session::get('lang') == 'en')
		        			<span class="fa fa-angle-right" style="float: right"></span>
		        		@else
		        			<span class="fa fa-angle-left" style="float: left"></span>
		        		@endif
		        	</a>
		          <ul>
		            <li><a href="{{ route('admin.index') }}">{{__('adminsAccounts')}}</a></li>
		            <li><a href="{{ route('admin.create') }}">{{__('addNewAdmin')}}</a></li>
		          </ul>
		        </li>
		        <li>
		        	<a href="#">
		        		<i class="fa fa-users"></i>
		        		<span>{{__('usersAccounts')}}</span>
		        		@if(Session::get('lang') == 'en')
		        			<span class="fa fa-angle-right" style="float: right"></span>
		        		@else
		        			<span class="fa fa-angle-left" style="float: left"></span>
		        		@endif
		        	</a>
		          <ul>
		            <li><a href="{{ route('users.index') }}">{{__('usersAccounts')}}</a></li>
		            <li><a href="{{ route('users.index', ['level' => 'user']) }}">{{__('user')}}</a></li>
		            <li><a href="{{ route('users.index', ['level' => 'vendor']) }}">{{__('vendor')}}</a></li>
		            <li><a href="{{ route('users.index', ['level' => 'company']) }}">{{__('company')}}</a></li>
		            <li><a href="{{ route('users.create') }}">{{__('addNewUser')}}</a></li>
		          </ul>
		        </li>
		        <!-- countries li -->
		        <li>
		        	<a href="#">
		        		<i class="fa fa-flag"></i>
		        		<span>{{__('countries')}}</span>
		        		@if(Session::get('lang') == 'en')
		        			<span class="fa fa-angle-right" style="float: right"></span>
		        		@else
		        			<span class="fa fa-angle-left" style="float: left"></span>
		        		@endif
		        	</a>
		          <ul>
		            <li><a href="{{ route('countries.index') }}">{{__('countries')}}</a></li>
		            <li><a href="{{ route('countries.create') }}">{{__('add')}}</a></li>
		          </ul>
		        </li>
		        <!--// countries li -->

		        <!-- cities li -->
		        <li>
		        	<a href="#">
		        		<i class="fa fa-flag"></i>
		        		<span>{{__('cities')}}</span>
		        		@if(Session::get('lang') == 'en')
		        			<span class="fa fa-angle-right" style="float: right"></span>
		        		@else
		        			<span class="fa fa-angle-left" style="float: left"></span>
		        		@endif
		        	</a>
		          <ul>
		            <li><a href="{{ route('cities.index') }}">{{__('cities')}}</a></li>
		            <li><a href="{{ route('cities.create') }}">{{__('add')}}</a></li>
		          </ul>
		        </li>
		        <!--// cities li -->

		        <!-- states li -->
		        <li>
		        	<a href="#">
		        		<i class="fa fa-flag"></i>
		        		<span>{{__('states')}}</span>
		        		@if(Session::get('lang') == 'en')
		        			<span class="fa fa-angle-right" style="float: right"></span>
		        		@else
		        			<span class="fa fa-angle-left" style="float: left"></span>
		        		@endif
		        	</a>
		          <ul>
		            <li><a href="{{ route('states.index') }}">{{__('states')}}</a></li>
		            <li><a href="{{ route('states.create') }}">{{__('add')}}</a></li>
		          </ul>
		        </li>
		        <!--// states li -->

		        <!-- departments li -->
		        <li>
		        	<a href="#">
		        		<i class="fa fa-list-alt"></i>
		        		<span>{{__('departments')}}</span>
		        		@if(Session::get('lang') == 'en')
		        			<span class="fa fa-angle-right" style="float: right"></span>
		        		@else
		        			<span class="fa fa-angle-left" style="float: left"></span>
		        		@endif
		        	</a>
		          <ul>
		            <li><a href="{{ route('departments.index') }}">{{__('departments')}}</a></li>
		            <li><a href="{{ route('departments.create') }}">{{__('add')}}</a></li>
		          </ul>
		        </li>
		        <!--// departments li -->

		        <!-- trademarks li -->
		        <li>
		        	<a href="#">
		        		<i class="fa fa-cube"></i>
		        		<span>{{__('trademarks')}}</span>
		        		@if(Session::get('lang') == 'en')
		        			<span class="fa fa-angle-right" style="float: right"></span>
		        		@else
		        			<span class="fa fa-angle-left" style="float: left"></span>
		        		@endif
		        	</a>
		          <ul>
		            <li><a href="{{ route('trademarks.index') }}">{{__('trademarks')}}</a></li>
		            <li><a href="{{ route('trademarks.create') }}">{{__('add')}}</a></li>
		          </ul>
		        </li>
		        <!--// trademarks li -->

		        <!-- manufacturers li -->
		        <li>
		        	<a href="#">
		        		<i class="fa fa-user"></i>
		        		<span>{{__('manufacturers')}}</span>
		        		@if(Session::get('lang') == 'en')
		        			<span class="fa fa-angle-right" style="float: right"></span>
		        		@else
		        			<span class="fa fa-angle-left" style="float: left"></span>
		        		@endif
		        	</a>
		          <ul>
		            <li><a href="{{ route('manufacturers.index') }}">{{__('manufacturers')}}</a></li>
		            <li><a href="{{ route('manufacturers.create') }}">{{__('add')}}</a></li>
		          </ul>
		        </li>
		        <!--// manufacturers li -->

		        <!-- shippingCompanies li -->
		        <li>
		        	<a href="#">
		        		<i class="fa fa-truck"></i>
		        		<span>{{__('shippingCompanies')}}</span>
		        		@if(Session::get('lang') == 'en')
		        			<span class="fa fa-angle-right" style="float: right"></span>
		        		@else
		        			<span class="fa fa-angle-left" style="float: left"></span>
		        		@endif
		        	</a>
		          <ul>
		            <li><a href="{{ route('shippingCompanies.index') }}">{{__('shippingCompanies')}}</a></li>
		            <li><a href="{{ route('shippingCompanies.create') }}">{{__('add')}}</a></li>
		          </ul>
		        </li>
		        <!--// shippingCompanies li -->

		        <!-- malls li -->
		        <li>
		        	<a href="#">
		        		<i class="fa fa-building"></i>
		        		<span>{{__('malls')}}</span>
		        		@if(Session::get('lang') == 'en')
		        			<span class="fa fa-angle-right" style="float: right"></span>
		        		@else
		        			<span class="fa fa-angle-left" style="float: left"></span>
		        		@endif
		        	</a>
		          <ul>
		            <li><a href="{{ route('malls.index') }}">{{__('malls')}}</a></li>
		            <li><a href="{{ route('malls.create') }}">{{__('add')}}</a></li>
		          </ul>
		        </li>
		        <!--// malls li -->

		        <!-- colors li -->
		        <li>
		        	<a href="#">
		        		<i class="fa fa-paint-brush"></i>
		        		<span>{{__('colors')}}</span>
		        		@if(Session::get('lang') == 'en')
		        			<span class="fa fa-angle-right" style="float: right"></span>
		        		@else
		        			<span class="fa fa-angle-left" style="float: left"></span>
		        		@endif
		        	</a>
		          <ul>
		            <li><a href="{{ route('colors.index') }}">{{__('colors')}}</a></li>
		            <li><a href="{{ route('colors.create') }}">{{__('add')}}</a></li>
		          </ul>
		        </li>
		        <!--// colors li -->
		        <!-- sizes li -->
		        <li>
		        	<a href="#">
		        		<i class="fa fa-info-circle"></i>
		        		<span>{{__('sizes')}}</span>
		        		@if(Session::get('lang') == 'en')
		        			<span class="fa fa-angle-right" style="float: right"></span>
		        		@else
		        			<span class="fa fa-angle-left" style="float: left"></span>
		        		@endif
		        	</a>
		          <ul>
		            <li><a href="{{ route('sizes.index') }}">{{__('sizes')}}</a></li>
		            <li><a href="{{ route('sizes.create') }}">{{__('add')}}</a></li>
		          </ul>
		        </li>
		        <!--// sizes li -->

		        <!-- weights li -->
		        <li>
		        	<a href="#">
		        		<i class="fa fa-balance-scale"></i>
		        		<span>{{__('weights')}}</span>
		        		@if(Session::get('lang') == 'en')
		        			<span class="fa fa-angle-right" style="float: right"></span>
		        		@else
		        			<span class="fa fa-angle-left" style="float: left"></span>
		        		@endif
		        	</a>
		          <ul>
		            <li><a href="{{ route('weights.index') }}">{{__('weights')}}</a></li>
		            <li><a href="{{ route('weights.create') }}">{{__('add')}}</a></li>
		          </ul>
		        </li>
		        <!--// weights li -->

		        <!-- products li -->
		        <li>
		        	<a href="#">
		        		<i class="fa fa-tag"></i>
		        		<span>{{__('products')}}</span>
		        		@if(Session::get('lang') == 'en')
		        			<span class="fa fa-angle-right" style="float: right"></span>
		        		@else
		        			<span class="fa fa-angle-left" style="float: left"></span>
		        		@endif
		        	</a>
		          <ul>
		            <li><a href="{{ route('products.index') }}">{{__('products')}}</a></li>
		            <li><a href="{{ route('products.create') }}">{{__('add')}}</a></li>
		          </ul>
		        </li>
		        <!--// products li -->

		      </ul>
		    </div>
	 </div>
	<div class="clearfix"> </div>
<!-- </div> -->
<!--slide bar menu end here-->
