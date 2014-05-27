<?php $session = Yii::app()->session;
/*print_r($session['linkedin_info']);
exit;
print_r($student_data);
exit;*/
 ?>

<div class="span9 tab-pane active" id="settings">

<link rel="stylesheet" href="<?php echo "http://".$_SERVER['HTTP_HOST']. Yii::app()->request->baseUrl; ?>/css/validation.css" type="text/css" />
<script type="text/javascript" src="<?php echo "http://".$_SERVER['HTTP_HOST']. Yii::app()->request->baseUrl; ?>/js/livevalidation_standalone.compressed.js"></script>
	
	<div class="well">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#home" data-toggle="tab">Profile</a></li>
			<!--<li><a href="#profile" data-toggle="tab">Password</a></li>-->
		</ul>
		<div id="myTabContent" class="tab-content">
			<?php //if(count($student_data) >0){?>
			<div class="tab-pane active in" id="home">
				<div id="loading_img" style="display:none;" class="loading"></div>
				<?php $form=$this->beginWidget(
							'CActiveForm', array(
										'id'=>'settings_tab',
										'enableAjaxValidation'=>false,
										'htmlOptions'=>array(
														'onsubmit'=>"return false;",
														'onkeypress'=>"if(event.keyCode == 13) { update_profile(); }"
														),
										)
						);
				?>
			
			<span style="color:#3C3; font-size:12px; font-weight:bold;" id="msg_success1"></span>
			<span style="color:#F00; font-size:12px; font-weight:bold;" id="msg_error1"></span>
			
			<input type="hidden" name="student_id" value="<?php echo $session['linkedin_info']['id'];?>"  />
            <input type="hidden" name="user_id" value="<?php //echo $emp_data['user_login'][0]['id'];?>"  />

			<!--<label>Username</label>
			<input type="text" name="user_name" id="user_name" value="<?php //echo $emp_data['user_login'][0]['username'];?>" class="input-xlarge">
				<script type="text/javascript">
					var user_name = new LiveValidation('user_name',  {onlyOnSubmit: true});
					user_name.add(Validate.Presence,{ failureMessage: 'Required' });
				</script>-->

			<label>Name</label>
			<input type="text" name="name" id="name" value="<?php echo $session['linkedin_info']['name'];?>" class="input-xlarge">
				<script type="text/javascript">
					var name = new LiveValidation('name',  {onlyOnSubmit: true});
					name.add(Validate.Presence,{ failureMessage: 'Required' });
				</script>

			<label>Email</label>
			<input type="text" name="email" id="email" value="<?php echo $session['linkedin_info']['email'];?>" class="input-xlarge">
				<script type="text/javascript">
					var email = new LiveValidation('email', {onlyOnBlur: true});
					email.add(Validate.Presence,{ failureMessage: 'Required' });
					email.add( Validate.Email );
				</script>

			<label>University</label>
			<input type="text" name="university" id="university" value="<?php if(isset($session['linkedin_info']['university'])){echo $session['linkedin_info']['university'];}?>" class="input-xlarge">
				<script type="text/javascript">
					var university = new LiveValidation('university',  {onlyOnSubmit: true});
					university.add(Validate.Presence,{ failureMessage: 'Required' });
				</script>
            <label>Address</label>
			<input type="text" name="indsutry" id="indsutry" value="<?php if(isset($session['linkedin_info']['address'])){  echo $session['linkedin_info']['address'];}else{echo $student_data['student'][0]['address'];}?>" class="input-xlarge">    
               
            <?php 
			
			if(isset($session['linkedin_info']['job_type']) &&  $session['linkedin_info']['job_type'] != ''){
			  $job_data = 	$session['linkedin_info']['job_type'];
			  
			}else if(isset($student_data['student'][0]['job_type']) &&  $student_data['student'][0]['job_type'] != '')
			{
				$job_data =  $student_data['student'][0]['job_type'];
			}
			
			
			if(isset($job_data))
			{
				
				$job_array = $rows = Yii::app()->db->createCommand('Select title from job_type Where id = '.$job_data.' and status=1')->queryAll(); 
				 
				  
			}else
			{
				$job_array = array();
			}
			
			?>   
                
            <label>Industry</label>
			<input type="text" name="indsutry" id="indsutry" value="<?php  if(isset($job_array) && count($job_array)>0) { echo $job_array[0]['title'];}?>" class="input-xlarge">
          
            
            <label>Skills</label>
			<?php 
			if(isset($session['linkedin_info']['skill']) && $session['linkedin_info']['skill'] != ''){
				
				$skill_data = $session['linkedin_info']['skill'];
			}else if(isset($student_data['student'][0]['skill']) &&  $student_data['student'][0]['skill'] != '')
			{
			   $skill_data =  $student_data['student'][0]['skill'];
			}
			if(isset($skill_data))
			{
			$typeahead_string = '';
			$skill_array = $rows = Yii::app()->db->createCommand('Select name from skill Where id in ('.$skill_data.') and status=1')->queryAll();
			foreach($skill_array as $skill_row)
				{	
					$skill_names = $skill_row['name'].', ';
					$typeahead_string .= $skill_names;
				}
				
		         $skill_list_name = rtrim($typeahead_string, ", ");  
			    echo $skill_list_name;
			}
			?>
				
		
		<div> <?php //echo CHtml::SubmitButton('Update',array('onclick'=>'update_profile();',"class"=>"btn btn-primary")); ?></div>
		
		<?php $this->endWidget(); ?>
		</div>
		
<!-- ------------------ PASSWORD DIV ------------------------ -->	
		<!--<div class="tab-pane fade" id="profile">
				<?php $form=$this->beginWidget('CActiveForm', array(
														'id'=>'password_tab',
														'enableAjaxValidation'=>false,
														'htmlOptions'=>array(
														'onsubmit'=>"return false;", /* Disable normal form submit */
														'onkeypress'=>" if(event.keyCode == 13){ send(); } "),
		)); ?>
		
		<div id="loading_img2" style="display:none;" class="loading2"></div>
		<span style="color:#3C3; font-size:12px; font-weight:bold; "  id="msg_success"></span> <span style="color:#F00; font-size:12px; font-weight:bold;" id="msg_error"></span>

		<input type="hidden" name="student_id" value="<?php //echo $emp_data['student']['id'];?>"  />
        <input type="hidden" name="user_id" value="<?php //echo $emp_data['user_login'][0]['id'];?>"  />
		
		<label>Current Password</label>
		<input type="password" name="old_password" id="old_password" class="input-xlarge">
		<script type="text/javascript">
			var old_password = new LiveValidation('old_password',  {onlyOnSubmit: true});
			old_password.add(Validate.Presence,{ failureMessage: 'Required' });
		</script>
		<label>New Password</label>
		
		<input type="password" name="new_password" id="new_password" class="input-xlarge">
		<script type="text/javascript">
			var new_password = new LiveValidation('new_password',  {onlyOnSubmit: true});
			new_password.add(Validate.Presence,{ failureMessage: 'Required' });
		</script>
		<div> <?php echo CHtml::SubmitButton('Update',array('onclick'=>'update_password();',"class"=>"btn btn-primary")); ?> </div>
		<?php $this->endWidget(); ?>
	</div>-->
<!-- ------------------ PASSWORD DIV ------------------------ -->	
	
	
			<?php //}?>
		</div>
	</div>
</div>
<script>


</script> 
