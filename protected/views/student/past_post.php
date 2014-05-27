<div class="span9 tab-pane active" id="current">

<?php //echo "<pre>"; print_r($data); exit; ?>
<input type="hidden" name="post" id="past_count" value="<?php echo count($data['posts']);?>"  />


<?php 
	$typeahead_string = '';
	if(count($data['posts'])>0)
	{
		foreach($data['posts'] as $current_post)
		{
		   $skill_data = $rows = Yii::app()->db->createCommand('Select name from skill Where id in ('.$current_post['skill_id'].') and status=1')->queryAll();
		   
			  foreach($skill_data as $skill_row)
				{	
					$skill_names = $skill_row['name'].', ';
					$typeahead_string .= $skill_names;
				}
				
		          $skill_list_name = rtrim($typeahead_string, ", ");  
				 //$skill_list_name = $typeahead_string;   
				  //print_r($skill_list_name);
		?>
        <input type="hidden" name="employerid" id="employerid" value="<?php echo $current_post['employer_id'] ?>"  />
	      <div class="entry-wrap" id="entry_<?php echo  $current_post['id'] ?>">
          <div id="msg_<?php echo  $current_post['id'] ?>" class="alert hide"></div>

	        
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
	        </div> <!--DIV STATS-->
	        
	        <form class="entry-content">
	        	<div class="col1">
		        	<div class="employer-logo">
		        		<img src="holder.js/72x72/internify">
		        	</div>
		        	<h4>Social</h4>
		        	<ul class="social-list">
						<li>
							<script src="//platform.linkedin.com/in.js" type="text/javascript"></script><script type="IN/Share" data-counter="right"></script>
						</li>
						<li>
							<a href="https://twitter.com/share" class="twitter-share-button" data-lang="en" data-count="none">Tweet</a>
							<script>
								!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");
							</script>
						</li>
						
						<li><div class="fb-send"></div></li>
					
					
		        		<!--<li>
	                        <a href="javascript:void(0)" id="employer_facebook_<?php echo $current_post['id'] ?>" onclick="show_editable('employer_facebook','<?php echo $current_post['id'] ?>','Enter Facebook url','<?php echo $current_post['facebook_id'];?>');" data-type="text" data-pk="1">Facebook</a><br />
						</li>
		        		
						<li>
							<a href="javascript:void(0)" id="employer_twitter_<?php echo  $current_post['id'] ?>" onclick="show_editable('employer_twitter','<?php echo  $current_post['id'] ?>','Enter Twitter','<?php echo $current_post['twitter_id'];?>');" data-type="text" data-pk="1">Twitter</a><br />
						</li>
		        		<li>
							<a href="javascript:void(0)"  id="employer_linkedin_<?php echo  $current_post['id'] ?>" onclick="show_editable('employer_linkedin','<?php echo  $current_post['id'] ?>','Enter Linkedin link','<?php echo $current_post['linkedin_id'];?>');" data-type="text" data-pk="1">LinkedIn</a>
						</li>-->
		        	</ul>       
	        	</div>
	        	<div class="col2">
	        		<h1>
						<!--<a href="javascript:void(0)"  id="employer_title_<?php //echo $current_post['id'] ?>"  data-type="text" data-pk="1" onclick="show_editable('employer_title','<?php //echo $current_post['id'] ?>','Enter Title','');">-->
						<?php echo $current_post['title'];?>
						<!--</a>-->
					</h1>
                    
	        		<h6>
					<!--<a href="javascript:void(0)" id="employer_industry_<?php //echo $current_post['id'] ?>" data-type="select2" data-pk="1"  onclick="show_editable('employer_industry','<?php //echo  $current_post['id'] ?>','Enter Industry','');">-->
						<?php echo $current_post['jobname'];?>
						<!--</a>-->
					</h6>
					<!--<div id="employer_description_<?php echo $current_post['id'] ?>" data-type="wysihtml5" class="textarea" data-pk="1" data-placement="bottom"  onclick="show_editable('employer_description','<?php echo $current_post['id'] ?>','Enter Description','');">-->
					<p>
						<?php echo stripslashes(htmlspecialchars_decode($current_post['description']));?>
					</p>
					<!--</div>-->
	        	</div>
                <input type="hidden" name="job_id" id="job_<?php echo  $current_post['id']; ?>" value="<?php echo  $current_post['id']; ?>"  />
	        	<div class="col3">
	        		<h4>Skills</h4>
						<!--<a href="javascript:void(0)" id="employer_skills_<?php echo  $current_post['id'] ?>" data-type="select2" data-pk="1" data-original-title="Enter Skills"   onclick="show_editable('employer_skills','<?php echo  $current_post['id'] ?>','Enter Skills','');" >-->
						
						<?php echo $skill_list_name; ?>
						
						<!--</a>-->
	        	</div>
	        	<div class="clearfix"></div>
	        </form>	
					<!--<button class="btm-btn btn btn-block applicants-toggle" data-toggle="button" onclick="show_toggle('<?php echo $current_post['id'] ?>');">Toggle Applicants</button>-->
	        <div class="applicants_<?php echo  $current_post['id'] ?>" style="display:none">
  	<table class="table">
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
					<div class="btn-group"><a href="#" class="btn btn-danger"><i class="icon-white icon-remove"></i></a></div>
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
  </div>
	        <div class="clearfix"></div>
	      </div>
	     
		<?php 
			}
		}
		
		else { ?>
          
           <div class="entry-wrap">
          <div class="col2" style="text-align:center;">
	        		
	        		<h4> <br /><br />No Past Post<br /><br /><br /></h4>
	        		
	        	</div>
           </div>
       
          <?php }?>
	     </div>
          <?php // require_once($_SERVER['DOCUMENT_ROOT'].'internify_local/protected/views/layouts/include_js.php'); ?>
 
	<script src="<?php echo "http://".$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl; ?>/js/bootstrap-editable.js"></script>
	<script src="<?php echo "http://".$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl; ?>/js/select2.js"></script>
	<script src="<?php echo "http://".$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl; ?>/js/inputs-ext/wysihtml5/bootstrap-wysihtml5-0.0.2/wysihtml5-0.3.0.min.js"></script>  
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/inputs-ext/wysihtml5/bootstrap-wysihtml5-0.0.2/bootstrap-wysihtml5-0.0.2.min.js"></script>  
	<script src="<?php echo "http://".$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl; ?>/js/inputs-ext/wysihtml5/wysihtml5.js"></script>
    
	<script type="text/javascript">
	 
	function show_editable(div_id,id,title_id,social_values)
	{
		 var employer_id=$('#employerid').val()
		 var update_url = web_path+'posting/update/?id='+id+'&div_id='+div_id+'&emp_id='+employer_id;
		 var job_id=$('#job_'+id).val();
		 
		 if(div_id == 'employer_skills')
		 {
			 $.ajax({
				type: "POST",
				dataType: "json",
				url: web_path+ 'posting/getskills',
				success:function(data){
					 $('#employer_skills_'+id).editable({
						  url: web_path+'posting/update/?id='+id+'&div_id='+div_id+'&emp_id='+employer_id,
						  success: function(data) {
							/*  alert(data);
							  return false;*/
						 if(data==1)
						 {
						  $("#msg_"+id).removeClass("alert-error").addClass("alert-success")
							 .html("Updated!").show();
							 setInterval(function(){$('#msg_'+id).hide()},3000);
						 }else{
							
							$("#msg_"+id).removeClass("alert-success").addClass("alert-error")
									 .html(data).show();  
									 setInterval(function(){$('#msg_'+id).hide()},3000);        
									 return false;
							 }
					 },
					select2: {
						tags: data,
						tokenSeparators: [",", " "]
					}
				});
					}
				
				});
		 }
		 
		 else if(div_id=='employer_facebook' || div_id=='employer_twitter' || div_id=='employer_linkedin')
		 {
			  $('#'+div_id+'_'+id).editable( {
					url: update_url,
					title: title_id,
					value: social_values,
					data: social_values, 
					 success: function(data) {
						/* alert(data);
						 return false;*/
						 if(data==1)
						 {
							 
						  $("#msg_"+id).removeClass("alert-error").addClass("alert-success")
							 .html("Updated!").show();
							
								var url =web_path + '/employer/gettabcontent/?id=1&empid='+employer_id;
								get_response(url,'#loaderp1','#content_container');
							 setInterval(function(){$('#msg_'+id).hide()},3000);
						 }else{
							
							$("#msg_"+id).removeClass("alert-success").addClass("alert-error")
									 .html(data).show();  
									 setInterval(function(){$('#msg_'+id).hide()},3000);        
									 return false;
							 }
					 }
			  });
		 }
		 
		 else if(div_id=="employer_industry")
		 {
			  $.ajax({
				type: "POST",
				dataType: "json",
				url: web_path+ 'posting/getindustry',
				success:function(data){
					 $('#employer_industry_'+id).editable({
						  url: web_path+'posting/update/?id='+id+'&div_id='+div_id+'&emp_id='+employer_id,
						  success: function(data) {
							/*  alert(data);
							  return false;*/
						 if(data==1)
						 {
						  $("#msg_"+id).removeClass("alert-error").addClass("alert-success")
							 .html("Updated!").show();
							 setInterval(function(){$('#msg_'+id).hide()},3000);
						 }else{
							
							$("#msg_"+id).removeClass("alert-success").addClass("alert-error")
									 .html(data).show();  
									 setInterval(function(){$('#msg_'+id).hide()},6000);        
									 return false;
							 }
					 },
					select2: {
						tags: data,
						tokenSeparators: [",", " "]
					}
				});
					}
				
				});
		 }
		 
		 else
		 {
			// $('.textarea').wysihtml5();
			
			$('#'+div_id+'_'+id).editable({
					url: update_url,
					title: title_id,
					 success: function(data) {
						/* alert(data);
						 return false;*/
						 if(data==1)
						 {
						  $("#msg_"+id).removeClass("alert-error").addClass("alert-success")
							 .html("Updated!").show();
							
							 setInterval(function(){$('#msg_'+id).hide()},3000);
							 
						 }else{
							
							$("#msg_"+id).removeClass("alert-success").addClass("alert-error")
									 .html(data).show();  
									 setInterval(function(){$('#msg_'+id).hide()},3000);        
									 return false;
							 }
					 }
			  });
		 }
	 }
		
	function delete_post(id,post_title,emp_id)
	{
			/*	var parent = $(this).parent();*/
			jConfirm('Are you sure to delete this post "'+post_title+'"?', 'Confirmation Box', function(r){
				  if(r==true)
				  {
					 $.ajax({
						type: "POST",
						dataType: "json",
						url: web_path+ 'posting/delete/?id='+id+"&emp_id="+emp_id,
						success:function(data){
							/*alert(data);
							return false;*/
							if(data==1)
							{
								$('#count_post').html($('#current_post_count').val()-1);
							}
						}});
						
						$("#entry_"+id).animate({ backgroundColor: "#fbc7c7" }, "fast")
						.animate({ opacity: "hide" }, "slow");
				  }
			});
		}
			
	</script>	
 
  <script src="<?php echo "http://".$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl; ?>/js/holder.js"></script>

	
 