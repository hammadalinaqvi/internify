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
							    <button type="button" class="btn btn-primary" name="button"  onclick="add_duplicate_post('<?php if($session['emp_array']['employer_id']){echo $session['emp_array']['employer_id'];}?>','past');">Use card ending with xxxx.</button>
								</div>
								
							</div>
						</div> <!-- end payment wrap -->
		        
		      </form>
		    </div>
		     
  </div>
</div>   
   <div class="span9 tab-pane active" id="past">
    <?php  if(count($data) > 0){?>
 <?php $i=1; for($j=0; $j<count($data); $j++){
	 ?>   
       
   <div class="entry-wrap"  id="entry_<?php echo $data[$j]['id'] ?>">
  <div class="toolbar">
  	<!-- <div class="toolbar-item"><img src="images/icons/edit.png" alt="edit"/>Edit</div> -->
  	<div class="toolbar-item"><a href="javascript:void(0)" onclick="duplicate_post('<?php echo $data[$j]['id']?>','<?php echo $data[$j]['employer_id']?>','<?php echo $data[$j]['facebook_id'];?>','<?php echo $data[$j]['twitter_id'];?>','<?php echo $data[$j]['linkedin_id'];?>');"fg><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/duplicate.png" alt="edit"/>Duplicate</a></div>
  	<span class="pull-right"><strong>$25.00</strong> Instantly active this post again</span>
  	<div class="clearfix"></div>
  </div>
  <div class="stats">
  	<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/stats-icon.png">
  	<div class="stat-visits pull-left">
  		<h2><span>1453</span>Visits</h2>
  	</div>
  	<div class="stat-conv pull-left">
  		<h2><span>43%</span>Conversion</h2>
  	</div>
  	<div class="stat-apps pull-left">
  		<h2><span>30</span>Applicants</h2>
  	</div>
  	<div class="clearfix"></div>
  </div>
  
  <div class="entry-content">
  	<div class="col1">
    	<div class="employer-logo">
    		<!--<img src="<?php echo Yii::app()->request->baseUrl; ?>/holder.js/72x72/internify">-->
              <img src="<?php echo "http://".$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl.'/sitedata/logo/'.$data[$j]['image']?>" style="width:72px; height:72px;" />
    	</div>
    	<h4>Share</h4>
        <div id="social_links" >
        <script>

		$(document).ready(function(){
		 
		// Twitter
		var twitter_str_<?php echo $data[$j]['id'];?> = '<span style="float:left;width:100px;margin-right:5px;"><iframe allowtransparency="true" frameborder="0" scrolling="no" src="http://platform.twitter.com/widgets/tweet_button.html?url=<?php echo $data[$j]['twitter_id'];?>&amp;text=Post Title&amp;via=techcrunch" style="width:130px; height:50px;" allowTransparency="true" frameborder="0"></iframe></span>';
		$('#tweet-newshare- <?php echo $data[$j]['id'];?>').css('width', '110px').removeClass('twitter').html(twitter_str_<?php echo $data[$j]['id'];?>);
		var linkedin_str_<?php echo $data[$j]['id'];?> = '<scr' + 'ipt type="in/share" data-url="<?php echo $data[$j]['linkedin_id'];?>" data-counter="right" ></scr' + 'ipt>';
		$('#linkedin-newshare-<?php echo $data[$j]['id'];?>').css('width', '110px').removeClass('linkedin').html(linkedin_str_<?php echo $data[$j]['id'];?>);
		if (typeof(IN) != 'object') 
			jQuery.getScript('http://platform.linkedin.com/in.js');
		else 
			IN.parse(document.getElementById('linkedin-newshare-<?php echo $data[$j]['id'];?>'));
			
		
			var s = document.createElement('script');
		s.type = 'text/javascript';
		s.async = true;
		s.src = 'http://connect.facebook.net/en_US/all.js?ver=MU#xfbml=1';
		var x = document.getElementsByTagName('script')[0];
		x.parentNode.insertBefore(s, x);
		
		var fb_str_<?php echo $data[$j]['id'];?> = '<fb:like href="<?php echo $data[$j]['facebook_id'];?>" layout="button_count" send="true" show_faces="false"></fb:like>';
		$('#fb-newshare-<?php echo $data[$j]['id'];?>').removeClass('facebook').css('width', 'auto').html(fb_str_<?php echo $data[$j]['id'];?>);
		FB.XFBML.parse(document.getElementById('fb-newshare-<?php echo $data[$j]['id'];?>'));
		
		
		
	});
 			
      		</script>
            <ul class="social-list">
 
  <li><div class="platform linkedin" id="linkedin-newshare-<?php echo $data[$j]['id'];?>"></div></li>
  <li><div class="platform twitter" id="tweet-newshare-<?php echo $data[$j]['id'];?>"></div></li>
   <li>	<div class="platform facebook" id="fb-newshare-<?php echo $data[$j]['id'];?>"></div></li>
  </ul>
	</div>
    </div>    

  	<div class="col2">
  		<h1 id="employer_title_<?php echo $data[$j]['id'];?>"><?php echo $data[$j]['title'];?></h1>
  		<h6 id="employer_industry_<?php echo $data[$j]['id'];?>"><span><?php echo $data[$j]['jobname'];?> Industry</span></h6>
			<p id="employer_description_<?php echo $data[$j]['id'];?>">
  			<?php echo stripslashes(htmlspecialchars_decode($data[$j]['description']));?>
			</p>
  	</div>
  	<div class="col3">
  		<h4>Skills</h4>
        <div id="employer_skills_<?php echo $data[$j]['id'];?>">
  		<?php
		$skill_names = '';
		 $skill_data = $rows = Yii::app()->db->createCommand('Select name from skill Where id in ('.$data[$j]['skill_id'].') and status=1')->queryAll();
		 foreach($skill_data as $skill_row)
				{	
					$skill_names .=$skill_row['name'].", ";
				}
		          $skill_list_name = rtrim($skill_names, ", ");   
	 
		 echo $skill_list_name; ?>
         </div>
  	</div>
  	<div class="clearfix"></div>
  </div>
  <button class="btm-btn btn btn-block " data-toggle="button" type="button" onclick="show_toggle('<?php echo $data[$j]['id']; ?>')">Toggle Applicants</button>
  <div class="applicants_<?php echo $data[$j]['id']; ?>" style="display:none">
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
	   $applicants_data = $rows = Yii::app()->db->createCommand('Select * from  job_applicant Where posting_id = '.$data[$j]['id'].' and status=1')->queryAll();
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
	} else {?>
    <div class="entry-wrap" >
          <div class="col2" style="padding:25px; text-align:center;">
	        		
	        		<h4>No Past Posts</h4>
	        		
	        	</div>
           </div>
    <?php }?>
  
 	     </div>
         
 
<!--      <script src="<?php echo "http://".$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl; ?>/js/holder.js"></script>-->