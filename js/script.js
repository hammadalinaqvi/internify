		 function show_loadpage(id,employer_id)
		 {
			$('#past').hide(); 
	 		$('#past_detail').show();
	 		$('#past_detail').load(web_path+'index.php?Action=internify.post_detail&id='+id+'&emp_id='+employer_id);
 	    }
		 	var position = ['Student', 'Freelancer', 'Gremlin', 'Bossman']; 
		$('#position').typeahead({source: position})
			var universities = ['George Washington', 'Georgetown', 'American University', 'University of Maryland', 'Marymount University']; 
		$('#universities').typeahead({source: universities})
			var industries1 = ['Criminal Law', 'Chemist', 'Web Designer', 'Marketing', 'Advertising', 'Photography', 'Developer', 'Business', 'Accounting']; 
	
	
	/*jQuery('button.applyBtn').click(function(){
				alert('hello');
				return false;
				if($('input[name="daterangepicker_start"]').val()  >= $('input[name="daterangepicker_end"]').val() )
				{
					$('#span_message_date').html('Please enter the correct Duration!');
					setInterval(function(){
						$('#span_message_date').fadeOut('slow');
						},3000)
				}
				});*/
	$('#industries2').typeahead({
			source: function (query, process) {
    	return $.post(web_path+ 'index.php?Action=internify.industry', function (data) {
        process(JSON.parse(data));
    });
}});


//page.php
//var array = array("test","treat","food");
//echo json_encode($array);
	$('#industries1').typeahead({source: industries1})
	$('#updateprofile').click(function()
			{
				if($('#username').val() && $('#firstname').val() && $('#lastname').val() && $('#address').val() && $('#email').val() && $('#DropDownTimezone').val() )
				{		
			   		$.each($('form.employer_profile'), function(index) { 
			   var sData = $('form.employer_profile').serialize();
				$.ajax({
					type: "POST",
					 beforeSend: function(){$('#loading_img').show();},
					url: web_path+ 'index.php?Action=internify.update_profile',
					data: sData,
					success: function(data) {
					if(data==1)
					{
						$('#loading_img').hide();
						$('#msg_success1').html("Update Profile Successfully");
						setInterval(function(){
					$('#msg_success1').hide();
					},6000);
					}
                 }
             });
         });
				}
	       });
	  
	  $('#updatepassword').click(function(){
	if($('#old_password').val() && $('#password').val() )
		{	  
			$.each($('form.change_password'), function(index) { 
        var sData = $('form.change_password').serialize();
        $.ajax({
            type: "POST",
			 beforeSend: function(){$('#loading_img2').show();},
            url: web_path+ 'index.php?Action=internify.update_password',
            data: sData,
            success: function(data) {
				//alert(data);
				//return false;
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
			}else if(data==2){
				$('#loading_img2').fadeOut("slow");
				$('#msg_error').show();
				$('#msg_error').html("Please enter the correct Current password");
				$('#msg_success').hide();
				$('#old_password').val(''); $('#password').val('')
				setInterval(function(){
					$('#msg_error').fadeOut("slow");
					},5000);
				}else{
					$('#loading_img2').fadeOut("slow");
					$('#msg_error').show();
					$('#msg_success').hide();
				   $('#msg_error').html("Please enter the correct Current password");
				   $('#old_password').val(''); $('#password').val('')
				setInterval(function(){
					$('#msg_error').fadeOut("slow");
					},5000);
					
					}
				// $('#loading_img').hide();
            }
        });
    });
		}
	  
	  });
		
			//$('#industries2').typeahead({source: industries})
    	/*$('#findinternship').modal(options)*/
<?php if($tab=="home"){?>    
    <script type="text/javascript">
	     $(document).ready(function() {
	        $('#daterange').daterangepicker();
			//jQuery(".tagManager").tagsManager();
			$(".skilltags").tagsManager({
			preventSubmitOnEnter: true,
			typeahead: true,
			typeaheadSource: show_skills(),
			delimeters: [44, 188, 13],
		    backspace: [8],
		    blinkBGColor_1: '#FFFF9C',
		    blinkBGColor_2: '#CDE69C'
 		 });
			
	     });
     </script>
      <script>
	function show_skills()
	{
        //return ["Pisa", "Rome", "Milan", "Florence", "New York", "Paris", "Berlin", "London", "Madrid"];
		return  function (query, process) {
    	return $.post(web_path+ 'index.php?Action=internify.skills', function (data) {
        process(JSON.parse(data));
    });
	}
  }
  
  function show_editable(id)
  { 
	   $('#employer_title_'+id).editable({
		        url: '/post',
		        title: 'Enter Title'
		    });
	  
  }
  

		</script>
<?php }?>    
<?php if($tab=="employeradmin"){?>    
		
 <script type="text/javascript">
		jQuery(function(){
		    $('#employer_facebook').editable({
		        url: '/post',
		        title: 'Enter Facebook url'
		    });
		    
		    $('#employer_twitter').editable({
		        url: '/post',
		        title: 'Enter Twitter url'
		    });
		    
		    $('#employer_linkedin').editable({
		        url: '/post',
		        title: 'Enter Linkedin url'
		    });
		    
		    $('#employer_title').editable({
		        url: '/post',
		        title: 'Enter Title'
		    });
		    
		    $('#employer_industry').editable({
		        url: '/post',
		        title: 'Enter Industry'
		    });
		    
		    $('#employer_description').editable({
		        url: '/post',
		        title: 'Enter Description'
        });
        $('#employer_skills').editable({
		        select2: {
		            tags: ['Technology', 'Business', 'Sales', 'Champion', 'Something', 'html', 'javascript', 'css', 'ajax'],
		            tokenSeparators: [",", " "]
		        }
		    });
		});
		</script>
		
		<script>
		  $(function () {
		    $('#emplyer-tabs a:first').tab('show');
		  })
		</script>
		
		<script>
		$(".applicants-toggle").click(function () {
		$(".applicants").toggle("slow");
		});
		$(".viewmore-toggle").click(function () {
		$(".intern-viewmore").toggle("slow");
		});
		</script>
<?php }?>		
		<script> Holder.add_theme("internify", { background: "#61a9cc", foreground: "#444", size: 12 })</script>// JavaScript Document