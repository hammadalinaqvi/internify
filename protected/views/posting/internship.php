<?php $session = Yii::app()->session;?>
<?php error_reporting(0);
//print_r($session['linkedin_info']);

 ?>

<!-- -------------------- PROFILE POPUP -------------------- -->

<?php if( !isset($session['linkedin_info']['linkedin_id'] ) ) { ?>

<div class="modal hide fade" id="finishprofile">
	<div class="modal-header"> <a class="close" data-dismiss="modal">×</a>
		<h3>Sign-In through LinkedIn</h3>
	</div>
	<div class="modal-body">
		<p>You will be redirected to Linked-In Authorization Page. There you might need to give access for the mentioned information to our website. Please do so.</p>
		<br />
		<br />
		<input class="btn btn-primary btn-block" type="button" onClick="window.location = '<?php echo "http://".$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl; ?>/index.php/posting/linkedin'; " id="sign-in-linkedin" value="Sign In with Linkedin">
	</div>
    
	<div class="modal-footer"></div>
</div>
<?php }?>
<?php if( isset($session['linkedin_info']['linkedin_id'] ) ) {

$rows = Yii::app()->db->createCommand("SELECT * FROM student WHERE linkedin_id = '".$session['linkedin_info']['linkedin_id']."'")->queryRow();

if ($rows['address'] == "" || $rows['skill'] == "" ){ ?>
<div class="modal hide fade" id="finishprofile" style="position:absolute; top:5%;">
	<div class="modal-header"> <a class="close" data-dismiss="modal">×</a>
		<h3>Finish your profile</h3>
	</div>
	<div class="modal-body">
		<div class="modal-left"> <img src="<?php if ($session['linkedin_info']['picture'] != NULL ) echo $session['linkedin_info']['picture']; else echo 'holder.js/120x120/internify/text:In Profile Pic' ?>">
			<div class="clearfix"></div>
		</div>
		<div class="modal-right">
			<h1><?php echo $session['linkedin_info']['first_name']. " " . $session['linkedin_info']['last_name']?></h1>
			<h2>Attends <span>
				<?php if ( isset( $session['student_univesity'] ) ) echo $session['student_univesity'];//$session['linkedin_info']['school'] ?>
				</span></h2>
			<h3>&amp; Graduates <span><?php echo $session['linkedin_info']['graduation_date']?></span></h3>
			<div class="clearfix"></div>
		</div>
		<div class="modal-under">
			<form action="#" name="student_profile" id="student_profile" method="post" class="light-well">
				<input type="hidden" name="student_linkedin_id" id="student_linkedin_id" value="<?php echo $session['linkedin_info']['linkedin_id']?>" />
                		<input type="hidden" name="student_industry" id="student_industry" value="<?php echo $session['student_indsutry'];?>" />
				<h3>Add your address</h3>
				<p>You may only be a few steps away. We'll show you.</p>
				<input class="span6" type="text" name="student_address" id="student_address" placeholder="Start typing your address" >
				<!--<script type="text/javascript">
					var student_address = new LiveValidation('student_address', {onlyOnSubmit: true });
					student_address.add(Validate.Presence,{ failureMessage: 'Required' });
				</script> 	-->
				<h3>Add your skills</h3>
				<p>Let's see those skills of yours.</p>
				<input class="skilltags line span6" type="text" name="student_skill_tags" id="student_skill_tags" placeholder="Enter, some, tags..."/>
				<!--<script type="text/javascript">
					var student_skill_tags = new LiveValidation('student_skill_tags', {onlyOnSubmit: true });
					student_skill_tags.add(Validate.Presence,{ failureMessage: 'Required' });
				</script>-->
			</form>
		</div>
	</div>
    <div style="clear:both;"></div>
	<div class="modal-footer">
		<input type="button" name="send_info" id="send_info" value="Save changes" class="btn btn-primary" onclick="student_info();" />
		<!--<a href="#" class="btn btn-primary">Save changes</a>--> 
	</div>
</div>
<?php 
	} // END INNER IF 
} // END OUTER IF ?>

<!-- -------------------- END - PROFILE POPUP -------------------- -->

<div class="container">
	<div class="row"> 
		
		<!-- --------------------- LEFT SIDE BAR ------------------------ -->
		<div class="span3" >
			<div class="well sidebar-nav nav-tabs" >
				<form action="internship" method="post" name="refine_search" id="refine_search">
					<ul class="nav nav-list">
						<li class="nav-header navlist-top">Refine your search</li>
						<div class="accordion" id="accordion2">
							<div class="accordion-group">
								<div class="accordion-heading"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne"> Skills </a> </div>
								<div id="collapseOne" class="accordion-body collapse in">
									<div class="accordion-inner">
										<li class="navlist-info">
											<ul class="tags">
												<?php 
											$skill_ids = "";
											$organization_ids = "";
											
											
											
											if(isset($data['skill_arrary'])){
											
											foreach( $data['skill_arrary'] as $skill_value )
											{
												$skill_ids .= $skill_value['id'].",";
											}
											
											$skill_ids = trim($skill_ids , ",");
											
											foreach( $data['jobs_array'] as $org_value )
											{
												$organization_ids .= $org_value['id'].",";
											}
											
											$organization_ids = trim($organization_ids, ",");
											?>
												<input type="hidden" name="all_skill_ids" id="all_skill_ids" value="<?php echo $skill_ids; ?>" />
												<input type="hidden" name="all_organization_ids" id="all_organization_ids" value="<?php echo $organization_ids; ?>" />
												<input type="hidden" name="search_posted" id="search_posted" value="search_posted" />
												<?php for( $i = 0; $i < count( $data['skill_arrary'] ); $i++) { ?>
												<li id="close_skill_<?php echo $data['skill_arrary'][$i]['id'];?>"> <a href="#" ><?php echo $data['skill_arrary'][$i]['name']; ?>
													<button type="button" class="close"  data-dismiss="modal" aria-hidden="true" onclick="remove_skill(<?php echo $data['skill_arrary'][$i]['id'];?> );">×</button>
													</a> </li>
												<?php }
												
												}
												?>
											</ul>
											<div class="clearfix"></div>
										</li>
									</div>
								</div>
							</div>
							<div class="accordion-group">
								<div class="accordion-heading"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo"> Duration </a> </div>
								<div id="collapseTwo" class="accordion-body collapse">
									<div class="accordion-inner">
										<li class="navlist-info">
											<div class="duration">
												<input class="input-block-level" type="text" name="daterange" id="daterange" />
											</div>
										</li>
									</div>
								</div>
							</div>
							<div class="accordion-group">
								<div class="accordion-heading"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree"> Organization Type </a> </div>
								<div id="collapseThree" class="accordion-body collapse">
									<div class="accordion-inner">
										<li class="navlist-info">
											<ul class="tags">
												<?php 
												if ( isset( $data['jobs_array']) ) {
												for($i=0; $i<count($data['jobs_array']); $i++) {?>
												<li id="close_org_<?php echo $data['jobs_array'][$i]['id'];?>"> <a href="#"><?php echo $data['jobs_array'][$i]['name']; ?>
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="remove_organization(<?php echo $data['jobs_array'][$i]['id']?>)">×</button>
													</a> </li>
												<?php }
												}
												?>
											</ul>
											<div class="clearfix"></div>
										</li>
									</div>
								</div>
							</div>
						</div>
					</ul>
					<button type="submit" class="btm-btn btn btn-block" >Apply Changes</button>
					<!--onclick="refine_searching();"-->
				</form>
			</div>
			<!--/.well --> 
		</div>
		<!--/span--> 
		<!-- --------------------- LEFT SIDE BAR ------------------------ -->
		
		<?php //echo "<pre>"; print_r($data); echo "</pre>"; ?>
		<div class="tab-content"> 
			<!--<div class="alert alert-success alert-block fade in">
				<button type="button" class="close" data-dismiss="alert">×</button>
				<h3 class="alert-heading">Oh snap! You got an error!</h3>
				<p>Change this and that and try again. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. </p>
			</div>
			<div class="alert-show"></div>-->
			
			<div class="span9">
				<?php if (count($data['posts']) > 0) { ?>
				<?php foreach($data['posts'] as $current_post) { 
				
				
				?>
              
				<input type="hidden" name="employer_id" id="employer_id" value="<?php echo $current_post['employer_id'] ?>"  />
				<div class="entry-wrap" id="entry_<?php echo $current_post['id'];?>">
					<form class="entry-content">
						<?php if($current_post['logo']!= ""){
					   	$company_logo = $current_post['logo'];
					   }else{$company_logo = "no-image.jpg";} ?>
						<div class="col1">
							<div class="employer-logo"> <img src="<?php echo Yii::app()->request->baseUrl.'/sitedata/logo/'.$company_logo?>" height="72" width="72"> </div>
							<h4>Share</h4>
							<ul class="social-list">
								<li>
                               
								<?php $twitter_id = Yii::app()->bitly->shorten($current_post['twitter_id'])->getResponseData();
								//echo print_r($twitter_id);
								
								?>
								<script src="//platform.linkedin.com/in.js" data-url="<?php echo $current_post['linkedin_id'];?>" type="text/javascript"></script><script type="IN/Share" data-counter="right"></script></li>
								<li><a href="<?php echo $twitter_id['data']['url'];?>" data-url="<?php echo  $twitter_id['data']['url'];?>" class="twitter-share-button" data-lang="en" data-count="none">Tweet</a> 
									<script>
									
						!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");
						</script> 
								</li>
								<li>
									<div class="fb-send"></div>
								</li>
							</ul>
						</div>
						<div class="col2">
							<h1><?php echo ucwords($current_post['title']);?></h1>
							<h6><?php echo $current_post['jobname'];?></h6>
							<p> <?php echo stripslashes(htmlspecialchars_decode($current_post['description']));?> </p>
						</div>
						<div class="col3">
							<h4>Skills</h4>
							<?php //echo $skill_list_name; ?>
							<ul class="tags">
								<?php
								$skill_data = $rows = Yii::app()->db->createCommand('SELECT name FROM skill WHERE id IN ('.$current_post['skill_id'].') AND status=1')->queryAll();
								foreach($skill_data as $skill){	
									echo '<li><a >'.$skill['name'].'</a></li>';
								}
								?>
							</ul>
						</div>
						<?php
						$address_data  = Yii::app()->db->createCommand('SELECT latitude,longitude FROM employer WHERE employer_id = '.$current_post['employer_id'].'')->queryAll();
						
						$lat = $address_data[0]['latitude'];
						$long = $address_data[0]['longitude'];
						?>
						<div class="clearfix"></div>
					</form>
					<div class="btn-group" data-toggle="buttons-checkbox">
						<button type="button" class="btm-btn btn toggle active" id="internship_toggle_<?php echo $current_post['id']?>" onclick="toggle_internship('<?php echo $current_post['id'] ?>','<?php echo $lat; ?>','<?php echo $long; ?>');">Toggle view</button>
						<button 
						type="button" 
						class="btm-btn-apply btn" 
						id="apply_btn_<?php echo $current_post['id']?>" 
						onclick="apply_now('<?php echo $current_post['id'];?>', '<?php echo $current_post['employer_id'];?>', '<?php echo isset($session['linkedin_info']['id'])?$session['linkedin_info']['id']:NULL?>');">Apply Now </button>
					</div>
					<div class="intern-viewmore toggles" id="internship_<?php echo $current_post['id']?>"   >
						<ul class="viewmore-list">
							<h4>Perks</h4>
							<?php
							if($current_post['perk_id']!= ""){
									//echo $current_post['perk_id'];
								$perks_data =  Yii::app()->db->createCommand('SELECT name FROM perk WHERE id IN ('.$current_post['perk_id'].') AND status=1')->queryAll();
								
								foreach($perks_data as $perk)
								{	
									echo '<li>'.$perk['name'].'</li>';
								}
							}else{
								   echo 'No Perk';
								}
							?>
						</ul>
						<div class="viewmore-map"> 
							
							<!--  <div class="mapbox-map" data-mapid="pixelsonpixels.map-b4b4xpg7" data-lon="-77.04132965087891" data-lat="38.9086642326886" data-zoom="12" data-width="100%" data-height="100%"><div class="marker" data-name="pin-m" data-symbol="commercial" data-color="000000" data-lon="-77.04132965087891" data-lat="38.9086642326886" data-tooltip="Internify"></div></div><script async="" src="//mapbox.com/locator/embed.js" charset="utf-8"></script>-->
							
							<iframe  width='500' height='250' frameBorder='0' scrolling="no" style="overflow:hidden;" src="<?php echo Yii::app()->createUrl('posting/map/?longitude='.$long.'&latitude='.$lat)?>"></iframe>
							<div class="clearfix"></div>
						</div>
					</div>
					


					<div class="clearfix"></div>
				</div>
				<!-- end entry wrap -->
                
				
                <!-- --------------- APPLY FOR INTERNSHIP POP-UP --------------- -->	
					
                    
                    <div class="modal hide fade" id="applyinternship_<?php echo $current_post['id']?>">
  <div class="modal-header">
     <a class="close" data-dismiss="modal">×</a> 
    <h3>Add your touch</h3>
  </div>
  <div class="modal-body">
  <div id="msg_error_<?php echo $current_post['id']?>"></div>
  <div class="resume_image" style="display:none;"></div>
  		<form action="#" id="intern_details_<?php echo $current_post['id']?>" method="POST">
  		 <input type="hidden" name="post_id" id="post_id" value="<?php echo $current_post['id']?>" />
    	<h4>Submit a cover letter and add a resume to the position:</h4>
        <input name="internship_title" value="" id="internship_title" class="input-block-level" type="text" placeholder="Add a title" />
    	<br>
        <textarea name="internship_message" id="internship_message" class="input-block-level" rows="6">Write a fancy message here</textarea>
        <?php 
		/*$student_data = Yii::app()->db->createCommand("SELECT * FROM student WHERE linkedin_id = '".$session['linkedin_info']['linkedin_id']."'")->queryRow();
		
			$resume_data = Yii::app()->db->createCommand("SELECT * FROM job_applicant WHERE student_id='".$student_data['id']."' AND status=1 group by resume desc")->queryAll();
			print_r($resume_data);
			if($resume_data)
			{
		?>
        <i class="icon-file"></i> Select the Previous Resume :
        <select name="old_resume_<?php echo $current_post['id']?>" id="old_resume_<?php echo $current_post['id']?>">
          <option value="" >Resume</option>
        <?php foreach($resume_data as $resume){?>
         <option value="<?php echo $resume['resume']?>" ><?php echo $resume['title']?></option>
        <?php }?>
        </select> <p style="text-align:center;"> OR </p>
         <?php }*/?>
        
    	<input type="file"  name="student_resume_<?php echo $current_post['id']?>" id="student_resume_<?php echo $current_post['id']?>" value=""/>
    	<div class="clearfix"></div>
   
    </form> <div class="modal-under">
    </div>
  </div>
  <div class="modal-footer">
  <button name="submit_resume" id="submit_resume" onclick="upload_resume('<?php echo $current_post['id']?>','<?php echo $current_post['employer_id']?>','<?php echo isset($session['linkedin_info']['id'])?$session['linkedin_info']['id']:NULL?>');" class="btn btn-primary" value="Submit"> Submit</button>
    
  </div>
</div>
  <script>
               /* $(document.ready(function(){
					$('#internship_toggle_<?php echo $current_post['id']?>').addClass('active');
					
					});*/
                </script>
<!-- --------------- APPLY FOR INTERNSHIP POP-UP --------------- -->	
                
				<?php } ?>
				<?php
				} // END IF
				
				else {
				?>
				<div class="entry-wrap" id="entry_">
					<form class="entry-content">
						<div class="col1">
							<div class="employer-logo"> </div>
							<h4></h4>
						</div>
						<div class="col2">
							<h1>No Internships</h1>
							<h6>No internships are added by any employer yet.</h6>
							<p></p>
						</div>
						<div class="col3">
							<h4></h4>
						</div>
						<div class="clearfix"></div>
					</form>
					<div class="btn-group" data-toggle="buttons-checkbox"> </div>
					<div class="clearfix"></div>
				</div>
				<?php }// END ELSE ?>
			</div>
			<!--/span--> 
		</div>
	</div>
	<!--/row--> 
	
</div>
<!--/.fluid-container-->

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=155848384505352";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script> 
<script type="text/javascript">


function remove_skill(id)
{
	var skill_ids = $("#all_skill_ids").val();
	//alert(skill_ids);
	
	var index = skill_ids.indexOf(id);
	if (index == 0)
	{
		var replaced_skill = skill_ids.replace(id+',', '');
		var new_skill = replaced_skill.replace(',,', ',');
		$("#all_skill_ids").attr('value', new_skill);	
	}
	else
	{
		var replaced_skill = skill_ids.replace(id, '');	
		var new_skill = replaced_skill.replace(',,', ',');
		$("#all_skill_ids").attr('value', new_skill);
	}

	//alert(new_value);
	$('#close_skill_'+id).modal('hide');
	$('#close_skill_'+id).hide('slow');

} // END FUNCTION remove-skills

function remove_organization(id)
{
	var org_ids = $("#all_organization_ids").val();
	//alert(skill_ids);
	
	var index = org_ids.indexOf(id);
	if (index == 0)
	{
		var replaced_org = org_ids.replace(id+',', '');
		var new_org = replaced_org.replace(',,', ',');
		$("#all_organization_ids").attr('value', new_org);	
	}
	else
	{
		var replaced_org = org_ids.replace(id, '');	
		var new_org = replaced_org.replace(',,', ',');
		$("#all_organization_ids").attr('value', new_org);
	}
	
	//alert(new_value);
	$('#close_org_'+id).modal('hide');
	$('#close_org_'+id).hide('slow');
} // END FUNCTION remove-organization


function apply_now(post_id, employer_id, student_id)
{
	if(student_id == '')
	{
		//alert("You have not signed-in. Please do so.");
		jAlert("Please Sign In from LinkedIN", "Sign In through LinkedIN");
		
	}else{
	
	$("#applyinternship_"+post_id).modal('show');
	$("#applyinternship_"+post_id).css("z-index", "1500");
	}
}
		

function student_info()
{
	if($('input[name="hidden-student_skill_tags"]').val() !='' && $('#student_address').val() != '' )
	{
		 var sData = $('form#student_profile').serialize();
		 //alert(sData);
			$.ajax({
					type: "POST",
					url: web_path+'/posting/studentprofile',
					data: sData,
					success: function(data) {
						/*alert(data);
						return false;*/
						if(data == 1)
						{
							//$("#finishprofile").modal('hide');
							var url =web_path + '/posting/internship/';
							window.location = url;	
							
						}
					}
			});
	}else
	{
		jAlert(" All Fields Are Required", "Alert!!");
		return false;
	}
}

function refine_searching()
{
	var sData = $('form#refine_search').serialize();
	
	//alert(sData);
	
	$.ajax(
	{
		type: "POST",
		data: sData,
		url: web_path+ 'posting/internship',
		success:function(data){
			alert(data);
			return false;
		}
	});
}

function upload_resume(post_id, employer_id, student_id)
{
	var filename = $('input[id=student_resume_'+post_id+']').val();
	//var old_file = $('#old_resume_'+post_id).val();
	
	
	var sData = $('form#intern_details_'+post_id).serializeArray(); //.serialize()
	
	var internship_title = sData[1].value;
	var internship_message = sData[2].value;
	
	/*alert("post:" + post_id + " | emp: "+ employer_id + " | std: " + student_id + " | rest: " +sData);
	return false;
	*/
	
	var formData = new FormData();
			jQuery.each($('input[id=student_resume_'+post_id+']')[0].files, function(i, file) {formData.append('student_resume', file);});
			formData.append('post_id',post_id);
			formData.append('employer_id',employer_id);
			formData.append('student_id',student_id);
			formData.append('internship_title',internship_title);
			formData.append('internship_message',internship_message);
			/*formData.append('old_resume',old_file);*/
			
			jQuery.ajax({
			url: web_path+ 'posting/apply/?post_id='+post_id+"&employer_id="+employer_id+"&student_id="+student_id,
			type: 'POST',
			 beforeSend: function(){$('.resume_image').show();},
			cache: false,
			contentType: false,
			processData: false,
			data: formData,
			success: function(data)
			{
				/*alert(data);
				return false;*/
				
				if(data == "0")
				{
					 $('.resume_image').hide();
					jAlert("You have already applied to this internship.", "Been There, Done That!!");
					$("#applyinternship_"+post_id).modal('hide');
					$('.resume_image').hide();
					$("#apply_btn_"+post_id).html('Already Applied');
					$("#apply_btn_"+post_id).attr('onclick', '');
				}
				
				if(data == "2")
				{
					 $('.resume_image').hide();
					$('#msg_error_'+post_id).removeClass('alert-success').addClass('alert-error')
							 .html('Please upload only doc or pdf file').show();
							 return false;
				}
			
			if(data == 1)
				{
					 $('.resume_image').hide();
					jAlert("You have Successfully Applied to this internship.", "Success");
					$("#applyinternship_"+post_id).modal('hide');
					$('.resume_image').hide();
					$("#apply_btn_"+post_id).html('Applied');
					$("#apply_btn_"+post_id).attr('onclick', '');
				}
				
				else
				{
				 $('#msg_error_'+post_id).removeClass('alert-success').addClass('alert-error')
							 .html(data).show();
							 $('.resume_image').hide();
							 return false;
				}	
			}
			});
}
</script>