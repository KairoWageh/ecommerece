@extends('site.index')
@section('content')
<div class="profile-widget">
	<h2>{{ $user->name }}</h2>
	<p>{{ $user->level }}</p>
</div>
<div class="container">
	<!--/profile-inner-->
	<div class="profile-section-inner">
	    <div class="col-md-6 profile-info">
			<h3 class="inner-tittle">{{ __('personal_information') }} </h3>
			<div class="main-grid3">
			    <div class="p-20">
					<div class="about-info-p">
						<strong>{{__('full_name')}}</strong>
						<br>
						<p class="text-muted">{{ $user->name }}</p>
					</div>
                    <div class="about-info-p">
                        <strong>{{ __('email') }}</strong>
                        <br>
                        <p class="text-muted"><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></p>
                    </div>
				</div>
			</div>
			<h3 class="inner-tittle">Biography </h3>
			<div class="main-grid3 p-skill">
				<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
				<p class="para">But also the leap into electronic typesetting, remaining essentially unchanged.</p>
				<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
			</div>
			<h3 class="inner-tittle two">Skills </h3>
			<div class="main-grid3">
		      	<div class="bar">
					<p>UI/UX</p>
				</div>
				<div class="skills">
					<div class="skill1" style="width:100%">
					</div>
				</div>
				<div class="bar">
					<p>HTML / CSS3 / SASS</p>
				</div>
				<div class="skills">
					<div class="skill2" style="width:90%">
					</div>
				</div>
				<div class="bar">
					<p>Javascript</p>
				</div>
				<div class="skills">
					<div class="skill3" style="width:75%">
					</div>
				</div>
				<div class="bar">
					<p>Wordpress</p>
				</div>
				<div class="skills">
					<div class="skill4" style="width:85%">
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6 profile-info two">
			<h3 class="inner-tittle">Activity </h3>
			<div class="main-grid3 p-skill">
				<ul class="timeline">
					<li>
						<div class="timeline-badge info">	<i class="fa fa-smile-o"></i></div>
						<div class="timeline-panel">
							<div class="timeline-heading">
								<h4 class="timeline-title">
									<a href="profile.html">Jasmin Leo</a>
								</h4>
							</div>
							<div class="timeline-body">
								<p class="time">5 Minutes ago</p>
							  	<p>Uploaded 2 new Photos 	<i class="fa fa-picture-o"></i>
							  	</p>
							</div>
						</div>
					</li>
					<li>
						<div class="timeline-badge primary">
							<i class="fa fa-star-o"></i>
						</div>
						<div class="timeline-panel">
							<div class="timeline-heading">
								<h4 class="timeline-title">
									<a href="profile.html">Jasmin Leo</a>
								</h4>
							</div>
							<div class="timeline-body">
								<p class="time">2 Minutes ago</p>
							  	<p>Uploaded 2 new Photos 	<i class="fa fa-picture-o"></i>
							  	</p>
							</div>
						</div>
					</li>
					<li>
						<div class="timeline-badge danger">
							<i class="fa fa-times-circle-o"></i>
						</div>
						<div class="timeline-panel">
							<div class="timeline-heading">
							   <h4 class="timeline-title">
							   		<a href="profile.html">Jasmin Leo</a>
							   	</h4>
							</div>
							<div class="timeline-body">
								<p class="time">10 Minutes ago</p>
							  	<p>Uploaded 5 new Photos 	<i class="fa fa-picture-o"></i>
							  	</p>
							</div>
						</div>
					</li>
					<li>
						<div class="timeline-badge success">
							<i class="fa fa-check-circle-o"></i>
						</div>
						<div class="timeline-panel">
							<div class="timeline-heading">
								<h4 class="timeline-title">
									<a href="profile.html">Jasmin Leo</a>
								</h4>
							</div>
							<div class="timeline-body">
								<p class="time">15 Minutes ago</p>
							  	<p>Uploaded 2 new Photos 	<i class="fa fa-picture-o"></i>
							  	</p>
							</div>
						</div>
					</li>
				</ul>
				<div class="clearfix"></div>
			</div>
		</div>
			<!--/map-->
		<div class="col-md-6 profile-info two">
		   <h3 class="inner-tittle two">My Office </h3>
			<div class="main-grid3 map">
				<iframe src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Purwokerto,+Central+Java,+Indonesia&amp;aq=0&amp;oq=purwo&amp;sll=37.0625,-95.677068&amp;sspn=50.291089,104.238281&amp;ie=UTF8&amp;hq=&amp;hnear=Purwokerto,+Banyumas,+Central+Java,+Indonesia&amp;ll=-7.431391,109.24783&amp;spn=0.031022,0.050898&amp;t=m&amp;z=14&amp;output=embed">
				</iframe>
				<div class="gmap-info">
					<h4>
						<i class="fa fa-map-marker"></i> <b>
							<a href="#" class="text-dark">Augment Pvt. Ltd</a>
						</b>
					</h4>
					<p>No. 3,Honey Infinity - Tower, </p>
					<p>E 3rd, 4th, and 5th Floors</p>
					<p>London, UK</p>
				</div>

			</div>
			<!--//map-->
		</div>
		<div class="clearfix"></div>
	</div>
</div>
@endsection
