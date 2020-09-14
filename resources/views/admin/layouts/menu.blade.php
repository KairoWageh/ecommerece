</div>
<!--inner block end here-->
<!--copy rights start here-->
<div class="copyrights">
	 <p>© 2020 Ecommerce. All Rights Reserved | Design by  <a href="https://www.linkedin.com/in/kairo-wageh-591811b5/" target="_blank">Kairo Wageh </a> </p>
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
		        		<span>{{__('admin.dashboard')}}</span>
		        		@if(Session::get('lang') == 'en')
		        			<span class="fa fa-angle-right" style="float: right"></span>
		        		@else
		        			<span class="fa fa-angle-left" style="float: left"></span>
		        		@endif
		        	</a>
		        	<!-- <ul>
			            <li><a href="{{ route('home') }}">{{__('admin.dashboard')}}</a></li>
			            <li><a href="{{ route('admin.settings') }}">{{__('admin.settings')}}</a></li>
		          </ul> -->
		        </li>
		        <li>
		        	<a href="#">
		        		<i class="fa fa-users"></i>
		        		<span>{{__('admin.adminsAccounts')}}</span>
		        		@if(Session::get('lang') == 'en')
		        			<span class="fa fa-angle-right" style="float: right"></span>
		        		@else
		        			<span class="fa fa-angle-left" style="float: left"></span>
		        		@endif
		        	</a>
		          <ul>
		            <li><a href="{{ route('admin.index') }}">{{__('admin.adminsAccounts')}}</a></li>
		            <li><a href="{{ route('admin.create') }}">{{__('admin.addNewAdmin')}}</a></li>
		          </ul>
		        </li>
		        <li>
		        	<a href="#">
		        		<i class="fa fa-users"></i>
		        		<span>{{__('admin.usersAccounts')}}</span>
		        		@if(Session::get('lang') == 'en')
		        			<span class="fa fa-angle-right" style="float: right"></span>
		        		@else
		        			<span class="fa fa-angle-left" style="float: left"></span>
		        		@endif
		        	</a>
		          <ul>
		            <li><a href="{{ route('users.index') }}">{{__('admin.usersAccounts')}}</a></li>
		            <li><a href="{{ route('users.index', ['level' => 'user']) }}">{{__('admin.user')}}</a></li>
		            <li><a href="{{ route('users.index', ['level' => 'vendor']) }}">{{__('admin.vendor')}}</a></li>
		            <li><a href="{{ route('users.index', ['level' => 'company']) }}">{{__('admin.company')}}</a></li>
		            <li><a href="{{ route('users.create') }}">{{__('admin.addNewUser')}}</a></li>
		          </ul>
		        </li>
		        <!-- countries li -->
		        <li>
		        	<a href="#">
		        		<i class="fa fa-flag"></i>
		        		<span>{{__('admin.countries')}}</span>
		        		@if(Session::get('lang') == 'en')
		        			<span class="fa fa-angle-right" style="float: right"></span>
		        		@else
		        			<span class="fa fa-angle-left" style="float: left"></span>
		        		@endif
		        	</a>
		          <ul>
		            <li><a href="{{ route('countries.index') }}">{{__('admin.countries')}}</a></li>
		            <li><a href="{{ route('countries.create') }}">{{__('admin.add')}}</a></li>
		          </ul>
		        </li>
		        <!--// countries li -->

		        <!-- cities li -->
		        <li>
		        	<a href="#">
		        		<i class="fa fa-flag"></i>
		        		<span>{{__('admin.cities')}}</span>
		        		@if(Session::get('lang') == 'en')
		        			<span class="fa fa-angle-right" style="float: right"></span>
		        		@else
		        			<span class="fa fa-angle-left" style="float: left"></span>
		        		@endif
		        	</a>
		          <ul>
		            <li><a href="{{ route('cities.index') }}">{{__('admin.cities')}}</a></li>
		            <li><a href="{{ route('cities.create') }}">{{__('admin.add')}}</a></li>
		          </ul>
		        </li>
		        <!--// cities li -->

		        <!-- states li -->
		        <li>
		        	<a href="#">
		        		<i class="fa fa-flag"></i>
		        		<span>{{__('admin.states')}}</span>
		        		@if(Session::get('lang') == 'en')
		        			<span class="fa fa-angle-right" style="float: right"></span>
		        		@else
		        			<span class="fa fa-angle-left" style="float: left"></span>
		        		@endif
		        	</a>
		          <ul>
		            <li><a href="{{ route('states.index') }}">{{__('admin.states')}}</a></li>
		            <li><a href="{{ route('states.create') }}">{{__('admin.add')}}</a></li>
		          </ul>
		        </li>
		        <!--// states li -->

		        <!-- departments li -->
		        <li>
		        	<a href="#">
		        		<i class="fa fa-list-alt"></i>
		        		<span>{{__('admin.departments')}}</span>
		        		@if(Session::get('lang') == 'en')
		        			<span class="fa fa-angle-right" style="float: right"></span>
		        		@else
		        			<span class="fa fa-angle-left" style="float: left"></span>
		        		@endif
		        	</a>
		          <ul>
		            <li><a href="{{ route('departments.index') }}">{{__('admin.departments')}}</a></li>
		            <li><a href="{{ route('departments.create') }}">{{__('admin.add')}}</a></li>
		          </ul>
		        </li>
		        <!--// departments li -->

		        <!-- trademarks li -->
		        <li>
		        	<a href="#">
		        		<i class="fa fa-cube"></i>
		        		<span>{{__('admin.trademarks')}}</span>
		        		@if(Session::get('lang') == 'en')
		        			<span class="fa fa-angle-right" style="float: right"></span>
		        		@else
		        			<span class="fa fa-angle-left" style="float: left"></span>
		        		@endif
		        	</a>
		          <ul>
		            <li><a href="{{ route('trademarks.index') }}">{{__('admin.trademarks')}}</a></li>
		            <li><a href="{{ route('trademarks.create') }}">{{__('admin.add')}}</a></li>
		          </ul>
		        </li>
		        <!--// trademarks li -->

		        <!-- manufacturers li -->
		        <li>
		        	<a href="#">
		        		<i class="fa fa-user"></i>
		        		<span>{{__('admin.manufacturers')}}</span>
		        		@if(Session::get('lang') == 'en')
		        			<span class="fa fa-angle-right" style="float: right"></span>
		        		@else
		        			<span class="fa fa-angle-left" style="float: left"></span>
		        		@endif
		        	</a>
		          <ul>
		            <li><a href="{{ route('manufacturers.index') }}">{{__('admin.manufacturers')}}</a></li>
		            <li><a href="{{ route('manufacturers.create') }}">{{__('admin.add')}}</a></li>
		          </ul>
		        </li>
		        <!--// manufacturers li -->

		        <!-- shippingCompanies li -->
		        <li>
		        	<a href="#">
		        		<i class="fa fa-truck"></i>
		        		<span>{{__('admin.shippingCompanies')}}</span>
		        		@if(Session::get('lang') == 'en')
		        			<span class="fa fa-angle-right" style="float: right"></span>
		        		@else
		        			<span class="fa fa-angle-left" style="float: left"></span>
		        		@endif
		        	</a>
		          <ul>
		            <li><a href="{{ route('shippingCompanies.index') }}">{{__('admin.shippingCompanies')}}</a></li>
		            <li><a href="{{ route('shippingCompanies.create') }}">{{__('admin.add')}}</a></li>
		          </ul>
		        </li>
		        <!--// shippingCompanies li -->

		        <!-- malls li -->
		        <li>
		        	<a href="#">
		        		<i class="fa fa-building"></i>
		        		<span>{{__('admin.malls')}}</span>
		        		@if(Session::get('lang') == 'en')
		        			<span class="fa fa-angle-right" style="float: right"></span>
		        		@else
		        			<span class="fa fa-angle-left" style="float: left"></span>
		        		@endif
		        	</a>
		          <ul>
		            <li><a href="{{ route('malls.index') }}">{{__('admin.malls')}}</a></li>
		            <li><a href="{{ route('malls.create') }}">{{__('admin.add')}}</a></li>
		          </ul>
		        </li>
		        <!--// malls li -->

		        <!-- colors li -->
		        <li>
		        	<a href="#">
		        		<i class="fa fa-paint-brush"></i>
		        		<span>{{__('admin.colors')}}</span>
		        		@if(Session::get('lang') == 'en')
		        			<span class="fa fa-angle-right" style="float: right"></span>
		        		@else
		        			<span class="fa fa-angle-left" style="float: left"></span>
		        		@endif
		        	</a>
		          <ul>
		            <li><a href="{{ route('colors.index') }}">{{__('admin.colors')}}</a></li>
		            <li><a href="{{ route('colors.create') }}">{{__('admin.add')}}</a></li>
		          </ul>
		        </li>
		        <!--// colors li -->

		        <!-- sizes li -->
		        <li>
		        	<a href="#">
		        		<i class="fa fa-info-circle"></i>
		        		<span>{{__('admin.sizes')}}</span>
		        		@if(Session::get('lang') == 'en')
		        			<span class="fa fa-angle-right" style="float: right"></span>
		        		@else
		        			<span class="fa fa-angle-left" style="float: left"></span>
		        		@endif
		        	</a>
		          <ul>
		            <li><a href="{{ route('sizes.index') }}">{{__('admin.sizes')}}</a></li>
		            <li><a href="{{ route('sizes.create') }}">{{__('admin.add')}}</a></li>
		          </ul>
		        </li>
		        <!--// sizes li -->

		        <!-- weights li -->
		        <li>
		        	<a href="#">
		        		<i class="fa fa-balance-scale"></i>
		        		<span>{{__('admin.weights')}}</span>
		        		@if(Session::get('lang') == 'en')
		        			<span class="fa fa-angle-right" style="float: right"></span>
		        		@else
		        			<span class="fa fa-angle-left" style="float: left"></span>
		        		@endif
		        	</a>
		          <ul>
		            <li><a href="{{ route('weights.index') }}">{{__('admin.weights')}}</a></li>
		            <li><a href="{{ route('weights.create') }}">{{__('admin.add')}}</a></li>
		          </ul>
		        </li>
		        <!--// weights li -->

		        <!-- products li -->
		        <li>
		        	<a href="#">
		        		<i class="fa fa-tag"></i>
		        		<span>{{__('admin.products')}}</span>
		        		@if(Session::get('lang') == 'en')
		        			<span class="fa fa-angle-right" style="float: right"></span>
		        		@else
		        			<span class="fa fa-angle-left" style="float: left"></span>
		        		@endif
		        	</a>
		          <ul>
		            <li><a href="{{ route('products.index') }}">{{__('admin.products')}}</a></li>
		            <li><a href="{{ route('products.create') }}">{{__('admin.add')}}</a></li>
		          </ul>
		        </li>
		        <!--// products li -->

		      </ul>
		    </div>
	 </div>
	<div class="clearfix"> </div>
<!-- </div> -->
<!--slide bar menu end here-->
