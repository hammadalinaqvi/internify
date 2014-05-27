<?php 
$session = Yii::app()->session;
 ?>
 <input type="hidden" name="past_post" id="add_post_count" value="<?php echo count($data['add_posts']);?>"  />
   <input type="hidden" name="emp_id" id="employerid" value="<?php echo $session['emp_array']['employer_id'];?>"  />
<div class="span9 tab-pane active" >
<div class="entry-wrap">
  <div class="toolbar">
	<h3>Add New Internship</h3>
  	<div class="clearfix"></div>
  </div>
  <div class="stats">
  <form>
    <input class="daterange" type="text" name="daterange" id="daterange" placeholder="Daterange" />
  	</form>
    <div class="clearfix"></div>
  </div>
  <form class="entry-content">
  <div id="msg"></div>
  	<div class="col1">
    	<div class="employer-logo">
    		<!--<img src="holder.js/72x72/internify">-->
            <img src="<?php if($session['emp_array']['company_logo']){echo "http://".$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl.'/sitedata/logo/'.$session['emp_array']['company_logo'];}else{ echo  "holder.js/72x72/internify";}?>">
    	</div>
  	</div>
  	<div class="col2">
  		<h3><a href="#" id="employer_title" class="myeditable" onclick="show_editable('employer_title','Enter Title','');" placeholder= "enter title" data-type="text" data-pk="1">Enter title</a></h3>
  		<h6><a href="javascript:void(0)" class="myeditable" id="employer_industry" data-type="select2" data-pk="1"  onclick="show_editable('employer_industry','Enter Industry','');">Enter Industry</a></h6>
  		<div id="employer_description"  class="myeditable" data-type="wysihtml5" data-pk="1" data-placement="bottom"  onclick="show_editable('employer_description','Enter Description','');">
  			<p>
    			Enter Description 
				</p>
			</div>
  	</div>
  	<div class="col3">
  		<h4>Skills</h4>
  		<a href="#" id="employer_skills" class="myeditable" data-type="select2"  onclick="show_editable('employer_skills','Enter Skills','');" data-pk="1"  data-original-title="Enter Skills">
  		Enter Skills
  		</a>
  	</div>
  	<div class="clearfix"></div>
  </form>	
	<button class="btm-btn btn btn-block save-internship" data-toggle="button" id="save-internship" type="button">Save Internship</button>
  <!-- end applicants -->
  <div class="clearfix"></div>
</div>
</div>
<script>
	  $(function() {
	       $('#daterange').daterangepicker();
		   $('#save-internship').click(function() {
			$('.myeditable').editable('submit', {   //call submit
				url: web_path+'posting/addinternship/?emp_id='+$('#employerid').val(),
				data : {daterange : $('#daterange').val()},                     //url for creating new user
				success: function(data) {
					/*alert(data);
					return false;*/
				    if(data==1)
					{
						jAlert('Internship has been Added Successfully !', '');
						window.location=web_path+'employer/index';
						var countvalue= parseInt($('#add_post_count').val())+parseInt(1);
						$('#count_post').html(countvalue);	
				    }else{
						
					$('#msg').removeClass('alert-success').addClass('alert-error')
							 .html(data).show();
							/* setInterval(function(){
								 $('#msg').hide()
								 },7000);*/
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
});
		   
	  });
	  </script>
     <!-- <script src="<?php echo "http://".$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl; ?>/js/bootstrap-editable.js"></script>
	<script src="<?php echo "http://".$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl; ?>/js/select2.js"></script>
	<script src="<?php echo "http://".$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl; ?>/js/inputs-ext/wysihtml5/bootstrap-wysihtml5-0.0.2/wysihtml5-0.3.0.min.js"></script>  
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/inputs-ext/wysihtml5/bootstrap-wysihtml5-0.0.2/bootstrap-wysihtml5-0.0.2.min.js"></script>  
	<script src="<?php echo "http://".$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl; ?>/js/inputs-ext/wysihtml5/wysihtml5.js"></script>-->
    
	<script type="text/javascript">
	 
	function show_editable(div_id,title_id,social_values)
	{
		
		 var employer_id = $('#employerid').val()
		//var update_url = web_path+'posting/update/?div_id='+div_id+'&emp_id='+employer_id;
		 //var job_id = $('#job_'+id).val();
		 
		 if(div_id == 'employer_skills')
		 {
			 $.ajax({
				type: "POST",
				dataType: "json",
				url: web_path+ 'posting/getskills',
				success: function(data){
					 $('#employer_skills').editable({
						 title: title_id,
						 value :'',
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
		 }
		 else if(div_id=="employer_industry")
		 {
			  $.ajax({
				type: "POST",
				dataType: "json",
				url: web_path+ 'posting/getindustry',
				success:function(data){
					 $('#employer_industry').editable({
								 title: title_id,
								 value: '',
							 validate: function(value) {
							  if($.trim(value) == '') 
								return 'Required';
							}
						 ,
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
					value: '',
					 validate: function(value) {
					  if($.trim(value) == '') 
						return 'Required';
					},
			  });
		 }
	 }
		
	
	</script>	
 
  <script src="<?php echo "http://".$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl; ?>/js/holder.js"></script>