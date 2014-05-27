<?php 
$session = Yii::app()->session;

 ?>
 <div class="modal hide fade" id="internship-payment1" style="width:600px;">
  <div class="modal-header">
    <a class="close" data-dismiss="modal">×</a>
    <h3>Duplicate Internship payment</h3>
  </div>
  <div class="modal-body">
		    <div class="content">
		    	<form id="employer3" name="login" action="#" method="post">
		    	
		    		<h4>You will be charged $30.00 for duplicate internship</h4>
		      	
											
						<div class="payment-wrap">			
							<div class="row-fluid">		
							
								<div class="span6">
				          <input id="tosagreed" name="tos-agreed" type="checkbox" required />
				          I Agree to the <a href="#tos-modal" data-toggle="modal">Terms of Service</a>     
								</div>
													    
								<div class="span6">
							    <button type="button" class="btn btn-primary" name="button"  onclick="add_duplicate_post('<?php if($session['emp_array']['employer_id']){echo $session['emp_array']['employer_id'];}?>','current');">Use card ending with xxxx.</button>
								</div>
								
							</div>
						</div> <!-- end payment wrap -->
		        
		      </form>
		    </div>
		     
  </div>
</div>
<div class="span9 tab-pane active" id="current">
<!--<div class="entry-wrap" id="entry-wrap" style="display:none">
  <div class="toolbar">
	  <input class="daterange" type="text" name="daterange" id="daterange" placeholder="Daterange" />
  	<div class="clearfix"></div>
  </div>
  <div class="stats">
	        	<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/stats-icon.png">
	        	<div class="stat-visits pull-left">
	        		<h2><span>1,453</span>Visits</h2>
	        	</div>
	        	<div class="stat-conv pull-left">
	        		<h2><span>43%</span>Conversion</h2>
	        	</div>
	        	<div class="stat-apps pull-left">
	        		<h2><span>30</span>Applicants</h2>
	        	</div>
	        	<div class="clearfix"></div>
	        </div>
  
  	
	<button class="btm-btn btn btn-block applicants-toggle" data-toggle="button" type="button">Finalize Posting</button>
 
  <div class="clearfix"></div>
</div>
--><?php if(!isset($data[0]['tab_post'])){?>
<input type="hidden" name="post" id="current_post_count" value="<?php echo count($data['posts']);?>"  />

<?php }?>
<input type="hidden" name="past_post" id="past_count" value="<?php echo count($data['past_results']);?>"  />
	     <?php 
		$typeahead_string = '';
	  if(count($data['posts'])>0){
		  
		foreach($data['posts'] as $current_post)
		{
			?>
		  
        <input type="hidden" name="employerid" id="employerid" value="<?php echo $current_post['employer_id'] ?>"  />
       
	      <div class="entry-wrap" id="entry_<?php echo  $current_post['id'] ?>">
          <div id="msg_<?php echo  $current_post['id'] ?>" class="alert hide"></div>

	        <div class="toolbar">
	        	<!-- <div class="toolbar-item"><img src="images/icons/edit.png" alt="edit"/>Edit</div> -->
	        	<!--<div class="toolbar-item"><a href="#"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/save.png" alt="edit"/>Save</a></div>-->
	        	<div class="toolbar-item"><a href="javascript:void(0)" onclick="duplicate_post('<?php echo $current_post['id']?>','<?php echo $current_post['employer_id']?>','<?php echo $current_post['facebook_id'];?>','<?php echo $current_post['twitter_id'];?>','<?php echo $current_post['linkedin_id'];?>');"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/duplicate.png" alt="edit"/>Duplicate</a></div>
	        	<div class="toolbar-item"><a href="javascript:void(0)" onclick="archive_post('<?php echo $current_post['id']?>','<?php echo $current_post['title']?>','<?php echo $current_post['employer_id']?>')" ><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/delete.png" alt="edit"/>Archive</a></div>
               
	        	<span class="pull-right">
                <?php 
				$start_date = strtotime($current_post['start_date']);
				$end_date = strtotime($current_post['end_date']);
                $datediff = $end_date - $start_date;
     
				?>
                <strong><?php echo floor($datediff/(60*60*24));?></strong> days remaining</span>
	        	<div class="clearfix"></div>
	        </div>
	        <div class="stats">
	        	<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/stats-icon.png">
	        	<div class="stat-visits pull-left">
	        		<h2><span>1,453</span>Visits</h2>
	        	</div>
	        	<div class="stat-conv pull-left">
	        		<h2><span>43%</span>Conversion</h2>
	        	</div>
	        	<div class="stat-apps pull-left">
	        		<h2><span>30</span>Applicants</h2>
	        	</div>
	        	<div class="clearfix"></div>
	        </div>
	        
	        <form class="entry-content" id="entry-content-<?php echo $current_post['id'] ?>">
	        	<div class="col1">
		        	<div class="employer-logo">
		        		<!--<img src="holder.js/72x72/internify">-->
                        <img src="<?php  if($current_post['image']){echo "http://".$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl.'/sitedata/logo/'.$current_post['image'];}else{ echo "holder.js/72x72/internify"; }?>" style="width:72px; height:72px;" />
		        	</div>
		        	<h4>Social</h4>
		        	<ul class="social-list">
                  
		        		<li>
                      
                        <a href="javascript:void(0)" id="employer_facebook_<?php echo $current_post['id'] ?>" onclick="show_editable('employer_facebook','<?php echo $current_post['id'] ?>','Enter Facebook url','<?php echo $current_post['facebook_id'];?>');" data-type="text" data-pk="1">  Facebook </a><br /></li>
		        		<li><a href="javascript:void(0)"  id="employer_twitter_<?php echo  $current_post['id'] ?>" onclick="show_editable('employer_twitter','<?php echo  $current_post['id'] ?>','Enter Twitter','<?php echo $current_post['twitter_id'];?>');" data-type="text" data-pk="1">Twitter</a><br /></li>
		        		<li><a href="javascript:void(0)"  id="employer_linkedin_<?php echo  $current_post['id'] ?>" onclick="show_editable('employer_linkedin','<?php echo  $current_post['id'] ?>','Enter Linkedin link','<?php echo $current_post['linkedin_id'];?>');" data-type="text" data-pk="1">LinkedIn</a></li>
		        	</ul>       
	        	</div>
	        	<div class="col2">
	        		<h1><a href="javascript:void(0)"  id="employer_title_<?php echo  $current_post['id'] ?>"  data-type="text" data-pk="1" onclick="show_editable('employer_title','<?php echo  $current_post['id'] ?>','Enter Title','');"><?php echo $current_post['title'];?></a></h1>
                    
	        		<h6><a href="javascript:void(0)" id="employer_industry_<?php echo  $current_post['id'] ?>" data-type="select2" data-pk="1"  onclick="show_editable('employer_industry','<?php echo  $current_post['id'] ?>','Enter Industry','');"><?php echo $current_post['jobname'];?></a></h6>
	        		<div id="employer_description_<?php echo  $current_post['id'] ?>" data-type="wysihtml5" class="textarea" data-pk="1" data-placement="bottom"  onclick="show_editable('employer_description','<?php echo  $current_post['id'] ?>','Enter Description','');">
	        			<p>
		        			<?php echo stripslashes(htmlspecialchars_decode($current_post['description']));?>
								</p>
							</div>
	        	</div>
                <input type="hidden" name="job_id" id="job_<?php echo  $current_post['id']; ?>" value="<?php echo  $current_post['id']; ?>"  />
	        	<div class="col3">
	        		<h4>Skills</h4>
	        		<a href="javascript:void(0)" id="employer_skills_<?php echo  $current_post['id'] ?>" data-type="select2" data-pk="1" data-original-title="Enter Skills"   onclick="show_editable('employer_skills','<?php echo  $current_post['id'] ?>','Enter Skills','');" ><?php
 $skill_data = $rows = Yii::app()->db->createCommand('Select name from skill Where id in ('.$current_post['skill_id'].') and status=1')->queryAll();
		   //print_r($skill_data);
		      $skill_names = '';
			  foreach($skill_data as $skill_row)
				{	
					$skill_names  .= $skill_row['name'].', ';
					
				}
				
		          $skill_list_name = rtrim($skill_names, ", ");  
				 echo $skill_list_name; ?></a>
	        	</div>
	        	<div class="clearfix"></div>
	        </form>	
					<button class="btm-btn btn btn-block applicants-toggle" data-toggle="button" onclick="show_toggle('<?php echo $current_post['id'] ?>');">Toggle Applicants</button>
	        <div class="applicants_<?php echo  $current_post['id'] ?>" style="display:none">
  	<table class="table">
      <thead>
        <tr>
          <th>Favorite</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Email</th>
          <th>Resume</th>
          <th>Actions</th>
          <th>Share</th>
        </tr>
      </thead>
      <tbody>
      <?php 
	   $applicants_data = $rows = Yii::app()->db->createCommand('Select * from  job_applicant Where posting_id = '.$current_post['id'].' and status=1')->queryAll();
	   $i=1;
	   if(count($applicants_data)>0)
	   {
			  foreach($applicants_data as $applicants_row)
				{
					 $student_data = $rows = Yii::app()->db->createCommand('Select * from  student Where id = '.$applicants_row['student_id'].'')->queryAll();	   
						  $fullname = explode(' ',$student_data[0]['name']);
						  list($firstname,$lastname) = $fullname;
					
					 ?>
        <tr>
        	<td><a href="#" class="tipped btn" data-toggle="tooltip" data-placement="top" title="" data-original-title="Favorite"><i class="icon-heart"></i></a></td>
          <td><?php echo $firstname;?> </td>
          <td><?php echo $lastname;?></td>
          <td><?php echo $student_data[0]['email'];?></td>
          <td><a href="#" class="tipped btn" data-toggle="tooltip" data-placement="top" title="" data-original-title="View resume"><i class="icon-eye-open"></i></a></td>
          <td>
			      <a href="#" class="tipped btn" data-toggle="tooltip" data-placement="top" title="" data-original-title="Keep"><i class="icon-ok"></i></a>
			      <a href="#" class="tipped btn" data-toggle="tooltip" data-placement="top" title="" data-original-title="Archive"><i class="icon-remove"></i></a>
          </td>
          <td><a href="#" class="tipped btn" data-toggle="tooltip" data-placement="top" title="" data-original-title="Share"><i class="icon-share-alt"></i></a></td>
        </tr>
        <?php $i++;}
	   }else{
		?>
        <tr>
          <td colspan="6" style="text-align:center;"><span >No Results</span></td>
                  </tr>
        
        <?php }?>
      </tbody>
    </table>
  </div>
	        <div class="clearfix"></div>
	      </div>
	     
         <?php }
	}else{
		 ?>
          
           <div class="entry-wrap" >
          <div class="col2" style="padding:25px; text-align:center;">
	        		
	        		<h4>No Current Posts</h4>
	        		
	        	</div>
           </div>
       
          <?php }?>
	     </div>
          <?php // require_once($_SERVER['DOCUMENT_ROOT'].'internify_local/protected/views/layouts/include_js.php'); ?>
 
<!--	<script src="<?php echo "http://".$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl; ?>/js/bootstrap-editable.js"></script>
	<script src="<?php echo "http://".$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl; ?>/js/select2.js"></script>
	<script src="<?php echo "http://".$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl; ?>/js/inputs-ext/wysihtml5/bootstrap-wysihtml5-0.0.2/wysihtml5-0.3.0.min.js"></script>  
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/inputs-ext/wysihtml5/bootstrap-wysihtml5-0.0.2/bootstrap-wysihtml5-0.0.2.min.js"></script>  
	<script src="<?php echo "http://".$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl; ?>/js/inputs-ext/wysihtml5/wysihtml5.js"></script>-->

 
 <script type="text/javascript">
  $(function() {
	       //$('#daterange').daterangepicker();
		  $("#daterange").livequery(
        function(){ 
            $(this).daterangepicker();
        }); 
		$('.tipped').tooltip({container: 'body'})

   });
 function duplicate_post(post_id,employer_id,fb_id,twitter_id,linkedin_id)
 {
/*	  $('#entry-wrap').show();
	 $('#entry-content-'+post_id).clone().hide().insertAfter('#entry-wrap .stats:last').slideDown('slow');*/
	 
	 var counter = 1;
	 if($('#entry-wrap'+post_id).length == 1){
            jAlert(" This Post has already dupicated.Please complete the  process",'Alert');
            return false;
	}   
 	//$('#daterange').daterangepicker();
	var newTextBoxDiv = $(document.createElement('div'))
	     .attr("id", 'entry-wrap' + post_id)
		 .attr("class", 'entry-wrap');
   
	newTextBoxDiv.html('<div class="toolbar"><input class="daterange" type="text" name="daterange" id="daterange" placeholder="Daterange" /><input class="daterange" type="hidden" value="'+post_id+'" name="postid" id="postid"  /><div class="clearfix"></div></div><div class="stats"><img src="http://localhost:100/internify_local/images/icons/stats-icon.png"><div class="stat-visits pull-left"><h2><span>1,453</span>Visits</h2></div><div class="stat-conv pull-left"><h2><span>43%</span>Conversion</h2></div><div class="stat-apps pull-left"><h2><span>30</span>Applicants</h2></div><div class="clearfix"></div></div><form class="entry-content"><div id="msg"></div><div class="col1"><div class="employer-logo"><img src="<?php if($session['emp_array']['company_logo']){echo "http://".$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl.'/sitedata/logo/'.$session['emp_array']['company_logo'];}else{ echo  "holder.js/72x72/internify";}?>"></div><h4>Social</h4><ul class="social-list"><li><a href="javascript:void(0)" id="facebook_'+post_id+'" onclick="show_editable1(\''+post_id+'\',\'facebook_'+post_id+'\',\'Enter Facebook url\',\''+fb_id+'\');" data-type="text" data-pk="1">Facebook</a><br /></li><li><a href="javascript:void(0)"  id="twitter_'+post_id+'" onclick="show_editable1(\''+post_id+'\',\'twitter_'+post_id+'\',\'Enter Twitter\',\''+twitter_id+'\');" data-type="text" data-pk="1">Twitter</a><br /></li><li><a href="javascript:void(0)"  id="linkedin_'+post_id+'" onclick="show_editable1(\''+post_id+'\',\'linkedin_'+post_id+'\',\'Enter Linkedin link\',\''+linkedin_id+'\');" data-type="text" data-pk="1">LinkedIn</a></li></ul></div><div class="col2"><h1><a href="#" id="title_'+post_id+'" class="myeditable" onclick="show_editable1(\''+post_id+'\',\'title_'+post_id+'\',\'Enter Title\',\'\')" placeholder= "enter title" data-type="text" data-pk="1">'+$('#employer_title_'+post_id).text()+'</a></h1><h6><a href="javascript:void(0)" class="myeditable" id="industry_'+post_id+'" data-type="select2" data-pk="1"  onclick="show_editable1(\''+post_id+'\',\'industry_'+post_id+'\',\'Enter Industry\',\'\');">'+$('#employer_industry_'+post_id).text()+'</a></h6><div id="description_'+post_id+'"  class="myeditable" data-type="wysihtml5" data-pk="1" data-placement="bottom"  onclick="show_editable1(\''+post_id+'\',\'description_'+post_id+'\',\'Enter Description\',\'\');">'+$('#employer_description_'+post_id).text()+'</div></div><div class="col3"><h4>Skills</h4><a href="#" id="skills_'+post_id+'" class="myeditable" data-type="select2"  onclick="show_editable1(\''+post_id+'\',\'skills_'+post_id+'\',\'Enter Skills\',\'\');" data-pk="1"  data-original-title="Enter Skills">'+$('#employer_skills_'+post_id).text()+'</a></div><div class="clearfix"></div></form><button class="btm-btn btn btn-block duplicate-internship"  onclick="payment_duplicate(\''+post_id+'\');"   type="button">Finalize Posting</button>');
newTextBoxDiv.hide().insertBefore("#entry_"+post_id).slideDown('slow');
	 jAlert('The Post has been duplicated', 'Success');
    counter++;
	
	
	
 }
function add_duplicate_post(emp_id,title)
{
	
	if($('#tosagreed').is(':checked'))
	{
		$('.myeditable').editable('submit', {   //call submit
					url: web_path+'posting/duplicatepost/?emp_id='+emp_id+'&title='+title,
					data : {postid : $('#postid').val(),daterange : $('#daterange').val() , title : $('#title_'+$('#postid').val()).text(),industry : $('#industry_'+$('#postid').val()).text(),skills : $('#skills_'+$('#postid').val()).text(), description : $('#description_'+$('#postid').val()).text(),facebook_id : $('#facebook_'+$('#postid').val()).text(),twitter_id : $('#twitter_'+$('#postid').val()).text(),linkedin_id : $('#linkedin_'+$('#postid').val()).text()},                     //url for creating new user
					success: function(data) {
						/*alert(data);
						return false;*/
						if(data==1)
						{
							jAlert(' Duplicate Internship has been Added Successfully !', '');
							setInterval(function(){window.location=web_path+'employer/index';},4000);
							/*var countvalue= parseInt($('#add_post_count').val())+parseInt(1);
							$('#count_post').html(countvalue);	*/
						}else{
							
						$('#msg').removeClass('alert-success').addClass('alert-error')
								 .html(data).show();
								 setInterval(function(){
									 $('#msg').hide()
									 },7000);
						}
					},
					error: function(data) {
						var msg = '';
						if(data.errors) {                //validation error
							$.each(data.errors, function(k, v) { msg += k+": "+v+"<br>"; });  
						} else if(data.responseText) {   //ajax error
							msg = data.responseText; 
						}
						$('#msg').removeClass('alert-success').addClass('alert-error')
								 .html(msg).show();
					}
		}); 
	}else
	{
	   jAlert('Please check this box if you want to proceed', '');	
	}
	return false;
	
			
}
function payment_duplicate(postid)
{
   if($('#daterange').val() && $('#title_'+postid).text() && $('#industry_'+postid).text() && $('#description_'+postid).text() && $('#skills_'+postid).text() && $('#facebook_'+postid).text() && $('#twitter_'+postid).text() && $('#linkedin_'+postid).text() )
   {
	  jConfirm('Have you done all changes in the post "'+$('#title_'+postid).text()+'"?', 'Confirmation Box', function(r) {
			  if(r==true)
			  {
	   			$('#internship-payment1').modal('show');
			  }
			  });
   }
   else
   {
	  jAlert('All Fields Are Required!', 'Alert');
	  return false;
   }	
} 
  
function show_editable(div_id,id,title_id,social_values)
{
	
	 var employer_id=$('#employerid').val()
	 var  update_url = web_path+'posting/update/?id='+id+'&div_id='+div_id+'&emp_id='+employer_id;
	 var job_id=$('#job_'+id).val();
	 if(div_id=='employer_skills')
	 {
		 $.ajax({
			type: "POST",
      		dataType: "json",
      		url: web_path+ 'posting/getskills',
			
			success:function(data){
				 $('#employer_skills_'+id).editable({
					  url: web_path+'posting/update/?id='+id+'&div_id='+div_id+'&emp_id='+employer_id,
					  validate: function(value) {
					  if($.trim(value) == '') 
						return 'Required';
					},
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
	 }else if(div_id=='employer_facebook' || div_id=='employer_twitter' || div_id=='employer_linkedin')
	 {
	 	  $('#'+div_id+'_'+id).editable( {
		        url: update_url,
				title: title_id,
				validate: function(value) {
					  if($.trim(value) == '') 
						return 'Required';
					},
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
	 }else if(div_id=="employer_industry")
	 {
		 
		  $.ajax({
			type: "POST",
      		dataType: "json",
      		url: web_path+ 'posting/getindustry',
			success:function(data){
				 $('#employer_industry_'+id).editable({
					  url: web_path+'posting/update/?id='+id+'&div_id='+div_id+'&emp_id='+employer_id,
					  validate: function(value) {
					  if($.trim(value) == '') 
						return 'Required';
						},
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
	 }else
	 {
		 
		
		// $('.textarea').wysihtml5();
		
	    $('#'+div_id+'_'+id).editable({
		        url: update_url,
				title: title_id,
				validate: function(value) {
					  if($.trim(value) == '') 
						return 'Required';
					},
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

function archive_post(id,post_title,emp_id)
{
	
	/*	var parent = $(this).parent();*/
	jConfirm('Are you sure to make this post "'+post_title+'" Archive?', 'Confirmation Box', function(r) {
			  if(r==true)
			  {
				 $.ajax({
					type: "POST",
					dataType: "json",
					url: web_path+ 'posting/archive/?id='+id+"&emp_id="+emp_id,
					success:function(data){
						/*alert(data);
						return false;*/
						if(data==1)
						{
							$('#count_post').html($('#current_post_count').val()-1);
							$('#current_post_count').val($('#current_post_count').val()-1);
							$('#count_past_post').html(parseInt($('#past_count').val())+1);
							$('#past_count').val(parseInt($('#past_count').val())+1);
						}
					}});
					
					$("#entry_"+id).animate({ backgroundColor: "#fbc7c7" }, "fast")
					.animate({ opacity: "hide" }, "slow");
			  }

	});
}
function show_editable1(post_id,div_id,title_id,social_values)
{
	
	 var employer_id = $('#employerid').val()
	//var update_url = web_path+'posting/update/?div_id='+div_id+'&emp_id='+employer_id;
	 //var job_id = $('#job_'+id).val();
	 
	 if(div_id == 'skills_'+post_id)
	 {
		 $.ajax({
			type: "POST",
			dataType: "json",
			url: web_path+ 'posting/getskills',
			success: function(data){
				 $('#'+div_id).editable({
					 title: title_id,
					  validate: function(value) {
				  if($.trim(value) == '') 
					return 'Required';
				},
				select2: {
					tags: data,
					tokenSeparators: [",", " "]
				}
			});
				}
			
			});
	 }else if(div_id=='facebook_'+post_id || div_id=='twitter_'+post_id || div_id=='linkedin_'+post_id)
 {
	  $('#'+div_id).editable( {
			title: title_id,
			validate: function(value) {
				  if($.trim(value) == '') 
					return 'Required';
				},
			value: social_values,
			data: social_values, 
			
	  });
 }
	 else if(div_id=="industry_"+post_id)
	 {
		 
		  $.ajax({
			type: "POST",
      		dataType: "json",
      		url: web_path+ 'posting/getindustry',
			success:function(data){
				 $('#'+div_id).editable({
					  url: web_path+'posting/checkindustry/?div_id='+div_id,
					  validate: function(value) {
					  if($.trim(value) == '') 
						return 'Required';
						if(value.length > 1)
							return "Enter only one industry";
						},
		        select2: {
		            tags: data,
		            tokenSeparators: [",", " "]
		        }
		    });
				}
			
			});
	 }else
	 {
		// $('.textarea').wysihtml5();
		
		$('#'+div_id).editable({
				title: title_id,
				 validate: function(value) {
				  if($.trim(value) == '') 
					return 'Required';
				},
		  });
	 }
 }
		
		</script>	
 
  <script src="<?php echo "http://".$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl; ?>/js/holder.js"></script>

	
 