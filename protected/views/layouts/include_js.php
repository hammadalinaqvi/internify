    <script src="<?php echo "http://".$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl; ?>/js/jquery.js"></script>
    <script src="<?php echo "http://".$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl; ?>/js/bootstrap-transition.js"></script>
    <script src="<?php echo "http://".$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl; ?>/js/bootstrap-alert.js"></script>
    <script src="<?php echo "http://".$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl; ?>/js/bootstrap-modal.js"></script>
    <script src="<?php echo "http://".$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl; ?>/js/bootstrap-dropdown.js"></script>
    <script src="<?php echo "http://".$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl; ?>/js/bootstrap-scrollspy.js"></script>
    <script src="<?php echo "http://".$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl; ?>/js/bootstrap-tab.js"></script>
    <script src="<?php echo "http://".$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl; ?>/js/bootstrap-tooltip.js"></script>
    <script src="<?php echo "http://".$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl; ?>/js/bootstrap-popover.js"></script>
    <script src="<?php echo "http://".$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl; ?>/js/bootstrap-button.js"></script>
    <script src="<?php echo "http://".$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl; ?>/js/bootstrap-collapse.js"></script>
    <script src="<?php echo "http://".$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl; ?>/js/bootstrap-carousel.js"></script>
    <script src="<?php echo "http://".$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl; ?>/js/bootstrap-typeahead.js"></script>
     <script src="<?php echo "http://".$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl; ?>/js/bootstrap-fileupload.js"></script>
    <!-- <script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/js/bootstrap.min.js"></script> -->
    <script src="<?php echo "http://".$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl; ?>/js/jquery.livequery.js"></script>
    <script src="<?php echo "http://".$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl; ?>/js/formslider.js"></script>
    <script src="<?php echo "http://".$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl; ?>/js/date.js"></script>
    <script src="<?php echo "http://".$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl; ?>/js/daterangepicker.js"></script>
    <script src="<?php echo "http://".$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl; ?>/js/bootstrap-tagmanager.js"></script>
    <script src="<?php echo "http://".$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl; ?>/js/bootstrap-editable.js"></script>
    <script src="<?php echo "http://".$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl; ?>/js/select2.js"></script>
    <!-- <script src="<?php echo "http://".$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl; ?>/js/bootstripe.js"></script>-->
	<script src="<?php echo "http://".$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl; ?>/js/jquery.addressPicker.js"></script>
<script src="<?php echo "http://".$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl; ?>/js/jquery.payment.js"></script>
    <script src="<?php echo "http://".$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl; ?>/js/inputs-ext/wysihtml5/bootstrap-wysihtml5-0.0.2/wysihtml5-0.3.0.min.js"></script>  
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/inputs-ext/wysihtml5/bootstrap-wysihtml5-0.0.2/bootstrap-wysihtml5-0.0.2.min.js"></script>  
    <script src="<?php echo "http://".$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl; ?>/js/inputs-ext/wysihtml5/wysihtml5.js"></script>
    <script src="<?php echo "http://".$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl; ?>/js/holder.js"></script>
	<link rel="stylesheet" href="<?php echo "http://".$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl; ?>/css/jquery.alerts.css" type="text/css" media="screen" /> 
	<script type="text/javascript" src="<?php echo "http://".$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl; ?>/js/jquery.alerts.js"></script>
	<script src="<?php echo "http://".$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl; ?>/js/jquery.autosize.js"></script>
<script type="text/javascript" src="https://js.stripe.com/v1/"></script>
<!--<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>-->
<script type="text/javascript">Stripe.setPublishableKey('pk_test_guOskqsm83u56mz3eECGpo1i');</script>
<script src="<?php echo "http://".$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl; ?>/js/bootstrap-datepicker.js"></script>

  <script src="<?php echo "http://".$_SERVER['HTTP_HOST'].Yii::app()->request->baseUrl; ?>/js/payment_post.js"></script>
 <script>
 var page_url='http://<?php echo $_SERVER['HTTP_HOST'].Yii::app()->request->url; ?>/';
 
	 $(document).ready(function() {
			$('.modal-backdrop').remove();
			$('.fileupload').fileupload()
			$('#dpYears').datepicker();
			
			
		
	        $('#daterange').daterangepicker();
			var addresspicker = $( "#employeraddress" ).addressPicker();
			var addresspicker = $( "#student_address" ).addressPicker();
			if(page_url != web_path+'employer/index/')
			{
				$(".skilltags").tagsManager({
				preventSubmitOnEnter: true,
				typeahead: true,
				typeaheadSource: show_skills(),
				delimeters: [44, 188, 13],
				backspace: [8],
				blinkBGColor_1: '#FFFF9C',
				blinkBGColor_2: '#CDE69C'
			 });
			}
			
			
		$('#employeraddress').autosize();
		incrementVar = 0;
		
		$('.inc.button').click(function(){
			var $this = $(this),
			$input = $this.prev('input'),
			$parent = $input.closest('div'),
			newValue = parseInt($('#interns_limit').val())+1;
			//$parent.find('.inc').addClass('a'+newValue);
			$('#interns_limit').val(newValue);
			$('#interns').html(newValue);
			$('#total_price').html('<span>$'+newValue*30+'</span>');
			$('#intern_price').val(newValue*30);
			incrementVar += newValue;
		});
			
		$('.dec.button').click(function(){
			var $this = $(this),
			$input = $this.next('input'),
			$parent = $input.closest('div'),
			newValue = parseInt($('#interns_limit').val())-1;
			if(newValue <1) {
				return  false;
			}
			
			$('#interns_limit').val(newValue);
			$('#interns').html(newValue);
			$('#total_price').html('<span>$'+newValue*30+'</span>');
			$('#intern_price').val(newValue*30);
			incrementVar += newValue;
		
		});
			 $('#emplyer-tabs a:first').tab('show');
			 
			 $('.toggles').hide();
        $(".toggle").click(function () {
            $(this).parent().nextAll('.toggles').first().slideToggle('slow');
            return false;
        });
		
		
			if(jQuery('.nav-list li.active a').attr('id')=='1')
				{
					var empid=$('#empid').val();
					var url =web_path + '/employer/gettabcontent/?id=1&empid='+empid;
					get_response(url,'#loaderp1','#content_container');
				}
		
			jQuery('.nav-list a').click(
			
				function()
				{
					var empid=$('#empid').val();
					var href_id = jQuery(this).attr('id');
					var url = web_path + '/employer/gettabcontent/?id='+href_id+'&empid='+empid;
					var img_load = '#loaderp'+href_id;
					get_response(url,img_load,'#content_container');	
				}
			);	
			
	  });
	  
	 <!--- Student array------->
     
	var position = ['Student', 'Freelancer', 'Gremlin', 'Bossman']; 
	$('#position').typeahead({source: position})
	
	<!--- Univeristy array------->
	
	 $('#universities').typeahead({
        source: function (query, process) {
    return $.post(web_path+ '/university/getuniversity', function (data) {
	    process(JSON.parse(data));
    	});
    }});
	
	<!--- Industry  array------->
	
     $('#industries1').typeahead({
        source: function (query, process) {
    return $.post(web_path+ '/posting/getindustry', function (data) {
	    process(JSON.parse(data));
    	});
    }});
	
	
		
    $('#industries2').typeahead({
        source: function (query, process) {
    return $.post(web_path+ '/posting/getindustry', function (data) {
	    process(JSON.parse(data));
    	});
    }});
	
	<!--- Modal------->
	
	$(window).load(function(){
		$('#finishprofile').modal('show');
	});
	
	if($('#company_logo').val()=='')
	{
		 $(window).load(function(){
			$('#finishprofile2').modal('show');
		});
	}
	</script>
    <script type="text/javascript">
	
	
	<!--- Get The Days difference------->
	
	function parseDate(str) {
		var mdy = str.split('/')
		return new Date(mdy[2], mdy[0]-1, mdy[1]);
	}

	function daydiff(first, second) {
		return (second-first)/(1000*60*60*24)
	}
		
	 function duplicate_past_post(post_id,employer_id,fb_id,twitter_id,linkedin_id)
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
		
	<!--- Image Uplaoding ------->
		
	function uploadimage()
	{
		if($('input[type=file]').val()=='')
		{
			$('#error_image').html('Image is Required');
			return false;
				
		 }else
		 {
			$('#error_image').html('');					
			var formData = new FormData();
			jQuery.each($('input[type=file]')[0].files, function(i, file) {formData.append('company', file);});
			formData.append('emp_id',$('#empid').val());
			jQuery.ajax({
			url: web_path+'employer/saveimage' ,
			type: 'POST',
			cache: false,
			contentType: false,
			processData: false,
			data: formData,
			success: function(data)
			{
				/*alert(data);
				return false;*/
				if(data==1)
				{
				window.location = web_path+'employer/index';	
				}else
				{
				  $('#error_image').html(data);
					return false;	
				}	
			}
			});
		}
	}
	
	<!--- Check Login------->
	
	function check_login()
	{
		 if($('#username').val() && $('#password').val())
		{
	
		   var sData = $('form#loginForm').serialize();
			$.ajax({
				type: "POST",
				url: web_path+'/employer/login',
				data: sData,
				success: function(data) {
				 /* alert(data);
				  return false;*/
				  
				  /*if(data == 2)
				  {
					  $('#error_message').html('Invalid Username and Password')
					  return false;	  
				  }
				  
				  else
				  {
					 window.location = web_path+'employer/index';  
				  }*/
				  if (data == 1){
					  window.location = web_path+'employer/index';
				  }
				  
				  if (data == "student_authenticated"){
					  window.location = web_path+'student/index';
				  }
				  
				  if(data == 2) {
					$('#error_message').html('Invalid Username and Password');
					return false;  
				  }
				  
				}
			});
		}
	}
		
	<!--- Skill  array------->
	
	function show_skills()
	{
	//return ["Pisa", "Rome", "Milan", "Florence", "New York", "Paris", "Berlin", "London", "Madrid"];
		return  function (query, process) {
		return $.post(web_path+ '/posting/getskills', function (data) {
		process(JSON.parse(data));});}
	}
	
	<!--- Add New Post ------->
	
	function send()
	{
	 
		
	 if($('#firstname').val() && $('#lastname').val() && $('#company_name').val() && $('#employeraddress').val() && $('#employer_email').val() && $('#website').val() && ($('#tosagreed').val()==1) )
	 {
		 
		
	   if($('#payment').val()==1)
		{
			
			
		   var sData = $('form').serialize();
		  
			$.ajax({
				type: "POST",
				url: web_path+'/posting/create',
				data: sData,
				beforeSend: function(){$('#reg_img').show();},
				success: function(data) {
				/*alert(data);
				return false;*/
				
				 if(data==2 || data == 3)
					 {
						 	  $('#reg_img').hide();
							  jAlert('This Email Already Exists', '');
							  return false;	  
					 }else  if(data==1)	  
					 {
						 //window.location=web_path+'employer/index';
						 $('#reg_img').hide();
						  $("#jobpost").modal();
							  setInterval(function(){
							  window.location=web_path+'employer/index';
							  var empid=$('#empid').val();
							  var url =web_path + '/employer/gettabcontent/?id=3&empid='+empid;
							 get_response(url,'#loaderp1','#content_container');
							}, 5000); 
					 }else if(data==4)	  
					  {
						  $('#reg_img').hide();
							jAlert('Registration Process not completed successfully', '');
							return false;	 
					  }else 
					  {
						  $('#reg_img').hide();
						  jAlert(data, '');
							return false;
					  }	  
				return false;	  
				}
			});
	 }else
	 {
		   jAlert('Please add credit card for payment information !', '');
		   return false;
	  }
	 }
	  
	}
	
	function internship_modal()
	{
		if($('#tos-agreed1').attr('checked')) 
		{
			 var empid=$('#empid').val();
			$.ajax({
				type: "POST",
				url: web_path+'/posting/chargecard',
				data:{"emp_id":empid },
				success: function(data) {
				
				  if(data==1)	  
					 {
						 jAlert('Your card has been charged successfully', '');
						 $('#internship-payment').modal('hide');
						/*$('#strip_form').modal('show');
						  $("#jobpost").modal();*/
							  var empid=$('#empid').val();
							  var url =web_path + '/employer/gettabcontent/?id=4&empid='+empid;
							 get_response(url,'#loaderp4','#content_container');
					 }else 
					  {
						  jAlert(data, '');
							return false;
					  }	  
				return false;	  
				}
			});
		
				return false;
		} 
	
	}
	function show_toggle(id)
	{
		
		$(".applicants_"+id).toggle("slow");
	}
	
	function toggle_internship(id,lat,long)
	{
		$("#internship_"+id).toggle('slow');
	}
	
	
	
	//function 
	
	
	/* Past post section */
  	function get_response(url,div_id,populate_divid)
	{
		var ajax_url = url; 
		
		$.ajax({
					type: "POST",
					beforeSend: function(){$(div_id).show();},
					url: ajax_url,
					success: function(data) {
						//alert(data);
						//return false;
						
						$(div_id).hide();
						jQuery(populate_divid).html(data);
						$('#count_post').html($('#current_post_count').val());
						$('#count_past_post').html($('#past_count').val());
						return false;
					 //return data; 
				 }
			 });
		}// end of function  
	
	
      </script>
  <script>
/*	toggle: function (e) {
       var self = (e) ? $(e.currentTarget)[this.type](this._options).data(this.type) : this
       self.tip().hasClass('in') ? self.hide() : self.show()
}*/
</script>
  <script> Holder.add_theme("internify", { background: "#61a9cc", foreground: "#444", size: 12 })</script>
