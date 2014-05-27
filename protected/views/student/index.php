<?php $session = Yii::app()->session;

 ?>

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
	<script>

		function validateEmail(email)
	{
		var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
		if( !emailReg.test( email ) ) 
		{
			return false;
		} else 
		{
			return true;
		}
	}
	
	function update_profile()
	{
		if( ($('#user_name').val() && $('#name').val() && $('#email').val() && $('#university').val()) )
		{		
			
			$.each($('form#settings_tab'), function(index) { 
			var sData = $('form#settings_tab').serialize();
			//alert(sData); return false;
			$.ajax({
			type: "POST",
			beforeSend: function(){$('#loading_img').show();},
			url: web_path+ '/student/updateprofile',
			data: sData,
			success: function(data) {
			
			/*alert(data);
			return false;*/
			
			if(data==1)
			{
				$('#loading_img').hide();
				$('#msg_success1').show();
				$('#msg_success1').html("Update Profile Successfully");
				setInterval(function(){
					$('#msg_success1').hide();
				},6000);
			}
			
			if(data==2)
			{
				$('#loading_img').hide();
				$('#msg_error1').show();
				$('#msg_error1').html("This Username Already exists");
				$('#msg_success1').hide();
				setInterval(function(){
					$('#msg_success1').hide();
				},6000);
			}
			
			if(data==3)
			{
				$('#loading_img').hide();
				$('#msg_error1').show();
				$('#msg_error1').html("This Email Already exists");
				$('#msg_success1').hide();
				setInterval(function(){
					$('#msg_success1').hide();
				},6000);
			}
		}
		});
		});
		}
	}
	
	function update_password()
	{
	
	if($('#old_password').val() && $('#new_password').val() )
	{	 
		$.each($('form#password_tab'), function(index) { 
			var sData = $('form#password_tab').serialize();
			//alert(sData); return false;
			
			$.ajax({
				type: "POST",
				beforeSend: function(){$('#loading_img2').show();},
				url: web_path+ '/student/updatepassword',
				data: sData,
				success: function(data) {
					 /* alert(data);
					return false;*/
					
					if(data==1)
					{
						$('#loading_img2').hide();
						$('#msg_success').show();
						$('#msg_success').html("Update Password Successfully");
						$('#msg_error').hide();
						$('#old_password').val(''); $('#password').val('')
						setInterval(function(){
							$('#msg_success').hide();
						},5000);
					}
					
					else if(data==2){
						$('#loading_img2').fadeOut("slow");
						$('#msg_error').show();
						$('#msg_error').html("Please enter the correct Current password");
						$('#msg_success').hide();
						$('#old_password').val(''); $('#password').val('')
						setInterval(function(){
						$('#msg_error').fadeOut("slow");
						},5000);
					}
					
					else{
					$('#loading_img2').fadeOut("slow");
					$('#msg_error').show();
					$('#msg_success').hide();
					$('#msg_error').html("Please enter the correct Current password");
					$('#old_password').val(''); $('#password').val('')
					setInterval(function(){
					$('#msg_error').fadeOut("slow");
					},5000);
					} }
			});
		});
	}
	
	
	}	

	
	</script> 


<input type="hidden" name="student_id" id="student_id" value="<?php echo $session['linkedin_info']['id'];?>"/>

<div class="container">
  <div class="row">
  
    <div class="span3">
      <div class="well sidebar-nav nav-tabs" id="employer-tabs">
        <ul class="nav nav-list">
          <li class="nav-header navlist-top">Student Information</li>
          <li class="navlist-info">
            <h3><?php echo ucwords($session['linkedin_info']['name']."&nbsp;");?></h3>
           <!-- <p>Established: <span>02.13.2012</span></p>-->
          </li>
		
			<li class="active">
				<a href="#current" data-toggle="tab" id="1">Current<div class="tab-counter">
					<span id="count_post">0</span>
					</div></span><div id="loaderp1" style="display:none;"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/select2-spinner.gif" /></div>
				</a>
			</li>
       	
			<li>
				<a href="#active" data-toggle="tab" id="2">Active
					<div class="tab-counter">
						<span>3</span>
					</div>
				</a>
			</li>
	   
			<li>
				<a href="#past" data-toggle="tab" id="3">Past posts
					<div class="tab-counter">
						<span id="count_past_post">0</span>
					</div>
					<div id="loaderp3" style="display:none;">
						<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/select2-spinner.gif" />
					</div>
				</a>
			</li>
				
				
          
			<li>
				<a href="#" data-toggle="tab" id="4">Settings
					<div id="loaderp4" style="display:none;">
						<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/select2-spinner.gif" />
					</div>
				</a>
			</li> 
        
		</ul>
       <!-- <button class="btm-btn btn btn-block">Add new Internship</button>-->
      </div><!--/.well -->
    </div><!--/span-->

    
   <div class="tab-content" id="content_container"> </div>
   
  <!--/row-->


