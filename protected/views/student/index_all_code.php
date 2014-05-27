<?php $session = Yii::app()->session; ?>

	<script src="<?php echo "http://".$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl; ?>/js/jquery.js"></script>
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/validation.css" type="text/css" />
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/livevalidation_standalone.compressed.js"></script>
	<link rel="stylesheet" href="<?php echo "http://".$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl; ?>/css/jquery.alerts.css" type="text/css" media="screen" /> 
<script language="javascript">

	jQuery(document).ready(
		function(){
			
			if(jQuery('.nav-list li.active a').attr('id')=='1')
				{
					var student_id = $('#student_id').val();
					var url = web_path + '/student/getTabContent/?id=1&empid='+student_id;
					get_response(url,'#loaderp1','#content_container');
				}
		
			jQuery('.nav-list a').click(
			
				function()
				{
					var student_id = $('#student_id').val();
					var href_id = jQuery(this).attr('id');
					var url = web_path + '/student/gettabcontent/?id='+href_id+'&empid='+student_id;
					var img_load = '#loaderp'+href_id;
					get_response(url,img_load,'#content_container');	
				}
			);	
			
			$('.toggles').hide();
			$(".toggle").click(function () {
				$(this).parent().nextAll('.toggles').first().slideToggle('slow');
				return false;
			});
		}
	);
 

</script>


<input type="hidden" name="student_id" id="student_id" value="<?php echo $session['student_array']['student_id'];?>"/>

<div class="container">
  <div class="row">
  
    <div class="span3">
      <div class="well sidebar-nav nav-tabs" id="employer-tabs">
        <ul class="nav nav-list">
          <li class="nav-header navlist-top">Student Information</li>
          <li class="navlist-info">
            <h3>Simien Antonis Parr</h3>
            <p>Established: <span>02.13.2012</span></p>
          </li>
       
	   
          <!--<li>
          	<a href="#active" data-toggle="tab">Active
	          	<div class="tab-counter">
	          		<span>3</span>
	          	</div>
	          </a>
          </li>-->
		
		
			<li class="active">
				<a href="#current" data-toggle="tab" id="1">Current<div class="tab-counter">
					<span id="count_post">0</span>
					</div></span><div id="loaderp1" style="display:none;"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/select2-spinner.gif" /></div>
				</a>
			</li>
       
	   
	     <!--  <li>
          	<a href="#past" data-toggle="tab">Past
	          	<div class="tab-counter">
	          		<span>1</span>
	          	</div>
	          </a>
          </li>-->
          
		  <!-- <li><a href="#settings" data-toggle="tab">Settings</a></li> -->
		
			<!--<li>
				<a href="#past" data-toggle="tab" id="2"  >Past posts <div class="tab-counter"><span id="count_past_post">0</span></div> <div id="loaderp2" style="display:none;"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/select2-spinner.gif" /></div></a>
			</li>-->
			
			<li>
				<a href="#" data-toggle="tab" id="3">Settings
					<div id="loaderp3" style="display:none;">
						<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/select2-spinner.gif" />
					</div>
				</a>
			</li> 
        
		</ul>
       <!-- <button class="btm-btn btn btn-block">Add new Internship</button>-->
      </div><!--/.well -->
    </div><!--/span-->
    
    <div class="tab-content">
    
	<!-- -------------------- CURRENT POSTS -------------------- -->
	<!--<div class="span9 tab-pane active" id="current">
	  <div class="entry-wrap">
		<div class="toolbar">
			 <div class="toolbar-item"><img src="images/icons/edit.png" alt="edit"/>Edit</div>
			<div class="toolbar-item"><a href="#"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/save.png" alt="edit"/>Save</a></div>
			<div class="toolbar-item"><a href="#"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/duplicate.png" alt="edit"/>Duplicate</a></div>
			<div class="toolbar-item"><a href="#"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/delete.png" alt="edit"/>Delete</a></div>
			<span class="pull-right"><strong>30</strong> days remaining</span>
			<div class="clearfix"></div>
		</div>
		<div class="stats">
			<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/stats-icon.png">
			<div class="stat-visits pull-left">
				<h2><span>2</span>Days in</h2>
			</div>
			<div class="stat-conv pull-left">
				<h2><span>90%</span>Skills</h2>
			</div>
			<div class="stat-apps pull-left">
				<h2><span>3</span>Similar Internships</h2>
			</div>
			<div class="clearfix"></div>
		</div>
		
		<div class="entry-content">
			<div class="col1">
				<div class="employer-logo">
					<img src="holder.js/72x72/internify">
				</div>
				<h4>Share</h4>
				<ul class="social-list">
						<li><script src="//platform.linkedin.com/in.js" type="text/javascript"></script><script type="IN/Share" data-counter="right"></script></li>
						<li><a href="https://twitter.com/share" class="twitter-share-button" data-lang="en" data-count="none">Tweet</a>
						<script>
							!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");
						</script>
						</li>
						<li><div class="fb-send"></div></li>
					</ul>       
			</div>
			<div class="col2">
				<h1>Front-end Designer</h1>
				<h6>Apple <span>Technology Industry</span></h6>
				
				<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes<br><br>
				Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.</p>
			</div>
			<div class="col3">
				<h4>Skills</h4>
				Technology, html, javascript, css, ajax
			</div>
			<div class="clearfix"></div>
		</div>	
		<div class="clearfix"></div>
	  </div>
	 </div>-->
	<!-- -------------------- CURRENT POSTS -------------------- -->

	<!--/span-->
	     
	<!-- <div class="span9 tab-pane active" id="active">
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>#</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Email</th>
				<th>Resume</th>
				<th>Actions</th>
			</tr>
		</thead>
	
		<tbody>
			<tr>
				<td>1</td>
				<td>John </td>
				<td>Kathay</td>
				<td>user@email.com</td>
				<td><button class="btn"><i class="icon-eye-open"></i></button></td>
				<td>
				<div class="btn-toolbar">
				<div class="btn-group">
				<a href="#" class="btn"><i class="icon-ok"></i></a>
				<a href="#" class="btn"><i class="icon-heart"></i></a>
				<a href="#" class="btn"><i class="icon-share-alt"></i></a>
				</div>
				<div class="btn-group">
				<a href="#" class="btn btn-danger"><i class="icon-white icon-remove"></i></a>
				</div>
				</div>
				</td>
			</tr>
			<tr>
				<td>2</td>
				<td>Jennifer</td>
				<td>Robert</td>
				<td>user@email.com</td>
				<td><button class="btn"><i class="icon-eye-open"></i></button></td>
				<td>
				<div class="btn-toolbar">
				<div class="btn-group">
				<a href="#" class="btn"><i class="icon-ok"></i></a>
				<a href="#" class="btn"><i class="icon-heart"></i></a>
				<a href="#" class="btn"><i class="icon-share-alt"></i></a>
				</div>
				<div class="btn-group">
				<a href="#" class="btn btn-danger"><i class="icon-white icon-remove"></i></a>
				</div>
				</div>
				</td>
			</tr>
			<tr>
				<td>3</td>
				<td>John </td>
				<td>Kathay</td>
				<td>user@email.com</td>
				<td><button class="btn"><i class="icon-eye-open"></i></button></td>
				<td>
				<div class="btn-toolbar">
				<div class="btn-group">
				<a href="#" class="btn"><i class="icon-ok"></i></a>
				<a href="#" class="btn"><i class="icon-heart"></i></a>
				<a href="#" class="btn"><i class="icon-share-alt"></i></a>
				</div>
				<div class="btn-group">
				<a href="#" class="btn btn-danger"><i class="icon-white icon-remove"></i></a>
				</div>
				</div>
				</td>
			</tr>
			<tr>
				<td>4</td>
				<td>Jennifer</td>
				<td>Robert</td>
				<td>user@email.com</td>
				<td><button class="btn"><i class="icon-eye-open"></i></button></td>
				<td>
				<div class="btn-toolbar">
				<div class="btn-group">
				<a href="#" class="btn"><i class="icon-ok"></i></a>
				<a href="#" class="btn"><i class="icon-heart"></i></a>
				<a href="#" class="btn"><i class="icon-share-alt"></i></a>
				</div>
				<div class="btn-group">
				<a href="#" class="btn btn-danger"><i class="icon-white icon-remove"></i></a>
				</div>
				</div>
				</td>
			</tr>
		</tbody>
	</table>
	</div> -->
	
	<!-- <div class="span9 tab-pane active" id="past">
	<div class="well">
		<h2>Past Internships</h2>
		<h5>The past posting will be automagically moved to this area and have an option to re-post for a fee</h5>
	</div>
	</div> -->
	
	<!-- <div class="span9 tab-pane active" id="settings">
	<div class="well">
		<ul class="nav nav-tabs">
		  <li class="active"><a href="#home" data-toggle="tab">Profile</a></li>
		  <li><a href="#profile" data-toggle="tab">Password</a></li>
		</ul>
		<div id="myTabContent" class="tab-content">
		  <div class="tab-pane active in" id="home">
			<form id="tab">
				<label>Username</label>
				<input type="text" value="jsmith" class="input-xlarge">
				
				<label>First Name</label>
				<input type="text" value="John" class="input-xlarge">
				
				<label>Last Name</label>
				<input type="text" value="Smith" class="input-xlarge">
				
				<label>Email</label>
				<input type="text" value="jsmith@yourcompany.com" class="input-xlarge">
				
				<label>Address</label>
				<textarea value="Smith" rows="3" class="input-xlarge">2817 S 49th, Apt 314, San Jose, CA 95101
				</textarea>
				
				<label>Time Zone</label>
				<select name="DropDownTimezone" id="DropDownTimezone" class="input-xlarge">
				  <option value="-12.0">(GMT -12:00) Eniwetok, Kwajalein</option>
				  <option value="-11.0">(GMT -11:00) Midway Island, Samoa</option>
				  <option value="-10.0">(GMT -10:00) Hawaii</option>
				  <option value="-9.0">(GMT -9:00) Alaska</option>
				  <option selected="selected" value="-8.0">(GMT -8:00) Pacific Time (US & Canada)</option>
				  <option value="-7.0">(GMT -7:00) Mountain Time (US & Canada)</option>
				  <option value="-6.0">(GMT -6:00) Central Time (US & Canada), Mexico City</option>
				  <option value="-5.0">(GMT -5:00) Eastern Time (US & Canada), Bogota, Lima</option>
				  <option value="-4.0">(GMT -4:00) Atlantic Time (Canada), Caracas, La Paz</option>
				  <option value="-3.5">(GMT -3:30) Newfoundland</option>
				  <option value="-3.0">(GMT -3:00) Brazil, Buenos Aires, Georgetown</option>
				  <option value="-2.0">(GMT -2:00) Mid-Atlantic</option>
				  <option value="-1.0">(GMT -1:00 hour) Azores, Cape Verde Islands</option>
				  <option value="0.0">(GMT) Western Europe Time, London, Lisbon, Casablanca</option>
				  <option value="1.0">(GMT +1:00 hour) Brussels, Copenhagen, Madrid, Paris</option>
				  <option value="2.0">(GMT +2:00) Kaliningrad, South Africa</option>
				  <option value="3.0">(GMT +3:00) Baghdad, Riyadh, Moscow, St. Petersburg</option>
				  <option value="3.5">(GMT +3:30) Tehran</option>
				  <option value="4.0">(GMT +4:00) Abu Dhabi, Muscat, Baku, Tbilisi</option>
				  <option value="4.5">(GMT +4:30) Kabul</option>
				  <option value="5.0">(GMT +5:00) Ekaterinburg, Islamabad, Karachi, Tashkent</option>
				  <option value="5.5">(GMT +5:30) Bombay, Calcutta, Madras, New Delhi</option>
				  <option value="5.75">(GMT +5:45) Kathmandu</option>
				  <option value="6.0">(GMT +6:00) Almaty, Dhaka, Colombo</option>
				  <option value="7.0">(GMT +7:00) Bangkok, Hanoi, Jakarta</option>
				  <option value="8.0">(GMT +8:00) Beijing, Perth, Singapore, Hong Kong</option>
				  <option value="9.0">(GMT +9:00) Tokyo, Seoul, Osaka, Sapporo, Yakutsk</option>
				  <option value="9.5">(GMT +9:30) Adelaide, Darwin</option>
				  <option value="10.0">(GMT +10:00) Eastern Australia, Guam, Vladivostok</option>
				  <option value="11.0">(GMT +11:00) Magadan, Solomon Islands, New Caledonia</option>
				  <option value="12.0">(GMT +12:00) Auckland, Wellington, Fiji, Kamchatka</option>
				</select>
				<div>
					<button class="btn btn-primary">Update</button>
				</div>
			</form>
		  </div>
		  <div class="tab-pane fade" id="profile">
				<form id="tab2">
					<label>New Password</label>
					<input type="password" class="input-xlarge">
					<div>
						<button class="btn btn-primary">Update</button>
					</div>
				</form>
		  </div>
	  </div>
	</div>
	
	</div> -->
	
   <div class="tab-content" id="content_container"> </div>
   
  <!--/row-->

</div><!--/.fluid-container-->

