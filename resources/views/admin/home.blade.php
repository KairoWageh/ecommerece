@extends('admin.index')

@section('content')

<!--market updates updates-->
<div class="market-updates">
	<div class="col-md-4 market-update-gd">
		<div class="market-update-block clr-block-1">
			<div class="col-md-8 market-update-left">
				<h3>{{$registeredUsers}}</h3>
				<h4>{{__('admin.registeredUsers')}}</h4>
				<p>Other hand, we denounce</p>
			</div>
			<div class="col-md-4 market-update-right">
				<i class="fa fa-file-text-o"> </i>
			</div>
		  <div class="clearfix"> </div>
		</div>
	</div>
	<div class="col-md-4 market-update-gd">
		<div class="market-update-block clr-block-2">
		 <div class="col-md-8 market-update-left">
			<h3>135</h3>
			<h4>Daily Visitors</h4>
			<p>Other hand, we denounce</p>
		  </div>
			<div class="col-md-4 market-update-right">
				<i class="fa fa-eye"> </i>
			</div>
		  <div class="clearfix"> </div>
		</div>
	</div>
	<div class="col-md-4 market-update-gd">
		<div class="market-update-block clr-block-3">
			<div class="col-md-8 market-update-left">
				<h3>23</h3>
				<h4>New Messages</h4>
				<p>Other hand, we denounce</p>
			</div>
			<div class="col-md-4 market-update-right">
				<i class="fa fa-envelope-o"> </i>
			</div>
		  <div class="clearfix"> </div>
		</div>
	</div>
	<div class="clearfix"> </div>
</div>
<!--market updates end here-->
<!--mainpage chit-chating-->
<div class="chit-chat-layer1">
	<div class="col-md-6 chit-chat-layer1-left">
        <div class="work-progres">
            <div class="chit-chat-heading">
                  Recent Followers
            </div>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                  <thead>
                                    <tr>
                                      <th>#</th>
                                      <th>Project</th>
                                      <th>Manager</th>                                   
                                                                        
                                      <th>Status</th>
                                      <th>Progress</th>
                                  </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td>1</td>
                                  <td>Face book</td>
                                  <td>Malorum</td>                                 
                                                             
                                  <td><span class="label label-danger">in progress</span></td>
                                  <td><span class="badge badge-info">50%</span></td>
                              </tr>
                              <tr>
                                  <td>2</td>
                                  <td>Twitter</td>
                                  <td>Evan</td>                               
                                                                  
                                  <td><span class="label label-success">completed</span></td>
                                  <td><span class="badge badge-success">100%</span></td>
                              </tr>
                              <tr>
                                  <td>3</td>
                                  <td>Google</td>
                                  <td>John</td>                                
                                  
                                  <td><span class="label label-warning">in progress</span></td>
                                  <td><span class="badge badge-warning">75%</span></td>
                              </tr>
                              <tr>
                                  <td>4</td>
                                  <td>LinkedIn</td>
                                  <td>Danial</td>                                 
                                                             
                                  <td><span class="label label-info">in progress</span></td>
                                  <td><span class="badge badge-info">65%</span></td>
                              </tr>
                              <tr>
                                  <td>5</td>
                                  <td>Tumblr</td>
                                  <td>David</td>                                
                                                                 
                                  <td><span class="label label-warning">in progress</span></td>
                                  <td><span class="badge badge-danger">95%</span></td>
                              </tr>
                              <tr>
                                  <td>6</td>
                                  <td>Tesla</td>
                                  <td>Mickey</td>                                  
                                                             
                                  <td><span class="label label-info">in progress</span></td>
                                  <td><span class="badge badge-success">95%</span></td>
                              </tr>
                          </tbody>
                      </table>
                  </div>
             </div>
      </div>
      <div class="col-md-6 chit-chat-layer1-rit">    	
      	  <div class="geo-chart">
					<section id="charts1" class="charts">
				<div class="wrapper-flex">
				
				    <table id="myTable" class="geoChart tableChart data-table col-table" style="display:none;">
				        <caption>Student Nationalities Table</caption>
				        <tr>
				            <th scope="col" data-type="string">Country</th>
				            <th scope="col" data-type="number">Number of Students</th>
				            <th scope="col" data-role="annotation">Annotation</th>
				        </tr>
				        <tr>
				            <td>China</td>
				            <td align="right">20</td>
				            <td align="right">20</td>
				        </tr>
				        <tr>
				            <td>Colombia</td>
				            <td align="right">5</td>
				            <td align="right">5</td>
				        </tr>
				        <tr>
				            <td>France</td>
				            <td align="right">3</td>
				            <td align="right">3</td>
				        </tr>
				        <tr>
				            <td>Italy</td>
				            <td align="right">1</td>
				            <td align="right">1</td>
				        </tr>
				        <tr>
				            <td>Japan</td>
				            <td align="right">18</td>
				            <td align="right">18</td>
				        </tr>
				        <tr>
				            <td>Kazakhstan</td>
				            <td align="right">1</td>
				            <td align="right">1</td>
				        </tr>
				        <tr>
				            <td>Mexico</td>
				            <td align="right">1</td>
				            <td align="right">1</td>
				        </tr>
				        <tr>
				            <td>Poland</td>
				            <td align="right">1</td>
				            <td align="right">1</td>
				        </tr>
				        <tr>
				            <td>Russia</td>
				            <td align="right">11</td>
				            <td align="right">11</td>
				        </tr>
				        <tr>
				            <td>Spain</td>
				            <td align="right">2</td>
				            <td align="right">2</td>
				        </tr>
				        <tr>
				            <td>Tanzania</td>
				            <td align="right">1</td>
				            <td align="right">1</td>
				        </tr>
				        <tr>
				            <td>Turkey</td>
				            <td align="right">2</td>
				            <td align="right">2</td>
				        </tr>
				
				    </table>
				
				    <div class="col geo_main">
				         <h3 id="geoChartTitle">World Market</h3>
				        <div id="geoChart" class="chart"> </div>
				    </div>
				
				
				</div><!-- .wrapper-flex -->
				</section>				
			</div>
      </div>
     <div class="clearfix"> </div>
</div>
<!--main page chit chating end here-->
<!--main page chart start here-->
<div class="main-page-charts">
    <div class="main-page-chart-layer1">
		<div class="col-md-6 chart-layer1-left"> 
			<div class="glocy-chart">
				<div class="span-2c">  
                        <h3 class="tlt">Sales Analytics</h3>
                        <canvas id="bar" height="300" width="400" style="width: 400px; height: 300px;"></canvas>
                        <script>
                            var barChartData = {
                            labels : ["Jan","Feb","Mar","Apr","May","Jun","jul"],
                            datasets : [
                                {
                                    fillColor : "#FC8213",
                                    data : [65,59,90,81,56,55,40]
                                },
                                {
                                    fillColor : "#337AB7",
                                    data : [28,48,40,19,96,27,100]
                                }
                            ]

                        };
                            new Chart(document.getElementById("bar").getContext("2d")).Bar(barChartData);

                        </script>
                </div> 			  		   			
			</div>
		</div>
		<div class="col-md-6 chart-layer1-right"> 
			<div class="user-marorm">
				<div class="malorum-top">				
				</div>
				<div class="malorm-bottom">
					<span class="malorum-pro"> </span>
				     <h4>unde omnis iste</h4>
					 <h2>Melorum</h2>
					<p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising.</p>
					<ul class="malorum-icons">
						<li><a href="#"><i class="fa fa-facebook"> </i>
							<div class="tooltip"><span>Facebook</span></div>
						</a></li>
						<li><a href="#"><i class="fa fa-twitter"> </i>
							<div class="tooltip"><span>Twitter</span></div>
						</a></li>
						<li><a href="#"><i class="fa fa-google-plus"> </i>
							<div class="tooltip"><span>Google</span></div>
						</a></li>
					</ul>
				</div>
		    </div>
		</div>
	    <div class="clearfix"> </div>
    </div>
</div>
<!--main page chart layer2-->
<div class="chart-layer-2">
	<div class="col-md-6 chart-layer2-right">
			<div class="prograc-blocks">
		     <!--Progress bars-->
	        <div class="home-progres-main">
	           <h3>Total Sales</h3>
	         </div>
	        <div class='bar_group'>
					<div class='bar_group__bar thin' label='Rating' show_values='true' tooltip='true' value='343'></div>
					<div class='bar_group__bar thin' label='Quality' show_values='true' tooltip='true' value='235'></div>
					<div class='bar_group__bar thin' label='Amount' show_values='true' tooltip='true' value='550'></div>
					<div class='bar_group__bar thin' label='Farming' show_values='true' tooltip='true' value='456'></div>
		    </div>
				<script src="{{asset('public/design/adminpanel/js/bars.js')}}"></script>

	      <!--//Progress bars-->
	      </div>
	</div>
	<div class="col-md-6 chart-layer2-left">
		<div class="content-main revenue">			
					<h3>Total Revenue</h3>
					<canvas id="radar" height="300" width="300" style="width: 300px; height: 300px;"></canvas>
						<script>
							var radarChartData = {
								labels : ["","","","","","",""],
								datasets : [
									{
										fillColor : "rgba(104, 174, 0, 0.83)",
										strokeColor : "#68ae00",
										pointColor : "#68ae00",
										pointStrokeColor : "#fff",
										data : [65,59,90,81,56,55,40]
									},
									{
										fillColor : "rgba(236, 133, 38, 0.82)",
										strokeColor : "#ec8526",
										pointColor : "#ec8526",
										pointStrokeColor : "#fff",
										data : [28,48,40,19,96,27,100]
									}
								]
								
							};
							new Chart(document.getElementById("radar").getContext("2d")).Radar(radarChartData);
						</script>
		</div>
	</div>
  	<div class="clearfix"> </div>
</div>
<!--climate start here-->
<div class="climate">
	<div class="col-md-4 climate-grids">
		<div class="climate-grid1">
			<div class="climate-gd1-top">
				<div class="col-md-6 climate-gd1top-left">
					<h4>{{rtrim(date('M d l'), 'day')}}</h4>
					<h3>{{date('h:m')}}<span class="timein-pms">{{date('a')}}</span></h3>				
					<p>{{__('admin.humidity')}}:</p>					
					<p>{{__('admin.sunset')}}:</p>
					<p>{{__('admin.sunrise')}}:</p>
				</div>
				<div class="col-md-6 climate-gd1top-right">
					<span class="clime-icon"> 
					  	<figure class="icons">
							<canvas id="partly-cloudy-day" width="64" height="64">
							</canvas>
						</figure>
						<script>
							var icons = new Skycons({"color": "#fff"}),
								list  = [
									"clear-night", "partly-cloudy-day",
									"partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
									"fog"
								],
								i;

							for(i = list.length; i--; )
								icons.set(list[i], list[i]);

							    icons.play();
						</script>					  
				    </span>					
					<p>88%</p>					
					<p>5:40PM</p>
					<p>6:30AM</p>
				</div>
				<div class="clearfix"> </div>
			</div>
			<div class="climate-gd1-bottom">
				<div class="col-md-4 cloudy1">
					<h4>Hongkong</h4>
					<figure class="icons">
						<canvas id="sleet" width="58" height="58">
						</canvas>
					</figure>
			        <script>
						var icons = new Skycons({"color": "#fff"}),
							list  = [
								"clear-night", "clear-day",
								"partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
								"fog"
							],
							  i;
						for(i = list.length; i--; )
							icons.set(list[i], list[i]);

						  icons.play();
					</script>
					<h3>10c</h3>
				</div>
				<div class="col-md-4 cloudy1">
					<h4>UK</h4>
					<figure class="icons">
						<canvas id="cloudy" width="58" height="58"></canvas>
					</figure>					
					<script>
						var icons = new Skycons({"color": "#fff"}),
						list  = [
							"clear-night", "cloudy",
							"partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
							"fog"
						],
						i;
						for(i = list.length; i--; )
							icons.set(list[i], list[i]);
							icons.play();
					</script>
					<h3>6c</h3>
				</div>
				<div class="col-md-4 cloudy1">
					<h4>USA</h4>
					<figure class="icons">
						<canvas id="snow" width="58" height="58">
						</canvas>
					</figure>
			        <script>
						var icons = new Skycons({"color": "#fff"}),
					    list  = [
							"clear-night", "clear-day",
							"partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
							"fog"
						],
						i;
						for(i = list.length; i--; )
							icons.set(list[i], list[i]);
						    icons.play();
					</script>
					<h3>10c</h3>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
	<div class="col-md-4 climate-grids">
		<div class="climate-grid2">
			<span class="shoppy-rate"><h4>$180</h4></span>
			<ul>
				<li> <i class="fa fa-credit-card"> </i> </li>
				<li> <i class="fa fa-usd"> </i> </li>
			</ul>
		</div>
		<div class="shoppy">
			<h3>Those Who Hate Shopping?</h3>
		</div>
	</div>
	<div class="col-md-4 climate-grids">
		<div class="climate-grid3">
			<div class="popular-brand">
				<div class="col-md-6 popular-bran-left">
				     <h3>Popular</h3>
				     <h4>Brand of this month</h4>
				     <p> Duis aute irure  in reprehenderit.</p>
				</div>
				<div class="col-md-6 popular-bran-right">
					<h3>Polo</h3>
				</div>
			  <div class="clearfix"> </div>
			</div>
			<div class="popular-follow">
				<div class="col-md-6 popular-follo-left">
					<p>Lorem ipsum dolor sit amet, adipiscing elit.</p>
				</div>
				<div class="col-md-6 popular-follo-right">
					<h4>Follower</h4>
					<h5>2892</h5>
				</div>
			  <div class="clearfix"> </div>
			</div>
		</div>
	</div>
	<div class="clearfix"> </div>
</div>
<!--climate end here-->

@endsection
